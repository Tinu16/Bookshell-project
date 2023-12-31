
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS to center the form vertically */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
            margin: 150;
        }
        .custom-card 
        {
            max-width: 1000px;
        }
       
    </style>


    <div class="container">
        <div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Create a Seller Account</h2>
                    </div>
                    
                    <div class="card-body">
                        <form id="registrationForm" action="#" method="POST">
                            
                            <div class="form-group">
                                <input type="text" class="form-control" id="business_name" name="business_name"placeholder="Business name">
                                <span id="business_name_error" class="error"></span>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onInput="validateEmail()">
                                <span id="email_error" class="email_error"></span>
                            </div>

                            <div class="form-group">
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number" onInput="validatePhoneNumber(this.value)">
                                <span id="phone_number_error" class="phone_number_error"></span>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" onInput="validatePassword()">
                                <span id="passwordMessage" class="passwordMessage"></span>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your Password" onInput="validateConfirmPassword()">
                                <span id="confirm_password_error" class="confirm_password_error"></span>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      
        function validateEmail() {
          var email = document.getElementById('email').value;
          var email_error = document.getElementById('email_error');
    
          var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email);
          let message = "";

        if (!emailPattern) 
            {
                message += "Enter a valid email.<br>";
            }
       
            email_error.innerHTML = message;

        if (emailPattern) 
            {
                email_error.style.color = "green";
                email_error.textContent = "Password is valid!";
            } 
        else 
            {
                email_error.style.color = "red";
            }
      }
      // Validate phone number
      function validatePhoneNumber(phoneNumber) 
		{
            const phone_number = document.getElementById("phone_number").value;
            const phone_number_error = document.getElementById("phone_number_error");

            let message = "";
            const phoneRegex = /^[0-9]{10}$/.test(phone_number); 

			if(phoneNumber.length >= 10)
                {
                    document.getElementById("phone_number").value = phone_number.slice(0, 10);
                }
			if(!phoneRegex)
                {
                    message += "Invalid phone number!"; 
                }
            
        phone_number_error.innerHTML = message;

            if (phoneRegex && phoneNumber.length == 10) 
                {
                    phone_number_error.style.color = "green";
                    phone_number_error.textContent = "Phone Number is valid!";
                } 
            else 
                {
                    phone_number_error.style.color = "red";
                }
        }
    //Validate password
    function validatePassword() 
      {
        const password = document.getElementById("password").value;
        const passwordMessage = document.getElementById("passwordMessage");

        const lengthValid = /(.{8,10}$)/.test(password);
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password);
        const hasDigit = /[0-9]/.test(password);
        const whiteSpace=/\s/.test(password);

        let message = "";

        if (!lengthValid) 
            {
                message += "Password must be at least 8 characters long.<br>";
            }
        if (password.length >= 10) 
            {
                document.getElementById("password").value = password.slice(0, 10);
            }
        if (!hasUpperCase) 
            {
                message += "Password must contain at least one uppercase letter.<br>";
            }

        if (!hasLowerCase) 
            {
                message += "Password must contain at least one lowercase letter.<br>";
            }

        if (!hasSpecialChar) 
            {
                message += "Password must contain at least one special character.<br>";
            }

        if (!hasDigit) 
            {
                message += "Password must contain at least one digit.<br>";
            }
        if (whiteSpace)
            {
                message += ('Password must not contain any whitespace characters.');
            }

        passwordMessage.innerHTML = message;

        if (lengthValid && hasUpperCase && hasLowerCase && hasSpecialChar && hasDigit && !whiteSpace) 
            {
                passwordMessage.style.color = "green";
                passwordMessage.textContent = "Password is valid!";
            } 
        else 
            {
                passwordMessage.style.color = "red";
            }
    }
    function validateConfirmPassword() 
        {
          var password = document.getElementById('password').value;
          var confirm_password = document.getElementById('confirm_password').value;
          var confirm_password_error = document.getElementById('confirm_password_error=message');

          let message = "";
          confirm_password_error.innnerHTML = message;
          if (confirm_password !== password) 
            {
                message.style.color = "green";
                message += 'Passwords do not match';
            } 
          else 
            {
                message.style.color = "red";
                message += 'Passwords  matched';
            }
        }
    </script>

   