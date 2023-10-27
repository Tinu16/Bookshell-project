
<?php
session_start();
    include("dbcon.php");
    include("includes/header.php");
?>

<body class="bg-gradient-primary">

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image" style="background-image: url('img/book2.jpeg')"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                            
                               <?php
                                    include("message.php");
                               ?>
                          
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            
                            <form class="user" method="POST" action="register_code.php">
                            
                                <div class="form-group">
                                
                                    <input type="email" name="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address" onInput="validateEmail()">
                                        <span id="email_error" class="email_error"></span>
                                </div>
                                
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Password" onInput="validatePassword()">
                                            <span id="passwordMessage" class="passwordMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="RepeatPassword" name="confirm_Password" placeholder="Repeat Password" onInput="validateConfirmPassword()">
                                            <span id="confirm_password_error" class="confirm_password_error"></span>
                                    
                                    <div class="col-sm-6">
                                        <input type="hidden" class="form-control form-control-user"
                                            id="role_customer" name="role" >
                                    </div>
                                </div>
                                <div class="col-sm-13">
                                <input type="submit" name="register_btn" class="btn btn-primary btn-user btn-block" value="Register Account">
                                </div>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
        <script>
       /*
        function validateUsername(input) 
        {
   
            const username = document.getElementById('username');
            const nameError = document.getElementById('username_error');

            const lengthValid = /(.{2,25}$)/.test(password);
            const namePattern=(/^[^\s]{1}[A-Za-z\s]+$/.test(input)) 
            let message="";          
                if (input.trim() == "") 
                {
                  nameError.style.color = "red";
                  nameError.textContent = "Name cannot be empty.";
                } 
                if (!namePattern) 
                {
                    nameError.style.color = "red";
                  nameError.textContent = "Name can only contain letters and spaces.";
                } 
                if(namePattern)
                {
                  nameError.textContent = ""; // Clear any error message if the input is valid
                }
              
        }  */   
       
          function validateForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Check if any of the required fields are empty
    if (email === "" || password === "" || confirmPassword === "") {
        alert("All fields must be filled out");
        return false; // Prevent form submission
    }

    return true;
}

        
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
                email_error.textContent = "Email is valid!";
            } 
        else 
            {
                email_error.style.color = "red";
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
          var confirm_password_error = document.getElementById('confirm_password_error');
            if (confirm_password !== password) 
            {
                confirm_password_error.style.color="red";
                confirm_password_error.textContent = 'Passwords do not match';
            } 
            else 
            {
                confirm_password_error.style.color="green";
                confirm_password_error.textContent = 'Passwords matched';
            }
        }
    </script>
<?php 
    include("includes/script.php");
?>    
    