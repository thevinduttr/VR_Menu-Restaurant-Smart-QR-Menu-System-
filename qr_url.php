<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Token and QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 50px;
            text-align: center;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-top: 40px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 30px;
        }

        p {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555555;
        }

        .btn {
            border: none;
            padding: 10px 20px;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
            margin: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-copy {
            background-color: #28a745;
        }

        .btn-copy:hover {
            background-color: #218838;
        }

        .qr-download-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            opacity: 0.8;
            transition: color 0.3s ease;
        }

        .qr-download-link:hover {
            color: #0056b3;
        }

        #qrCode {
            margin-top: 30px;
            display: inline-block;
            padding: 10px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 30px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<?php
    include 'includes/restaurant_navbar.php'; // Your Navbar Here
    include 'includes/con_db.php'; // Your Database Connection Here

    // Check if the user is logged in
    if (!isset($_SESSION['email']) && !isset($_COOKIE['user_email'])) {
        header("Location: login_page.php");
        exit;
    }

    // Fetch the email from the session or cookie
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : $_COOKIE['user_email'];

    $stmt = $conn->prepare("SELECT tokens.token FROM tokens INNER JOIN registered_restaurants ON tokens.restaurant_id = registered_restaurants.restaurant_id WHERE registered_restaurants.email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingToken = $result->num_rows > 0 ? $result->fetch_assoc()['token'] : '';

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST'];
    ?>

    <div class="container-fluid">
        <h1 class="display-4">Restaurant Public Menu</h1>
        <p class="lead">This is your Restaurant menu URL. It can be share anywhere</p>

        <?php if (empty($existingToken)): ?>
            <button id="generateTokenBtn" class="btn btn-primary">Generate Token</button>
        <?php endif; ?>

        <div id="tokenDisplay" class="token-display mt-4" style="<?php echo empty($existingToken) ? 'display:none;' : ''; ?>">
            <strong class="h4">Your Public Menu URL:</strong>
            <p id="tokenUrl" class="token-url h5">
                <?php if (!empty($existingToken)): ?>
                    <?php echo htmlspecialchars($baseUrl . '/public_menu.php?token=' . $existingToken); ?>
                <?php endif; ?>
            </p>
            <button id="copyTokenBtn" class="copy-btn" onclick="copyToClipboard()">Copy URL</button>
        </div>

        <div id="qrCode"></div>
        <br>
        <a href="#" id="downloadQR" class="qr-download-link" style="display: none;">Download QR Code</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function generateQRCode(text) {
            $('#qrCode').empty();
            var qrCode = new QRCode(document.getElementById("qrCode"), {
                text: text,
                width: 200,
                height: 200,
                correctLevel: QRCode.CorrectLevel.H
            });

            setTimeout(function () {
                var canvas = qrCode._oDrawing._elCanvas;
                var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                document.getElementById('downloadQR').href = image;
                document.getElementById('downloadQR').download = 'QRCode.png';
                document.getElementById('downloadQR').style.display = 'inline-block';
            }, 200);
        }

        function copyToClipboard() {
            var url = document.getElementById("tokenUrl").innerText;
            var el = document.createElement("textarea");
            el.value = url;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            alert("URL Copied to Clipboard!");
        }

        $(document).ready(function () {
            $('#generateTokenBtn').click(function () {
                $.get('includes/generate_token.php', function (data) {
                    var tokenUrl = "<?php echo $baseUrl; ?>/public_menu.php?token=" + data.trim();
                    $('#tokenUrl').text(tokenUrl);
                    $('#tokenDisplay').show();
                    $('#generateTokenBtn').hide();

                    generateQRCode(tokenUrl);
                });
            });

            <?php if (!empty($existingToken)): ?>
                generateQRCode("<?php echo $baseUrl; ?>/public_menu.php?token=<?php echo $existingToken; ?>");
            <?php endif; ?>
        });
    </script>
</body>
</html>





