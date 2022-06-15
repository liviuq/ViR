<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video Review</title>
    <link rel="stylesheet" href="sass/index.css">

<!--    roboto font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
        <div class="nav" id="nav">
            <img src="img/test_icon.png" alt="vir_icon" class="nav__logo">
            <div class="wrapper">
                <img class="wrapper__search" src="img/search_icon.png" alt="search"/>
                <input class="search" placeholder="Search" type="text" >
            </div>
            <div class="nav__buttons">
                <button type="button" class="button--toggle" onclick="location.href='ViR.php'">Login/Register</button>
                <button type="button" class="button--toggle" onclick="location.href='aboutusViR.php'">About Us</button>
                <button type="button" class="button--toggle" onclick="location.href='contactViR.html'">Contact</button>
            </div>
        </div>
<!--        Banner-->
    <div class="banner">
            <div class="banner__contents">
                <h1 class="banner__title">Lorem Ipsum</h1>
                <div class="banner__description">
                    Most viewed movie. this will be taken straight from the database based on
                    the number of reviews
                </div>
            </div>
            <div class="banner__fade"></div>
    </div>

    <script src="js/script.js" defer></script>
    <script src="js/cards.js" defer></script>
    <script src="js/editIndex.js" defer></script>
</body>
</html>