<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Bootstrap -->

    <title>Login Form</title>

    <style>
        body {
            background-image: url(img/regbackground.jpeg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            max-width: 550px;
            margin: 50px auto;
        }

        a {
            text-decoration: none;
        }

        /* Adjustments for mobile view */
        @media (max-width: 767px) {
            .container-fluid.row.justify-content-end {
                flex-direction:row-reverse;
                margin-left: 0.1px;
            }

            .col-md-6 {
                order: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid row justify-content-end">

        <div class="col-md-6 align-self-center">
            <div class="container pt-5 pb-5 p-3 shadow-lg mb-5 bg-body rounded" style="border: 2px solid rgba(206, 204, 204, 0.695); background-color: rgba(255, 255, 255, 0.932);">

                <h2 class="text-center mb-5">Login Form</h2>

                <!-- Login Form -->
                <form id="loginForm" method="POST" class="p-4" action="includes/login_db.php">

                    <!-- Email Address Input -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div id="emailError" class="text-danger"></div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div id="passwordError" class="text-danger"></div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <!-- Login Button -->
                    <div class="d-grid gap-2 col-6 mx-auto pt-3">
                        <button type="button" class="btn btn-primary" id="loginButton" onclick="validateForm()">Login</button>
                    </div>

                    <div class="text-center pt-3">
                        <a href = "registration_page.php"> need to register ? </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image on the Right side -->
        <div class="col-md-6 align-self-center">
            <div class="text-center">
                <img src="img/loginimg.jpeg" alt="Login Image" class="img-fluid float-start" style="width: 100% auto;height: 100%;">
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Function to update the state of the Login button based on form validity
        function updateLoginButton() {
            var isFormValid = true;

            // Array of field IDs
            var fields = ['email', 'password'];

            // Loop through each field
            fields.forEach(function (field) {
                var value = document.getElementById(field).value;
                var error = document.getElementById(field + 'Error');

                // Check if the field is empty
                if (value.trim() === '') {
                    error.textContent = field.charAt(0).toUpperCase() + field.slice(1) + ' is required!';
                    isFormValid = false;
                } else {
                    error.textContent = '';
                }
            });

            // Disable or enable the Login button based on form validity
            var loginButton = document.getElementById('loginButton');
            loginButton.disabled = !isFormValid;
        }

        // Function to set up real-time validation for a field
        function setupRealTimeValidation(field, regex, errorMessage) {
            var inputElement = document.getElementById(field);

            inputElement.addEventListener('input', function () {
                var value = this.value;
                var error = document.getElementById(field + 'Error');

                // Check if the field is empty or doesn't match the regex
                if (value.trim() === '' || !regex.test(value)) {
                    error.textContent = errorMessage;
                } else {
                    error.textContent = '';
                }

                // Update the Login button state
                updateLoginButton();
            });
        }

        // Set up real-time validation for Email Address
        setupRealTimeValidation('email', /^\S+@\S+\.\S+$/, 'Enter a valid Email Address!');

        // Set up real-time validation for Password
        setupRealTimeValidation('password', /^.{6,}$/, 'Password must be at least 6 characters!');

        // Add event listeners for input fields to trigger real-time validation
        document.getElementById('email').addEventListener('input', function () {
            var email = this.value;
            var emailError = document.getElementById('emailError');
            if (email.trim() === '') {
                emailError.textContent = 'Email is required!';
            } else {
                emailError.textContent = '';
            }
            updateLoginButton();
        });

        document.getElementById('password').addEventListener('input', function () {
            var password = this.value;
            var passwordError = document.getElementById('passwordError');
            if (password.trim() === '') {
                passwordError.textContent = 'Password is required!';
            } else {
                passwordError.textContent = '';
            }
            updateLoginButton();
        });

        // Function to validate the form before submission
        function validateForm() {
            var isFormValid = true;

            var fields = ['email', 'password'];
            fields.forEach(function (field) {
                var value = document.getElementById(field).value;
                var error = document.getElementById(field + 'Error');

                if (value.trim() === '') {
                    error.textContent = field.charAt(0).toUpperCase() + field.slice(1) + ' is required!';
                    isFormValid = false;
                } else {
                    error.textContent = '';
                }
            });

            // If the form is valid, submit it; otherwise, show an alert
            if (isFormValid) {
                document.getElementById("loginForm").submit();
            } else {
                alert('Please correct the errors before submitting the form.');
            }
        }
    </script>
</body>

</html>

