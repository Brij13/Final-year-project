<?php session_start();
require_once('dbconnection.php');

//Code for Registration 
if(isset($_POST['submit']))
{
	
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$pass=$_POST['pass'];
	$enc_pass=md5($pass);
	$a=date('Y-m-d');
	$msg=mysqli_query($con,"insert into users(id,email,mobile,pass,date) values(null,'$email','$mobile','$enc_pass','$a')");
if($msg)
{
	echo "<script>alert('Register successfully');</script>";
}
else
{
	echo "<script>alert('Register not successfully');</script>";
}
}

// Code for login system
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=md5($password);
$useremail=$_POST['uemail'];
$ret= mysqli_query($con,"SELECT * FROM users WHERE email='$useremail' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="welcome.php";
$_SESSION['login']=$_POST['uemail'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['fname'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
echo "<script>alert('Invalid username or password');</script>";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location:http://$host$uri/$extra");
exit();
}
}

//Code for Forgot Password

if(isset($_POST['send']))
{
$row1=mysqli_query($con,"select email,password from users where email='".$_POST['femail']."'");
$row2=mysqli_fetch_array($row1);
if($row2>0)
{
$email = $row2['email'];
$subject = "Information about your password";
$password=$row2['password'];
$message = "Your password is ".$password;
mail($email, $subject, $message, "From: $email");
echo  "<script>alert('Your Password has been sent Successfully');</script>";
}
else
{
echo "<script>alert('Email not register with us');</script>";	
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Home | Project Name</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=0.0.1">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mmenu.min.all.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/project_custom.js"></script>

    <!-- Css  -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/all_plugin.css" rel="stylesheet">
    <link href="css/project_custom.css" rel="stylesheet">

</head>

<!-- <body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;"> -->

<body>
    <div class="main_page" id="page">
        <header class="main_header abc">
            <div class="top_nav">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 logo_col">
                            <img src="images/logoo.png" alt="">
                            <!-- <h4>Worth Wheels Service</h4> -->
                        </div><!-- end logo_col -->
                        <div class="col-md-7">
                            <ul class="pull_right">
								<li><a href="index.php">HOME</a></li>
                                <li><a href="#">BOOK A SERVICE</a></li>
                                <li><a href="#">ABOUT US</a></li>
                                <li><a href="#">CONTACT US</a></li>
                                <li><a href="login.php">LOGIN</a></li>
                            </ul>
                        </div><!-- end nav_cover -->
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end top_nav -->
        </header><!-- end main_header -->

        <div class="mo_menu abc">
            <div class="container">
                <div class="row">
                    <ul>
                        <li class="mobile_logo">
                            <!-- <a href="#"><img src="images/logo.png"></a> -->
                            <h4>Worth Wheels Service</h4>
                        </li>
                        <!-- end mobile_atm_logo -->
                        <li class="menu pull_right">
                            <a href="#mobile_menu">Menu</a>
                        </li>
                        <!-- end menu -->
                    </ul>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end mo_menu -->

        <nav id="mobile_menu">
            <ul class="nav_listing">
                <li><a href="index.php">HOME</a></li>
				<li><a href="#">BOOK A SERVICE</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li><a href="#">CONTACT US</a></li>
                <li><a href="login.php">LOGIN</a></li>
            </ul><!-- end nav_listing-->
        </nav><!-- end mobile_menu -->

        <!-- Login Form -->
        <div class="container">
            <div class="login">
                <div class="row">
                    <div class="col-md-6">
                        <div class="login-logo">
                            <img src="images/wlogo.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-form">
                            <h2>REGISTER</h2>
                            <form action="login.php" method="post">
								<div class="form-group">
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Email">
                                </div>
								<div class="form-group">
                                    <input type="number" name="mobile" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Mobile Number">
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-login">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Form -->

        <!-- cars -->
        <div class="car">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Top Most Serviced Cars</h1>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li>Honda City (petrol)</li>
                            <li>Hyundai i10 (petrol)</li>
                            <li>Hyundai Santro (petrol)</li>
                            <li>Hyundai i20 (petrol)</li>
                            <li>Maruti Suzuki Swift (petrol)</li>
                            <li>Ford Figo (diesel)</li>
                            <li>Chevrolet Beat (petrol)</li>
                            <li>Volkswagen Polo (petrol)</li>
                            <li>Tata Indica (petrol)</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li>Honda City (petrol)</li>
                            <li>Hyundai i10 (petrol)</li>
                            <li>Hyundai Santro (petrol)</li>
                            <li>Hyundai i20 (petrol)</li>
                            <li>Maruti Suzuki Swift (petrol)</li>
                            <li>Ford Figo (diesel)</li>
                            <li>Chevrolet Beat (petrol)</li>
                            <li>Volkswagen Polo (petrol)</li>
                            <li>Tata Indica (petrol)</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li>Honda City (petrol)</li>
                            <li>Hyundai i10 (petrol)</li>
                            <li>Hyundai Santro (petrol)</li>
                            <li>Hyundai i20 (petrol)</li>
                            <li>Maruti Suzuki Swift (petrol)</li>
                            <li>Ford Figo (diesel)</li>
                            <li>Chevrolet Beat (petrol)</li>
                            <li>Volkswagen Polo (petrol)</li>
                            <li>Tata Indica (petrol)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- cars -->

        <!-- footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul>
                            <li>About Us</li>
                            <li>Contact Us</li>
                            <li>Privacy Policy</li>
                            <li>Terms and Conditions</li>
                        </ul>
                        <p>© 2019 - Worth Wheels Services. - All rights reserved</p>
                    </div>
                    <div class="col-md-4">
                        <ul class="soc">
                            <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->

    </div><!-- end main_page -->

</body>

</html>