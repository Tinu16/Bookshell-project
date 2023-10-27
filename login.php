<?php 
    session_start();
    include("includes/header.php");
 
?>

<body class="bg-gradient-primary">

    <div class="container">
    
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('img/login.jpeg')"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                <?php
                                    include("message.php");
                               ?>
                                    <div class="text-center">
                                    
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        
                                    </div>
                                    <form class="user" action="logincode.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <div class="col-sm-13">
                                        <input type="submit" name="login_btn" class="btn btn-primary btn-user btn-block" value="Login">
                                        </div>
                                        <hr>
                                        <div class="col-sm-13">
                                        <input type="submit" name="login_google" class="btn btn-google btn-user btn-block" value=" Login with Google" onclick="window.location='<?php echo $login_url; ?>'">
                                        <button type="button" class="btn btn-google btn-user btn-block" onclick="window.location='<?php echo $login_url; ?>'">Login with Google</button>
                                    </div>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php 
    include("includes/script.php");
    
?>    