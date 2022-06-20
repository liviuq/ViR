<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login And Registration Form</title>
    <link rel="stylesheet" href="sass/ViR.css">
</head>
<body>
    <div class="root">
        <div class="form">
            <div class="form__buttons">
                <div id="btn"></div>
                <button type="button" class="btn--toggle" onclick="login_move()">Log In</button>
                <button type="button" class="btn--toggle" onclick="register_move()">Register</button>
            </div>
            <form id="form__login" class="form__inputgroup">
                <input id="login_username" type="text" class="form__input" placeholder="User ID" required>
                <input id="login_password" type="password" class="form__input" placeholder="Enter Password" required>
                <input type="checkbox" class="form__checkbox"><span>Remember Password</span>
                <button id="login_button" type="submit" class="form__submitbutton">Login</button>
            </form>
            <form id="form__register" class="form__inputgroup">
                <input id="reg_username" type="text" name="username" class="form__input" placeholder="User ID" required>
                <input id="reg_email" type="email" name="email" class="form__input" placeholder="Email Address" required>
                <input id="reg_password" type="password" name="password" class="form__input" placeholder="Enter Password" required>
                <input type="checkbox" class="form__checkbox" required><span>I agree to the terms and conditions</span>
                <button id="register_button" type="submit" class="form__submitbutton">Register</button>
            </form>
            <div class="form__logo">
                <img src="img/test_icon.png" alt="test">
                <h4 id="reg_error" class="register_neutral">Username or email already in use.</h4>
                <h4 id="reg_good" class="register_neutral">User registered successfully</h4>
                <h4 id="login_message"></h4>
            </div>
        </div>
    </div>
    <script>
        var x = document.getElementById("form__login");
        var y = document.getElementById("form__register");
        var z = document.getElementById("btn");
        function register_move(){
            x.style.left="-400px"
            y.style.left="50px"
            z.style.left="195px"
        }
        function login_move()
        {
            x.style.left="50px"
            y.style.left="450px"
            z.style.left="85px"
        }
    </script>
    <script src="js/register.js"></script>
    <script src="js/login.js"></script>
</body> 
</html>

