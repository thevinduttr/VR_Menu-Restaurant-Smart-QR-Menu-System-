<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- bootstrap -->
  
    <title>Registration Form</title>
  
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
        <!-- Image on the left side -->
        <div class="col-md-6 align-self-center">
            <div class="text-center">
                <img src="img/regimg.png" alt="Registration Image" class="img-fluid float-start">
            </div>
        </div>

        <div class="col-md-6">
            <div class="container p-5 rounded-2 p-3 shadow-lg mb-5 bg-body rounded" style="width: 100%; border: 2px solid rgba(115, 114, 114, 0.108); background-color: rgba(255, 255, 255, 0.932);">

                <h2 class="text-center mb-4">Registration Form</h2>

                <!-- Registration Form -->
                <form id="registrationForm" method="POST" class="p-2" action="includes/registration_db.php">

                    <!-- First Name Input -->
                    <div class="mb-2">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                        <div id="firstNameError" class="text-danger"></div>
                    </div>

                    <!-- Last Name Input -->
                    <div class="mb-2">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                        <div id="lastNameError" class="text-danger"></div>
                    </div>

                    <!-- Phone Number Input -->
                    <div class="mb-2">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        <div id="phoneNumberError" class="text-danger"></div>
                    </div>

                    <!-- Whatsapp Number Input -->
                    <div class="mb-2">
                        <label for="whatsappNumber" class="form-label">Whatsapp Number</label>
                        <input type="tel" class="form-control" id="whatsappNumber" name="whatsappNumber" required>
                        <div id="whatsappNumberError" class="text-danger"></div>
                    </div>

                    <!-- Business Name Input -->
                    <div class="mb-2">
                        <label for="businessName" class="form-label">Your Business Name</label>
                        <input type="text" class="form-control" id="businessName" name="businessName" required>
                        <div id="businessNameError" class="text-danger"></div>
                    </div>

                    <!-- Email Address Input -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div id="emailError" class="text-danger"></div>
                    </div>

                    <!-- Retype Email Address Input -->
                    <div class="mb-2">
                        <label for="retypeEmail" class="form-label">Retype Email Address</label>
                        <input type="email" class="form-control" id="retypeEmail" name="retypeEmail" required>
                        <div id="retypeEmailError" class="text-danger"></div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Set a New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div id="passwordError" class="text-danger"></div>
                    </div>

                    <!-- Retype Password Input -->
                    <div class="mb-2">
                        <label for="retypePassword" class="form-label">Retype Password</label>
                        <input type="password" class="form-control" id="retypePassword" name="retypePassword" required>
                        <div id="retypePasswordError" class="text-danger"></div>
                    </div>

                    <!-- Terms and Conditions Checkbox -->
                    <div class="mb-2 form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">I agree to the terms and conditions</label>
                    </div>
                    
                    <!-- Register Button -->
                    <div class="d-grid gap-2 col-6 mx-auto pt-3">
                        <button type="button" class="btn btn-primary" id="registerButton" onclick="validateForm()">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    // Function to update the state of the Register button based on form validity
        function updateRegisterButton() {
            var isFormValid = true;

        // Array of field IDs
        var fields = ['firstName', 'lastName', 'phoneNumber', 'whatsappNumber', 'businessName', 'email', 'retypeEmail', 'password', 'retypePassword'];

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

        // Check if Terms and Conditions checkbox is checked
        var agreeTerms = document.getElementById('agreeTerms');
        if (!agreeTerms.checked) {
            isFormValid = false;
        }

        // Check if Email addresses match
        var email = document.getElementById('email').value;
        var retypeEmail = document.getElementById('retypeEmail').value;
        var retypeEmailError = document.getElementById('retypeEmailError');
        if (retypeEmail !== email) {
            retypeEmailError.textContent = 'Email addresses do not match!';
            isFormValid = false;
        } else {
            retypeEmailError.textContent = '';
        }

        // Check if Passwords match
        var password = document.getElementById('password').value;
        var retypePassword = document.getElementById('retypePassword').value;
        var retypePasswordError = document.getElementById('retypePasswordError');
        if (retypePassword !== password) {
            retypePasswordError.textContent = 'Passwords do not match!';
            isFormValid = false;
        } else {
            retypePasswordError.textContent = '';
        }

        // Disable or enable the Register button based on form validity
        var registerButton = document.getElementById('registerButton');
        registerButton.disabled = !isFormValid;
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

            // Update the Register button state
            updateRegisterButton();
        });
        }

        // Set up real-time validation for Phone Number
        setupRealTimeValidation('phoneNumber', /^\d{10}$/, 'Enter a valid 10-digit Phone Number!');

        // Set up real-time validation for Whatsapp Number
        setupRealTimeValidation('whatsappNumber', /^\d{10}$/, 'Enter a valid 10-digit Whatsapp Number!');

        // Set up real-time validation for Email Address
        setupRealTimeValidation('email', /^\S+@\S+\.\S+$/, 'Enter a valid Email Address!');
        
        // Set up real-time validation for Password
        setupRealTimeValidation('password', /^.{6,}$/, 'Password must be at least 6 characters!');

        // Add event listeners for input fields to trigger real-time validation
        document.getElementById('firstName').addEventListener('input', function () {
        var firstName = this.value;
        var firstNameError = document.getElementById('firstNameError');
        if (firstName.trim() === '') {
            firstNameError.textContent = 'First Name is required!';
        } else {
            firstNameError.textContent = '';
        }
        updateRegisterButton();
        });

        document.getElementById('lastName').addEventListener('input', function () {
        var lastName = this.value;
        var lastNameError = document.getElementById('lastNameError');
        if (lastName.trim() === '') {
            lastNameError.textContent = 'Last Name is required!';
        } else {
            lastNameError.textContent = '';
        }
        updateRegisterButton();
        });

        document.getElementById('businessName').addEventListener('input', function () {
        var businessName = this.value;
        var businessNameError = document.getElementById('businessNameError');
        if (businessName.trim() === '') {
            businessNameError.textContent = 'Business Name is required!';
        } else {
            businessNameError.textContent = '';
        }
        updateRegisterButton();
        });

        document.getElementById('retypeEmail').addEventListener('input', function () {
        var email = document.getElementById('email').value;
        var retypeEmail = this.value;
        var retypeEmailError = document.getElementById('retypeEmailError');
        if (retypeEmail !== email) {
            retypeEmailError.textContent = 'Email addresses do not match!';
        } else {
            retypeEmailError.textContent = '';
        }
        updateRegisterButton();
        });

        document.getElementById('retypePassword').addEventListener('input', function () {
        var password = document.getElementById('password').value;
        var retypePassword = this.value;
        var retypePasswordError = document.getElementById('retypePasswordError');
        if (retypePassword !== password) {
            retypePasswordError.textContent = 'Passwords do not match!';
        } else {
            retypePasswordError.textContent = '';
        }
        updateRegisterButton();
        });

        document.getElementById('agreeTerms').addEventListener('change', function () {
        updateRegisterButton();
        });

        // Function to validate the form before submission
        function validateForm() {
        var isFormValid = true;

        var fields = ['firstName', 'lastName', 'phoneNumber', 'whatsappNumber', 'businessName', 'email', 'retypeEmail', 'password', 'retypePassword'];
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

        var agreeTerms = document.getElementById('agreeTerms');
        if (!agreeTerms.checked) {
            isFormValid = false;
        }

        var email = document.getElementById('email').value;
        var retypeEmail = document.getElementById('retypeEmail').value;
        var retypeEmailError = document.getElementById('retypeEmailError');
        if (retypeEmail !== email) {
            retypeEmailError.textContent = 'Email addresses do not match!';
            isFormValid = false;
        } else {
            retypeEmailError.textContent = '';
        }

        var password = document.getElementById('password').value;
        var retypePassword = document.getElementById('retypePassword').value;
        var retypePasswordError = document.getElementById('retypePasswordError');
        if (retypePassword !== password) {
            retypePasswordError.textContent = 'Passwords do not match!';
            isFormValid = false;
        } else {
            retypePasswordError.textContent = '';
        }

        // If the form is valid, submit it; otherwise, show an alert
        if (isFormValid) {
            document.getElementById("registrationForm").submit();
        } else {
            alert('Please correct the errors before submitting the form.');
        }
        }
    </script>
</body>

</html>


