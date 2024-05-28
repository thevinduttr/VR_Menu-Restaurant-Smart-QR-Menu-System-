<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap');

        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Ubuntu', sans-serif;
        text-decoration: none;
        }

        body {
            background-image: url('img/adminloginbg.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .form {
        width: 720px;
        height: 500px;
        margin: 50px auto;
        padding: 45px 65px;
        background: linear-gradient(to right, #4a0d0f, #262729);
        }

        .form__box {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: #fff;
        border-radius: 40px;
        }

        .form__left {
        width: 50%;
        }

        .form__padding {
        width: 210px;
        height: 210px;
        background: #f2f2f2;
        border-radius: 50%;
        margin: 0 auto;
        line-height: 210px;
        position: relative;
        }

        .form__image {
        max-width: 100%;
        width: 60%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        }

        .form__right {
        line-height: 26px;
        width: 50%;
        }

        .form__padding-right {
        padding: 0 25px;
        }

        .form__title {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        }

        .form__submit-btn {
        background: #1fcc44;
        cursor: pointer;
        }

        .form__submit-btn:hover {
        background: #ff3f70;
        }

        .form__email {
        position: relative;
        }

        input {
        display: block;
        width: 100%;
        margin-bottom: 25px;
        height: 35px;
        border-radius: 20px;
        border: none;
        background: #f2f2f2;
        padding: 10px;
        font-size: 14px;
        position: relative;
        }

        input:after {
        position: absolute;
        content: 'a***';
        }

        a {
        color: #71df88;
        }

        a:hover {
        color: #ff3f70;
        }
    </style>
</head>

<body>
    <div class="form">
        <div class="form__box">
            <div class="form__left">
                <div class="form__padding">
                <img src="img/adminprofile.png" alt="Form Image"
                    class="form__image">
                </div>
            </div>
            <div class="form__right">
                <div class="form__padding-right">
                    <form method="POST" action="includes/adminlogin_db.php">
                        <h1 class="form__title">Admin Login</h1>
                        <input type="text" placeholder="userName" class="form__email" name="userName" required>
                        <input type="password" placeholder="******" class="form__password" name="password" required>
                        <input type="submit" class="form__submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
