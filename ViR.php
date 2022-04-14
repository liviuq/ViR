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
                <button type="button" class="btn--toggle" onclick="login()">Log In</button>
                <button type="button" class="btn--toggle" onclick="register()">Register</button>
            </div>
            <form id="form__login" class="form__inputgroup">
                <input type="text" class="form__input" placeholder="User ID" required>
                <input type="password" class="form__input" placeholder="Enter Password" required>
                <input type="checkbox" class="form__checkbox"><span>Remember Password</span>
                <button type="submit" class="form__submitbutton" onclick="location.href='index.php'">Login</button>
            </form>
            <form id="form__register" class="form__inputgroup">
                <input type="text" class="form__input" placeholder="User ID" required>
                <input type="email" class="form__input" placeholder="Email Address" required>
                <input type="password" class="form__input" placeholder="Enter Password" required>
                <input type="checkbox" class="form__checkbox"><span>I agree to the terms and conditions</span>
                <button type="submit" class="form__submitbutton">Register</button>
            </form>
            <div class="form__logo">
                <img src="img/test_icon.png" alt="test">
            </div>
        </div>
    </div>
    <script>
        var x = document.getElementById("form__login");
        var y = document.getElementById("form__register");
        var z = document.getElementById("btn");
        function register(){
            x.style.left="-400px"
            y.style.left="50px"
            z.style.left="195px"
        }
        function login()
        {
            x.style.left="50px"
            y.style.left="450px"
            z.style.left="85px"
        }
    </script>
</body> 
</html>

