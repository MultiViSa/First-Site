<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="index" content="width=device-width, initial-scale=1.0">
    <title>First Site</title>

    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

<?php
session_start(); // Session starten, um die Nachricht abzurufen
include 'message_box.php'; 

//// Überprüfen, ob der Benutzer eingeloggt ist
//if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
//    header("Location: dashboard.php"); // Leitet zu Dashboard weiter
//    exit();
//}
?>

    <header>
        <h2 class="logo">logo</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button id="btn" class="btnLogin-popup">Login</button>
        </nav>
    </header>

    <div class="Wrapper">
        <span class="icon-close">
            <i class='bx bx-x'></i>
        </span>

    <div class="form-box Login">    
     <h1>Login</h1>   
     <form action="login_register.php" method="POST">
            <div class="input-box">
                <span class="icon"></span>
                <label for="username">
                    <input type="text" name="username" id="username" placeholder="Name" required>
                    <i class='bx bx-user'></i>
                </label> 
            </div>

            <div class="input-box">
                <label for="password">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt' ></i>
                </label>    
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">Remember me
                </label>    
                <a href="#">Forgot my Password</a>
                </label>
            </div>

                <button type="submit" name="login" class="btn" id="btn">Login</button>

                <!--<div id="loginMessage" class="response-box"></div>-->

            <div class="Login-register">
                <p>
                    Don't have an account
                    <a href="#" class="register-link">Register</a>
                </p>
            </div>
     </form>       
    </div>    

    <div class="form-box Register">
     <h1>Registration</h1>
     <form action="login_register.php" method="POST">  
            <div class="input-box">
                <span class="icon"></span>
                <label for="username">
                    <input type="text" name="username" id="username" placeholder="Name" required>
                    <i class='bx bx-user'></i>
                </label> 
            </div>

            <div class="input-box">
                <span class="icon"></span>
                <label for="email">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <i class='bx bx-envelope' ></i>
                </label> 
            </div>

            <div class="input-box">
                <label for="password">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt' ></i>
                </label>    
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox">I agree to the terms & conditions
                </label>    
            </div>

                <button type="submit" name="register" class="btn" id="btn">Register</button>

                <!--<div id="registerMessage" class="response-box"></div>-->

            <div class="Login-register">
                <p>
                    Already have an account
                    <a href="#" class="login-link">Login</a>
                </p>
            </div>

     </form>
    </div> 

   </div>
   <script src="script.js"></script>
</body>
</html>
