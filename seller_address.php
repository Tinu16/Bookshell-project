
<?php
session_start();
    include("../dbcon.php");
    include("../includes/header.php");
?>

<body class="bg-gradient-">

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 background:cover;">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image" style="background-image: url('../img/address.jpg');"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                            
                               <?php
                                    include("../message.php");
                               ?>
                          
                                <h1 class="h4 text-gray-900 mb-4">Address Details</h1>
                            
                            <form class="user" method="POST" action="register_code.php">
                            
                                <div class="form-group">
                                
                                    <input type="text" name="store_name" class="form-control form-control-user" id="store_name" 
                                        placeholder="Address Line 1" onInput="validatestore()">
                                        <small id="storeMessage" class="storeMessage"></small>
                                </div>
                                
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="pan" name="pan" placeholder="Address Line 2" onInput="validatePan()">
                                            <small id="pan_message" class="pan_message"></small>
                                    </div>
                                    <div class="form-group">
                                            <input type="phone" name="phone" class="form-control form-control-user" id="phone" placeholder="PINCODE">
                                        </div>
                                        <div class="form-group">
                                            <input type="phone" name="phone" class="form-control form-control-user" id="phone" placeholder="DISTRICT">
                                        </div>
                                        <div class="form-group">
                                            <input type="phone" name="phone" class="form-control form-control-user" id="phone" placeholder="STATE">
                                        </div>
                                        <div class="form-group">
                                            <input type="phone" name="phone" class="form-control form-control-user" id="phone" placeholder="COUNTRY">
                                        </div>

                                </div>
                                <div class="col-sm-13">
                                <input type="submit" name="register_btn" class="btn btn-primary btn-user btn-block" value="SUBMIT">
                                </div>
                                <hr>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
       
<?php 
    include("../includes/script.php");
?>    
    