<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Review</title>
    <link rel="stylesheet" href="sass/index.css">

<!--    roboto font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@103&display=swap" rel="stylesheet">
</head>
<body>
        <div class="nav" id="nav">
            <img src="img/test_icon.png" alt="vir_icon" class="nav__logo">
            <div class="wrapper">
                <img class="wrapper__search" src="img/search_icon.png" alt="search"/>
                <input class="search" placeholder="Search" type="text" >
            </div>
            <div class="nav__buttons">
                <div class="button__dropdown" data-dropdown>
                    <button type="button" class="button--toggle" data-dropdown-button>Categories</button>
                    <div class="dropdown-menu">
                        Dropdown content
                    </div>
                </div>
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
<!--    Start of the title-->
    <div class="row">
        <h2>Placeholder</h2>
        <div class="row__posters" id="firstrow">
        </div>
    </div>

    <script src="js/script.js" defer></script>
    <script src="js/cards.js"></script>
</body>
</html>