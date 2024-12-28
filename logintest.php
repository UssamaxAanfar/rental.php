<?php
session_start();

class Auth {
    private $users = []; // Assume this would be populated from a database or another source
    public $message = '';
    public $registrationMessage = '';

    public function __construct($users) {
        $this->users = $users;
    }

    public function login($username, $password) {
        if (empty($username)) {
            $this->message = 'Name must be filled';
        } elseif (empty($password)) {
            $this->message = 'Password must be filled';
        } else {
            foreach ($this->users as $user) {
                if ($user['username'] === $username && $user['password'] === $password) {
                    $_SESSION['username'] = $username; // Store username in session
                    header("Location: home.php"); // Redirect to home page
                    exit;
                }
            }
            $this->message = 'Username or password do not match';
        }
    }

    public function register($firstname, $lastname, $email, $password) {
        $emailPattern = '/^[^ ]+@[^ ]+\.[a-z]{2,3}$/';
        
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            $this->registrationMessage = 'All fields must be filled.';
        } elseif (!preg_match($emailPattern, $email)) {
            $this->registrationMessage = 'Please enter a valid email address.';
        } else {
            // Here you would typically save the user details to a database
            $this->registrationMessage = 'Registration successful!';
        }
    }
}

// Initialize users array (you would typically fetch this from a database)
$users = [
    ['username' => 'testuser', 'password' => 'password123'],
    // Add more users as needed
];

$auth = new Auth($users);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $auth->login($_POST['username'] ?? '', $_POST['password'] ?? '');
    } elseif (isset($_POST['register'])) {
        $auth->register($_POST['firstname'] ?? '', $_POST['lastname'] ?? '', $_POST['email'] ?? '', $_POST['password'] ?? '');
    }
}
?>


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file here -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-padding-top: 2rem;
            scroll-behavior: smooth;
            list-style: none;
            text-decoration: none;
        }
        body{
            background: url("https://i.ytimg.com/vi/gufT-6ErTlY/maxresdefault.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
            justify-content: center;
            display: flex; 
        }
        header{
            position: fixed;
            width: 100%;
            top : 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #eeeff1;
            padding: 8px 30px;
        }
        .navbar{
            display: flex;
        }
        .navbar li{
            position: relative;
        }
        .navbar a{
            font-size: 1rem;
            padding: 10px 20px;
            color: #444;
            font-weight: 500;
        }
        .navbar a::after{
            width: 100%;
            height: 3px;
            background: #ffac38;
            position: absolute;
            bottom: -4px;
            left: 0;
            transition: 0.5s;
        }
        .navbar a:hover::after{
            width: 100%;
        }
        .nav-button .btn{
            width: 130px;
            height: 40px;
            font-weight: 500;
            background: blueviolet;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: .3s ease;
        }
        .btn:hover{
            background: #444;
        }
        #registerBtn{
            margin-left: 15px;
        }
        .btn.white-btn{
            background: blueviolet;
            color: white;
        }
        .btn {
            color: white;
        }
        .btn.btn.white-btn:hover{
            background: #444;
        }
        .nav-menu-btn{
            display: none;
        }
        .form-box{
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 512px;
            height: 420px;
            overflow: hidden;
            z-index: 2;
        }
        .login-container{
            position: absolute;
            left: 4px;
            width: 500px;
            display: none;
            flex-direction: column;
            transition: .5s ease-in-out;
        }
        .register-container{
           
            right: -520px;
            width: 500px;
            display: flex;
            flex-direction: column;
            transition: .5s ease-in-out;
        }
        .top span{
            color: #fff;
            font-size: small;
            padding: 10px 0;
            display: flex;
            justify-content: center;
        }
        .top span a{
            font-weight: 500;
            color:#fff;
            margin-left: 5px;
        }
        .two-forms{
            display: flex;
            gap: 10px;
        }
        .input-field{
            font-size: 15px;
            background: #ffffff;
            height: 50px;
            width: 100%;
            padding: 0 10px 0 45px;
            border: none;
            border-radius: 30px;
            outline: none;
            transition: .2s ease;
        }
        .input-field:hover, .input-field:focus{
            background: rgba(255, 255, 255, 0.25);
        }
        ::-webkit-input-placeholder{
            color: #000000;
        }
        .input-box i{
            position: relative;
            top: -35px;
            left: 17px;
            color: #000000;
        }
        .input-box .input-field{
            color: black;
        }
        .input-box .submit{
            background: blueviolet;
        }
        .submit{
            font-size: 15px;
            font-weight: 500;
            color: rgb(255, 255, 255);
            height: 45px;
            width: 100%;
            border: none;
            border-radius: 30px;
            outline: none;
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: .3s ease-in-out;
        }
        .submit:hover{
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
        }
        .col{
            display: flex;
            justify-content: space-between;
            color: #fff;
            font-size: small;
            margin-top: 10px;
        }
        .col .one{
            display: flex;
            gap: 5px;
        }
        .two label a{
            text-decoration: none;
            color: #fafafa;
        }
        .two label a:hover{
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <header>
        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#ride">Ride</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#reviews">Reviews</a></li>
        </ul>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="showLogin()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="showRegister()">Sign Up</button>
        </div>
    </header>
    <div class="form-box">
        <!-- Login -->
        <div class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="showRegister()">Sign Up</a></span>
                <header>Login</header>
            </div>
            <div class="input-box">
                <form method="POST">
                    <input type="text" class="input-field" name="username" placeholder="Username or Email" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Sign In" name="login">
                </div>
                <div class="col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
                <div id="verification"><?php echo $auth->message; ?></div>
            </form>
        </div>

        <!-- Register -->
        <div class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="#" onclick="showLogin()">Login</a></span>
                <header>Sign Up</header>
            </div>
            <form method="POST">
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" name="firstname" placeholder="Firstname" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="lastname" placeholder="Lastname" required>
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register" name="register">
                </div>
                <div class="col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check">Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>
            </form>
            <div><?php echo $auth->registrationMessage; ?></div>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('login').style.display = 'block';
            document.getElementById('register').style.display = 'none';
        }

        function showRegister() {
            document.getElementById('login').style.display = 'none';
            document.getElementById('register').style.display = 'block';
        }
    </script>
</body>
</html>