<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Review</title>
    <link rel="stylesheet" href="sass/index.css">
    <script src="js/script.js" defer></script>

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
        <h2> Video Reviews made easy!</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster" onclick="location.href='movie_template.php'">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
        </div>
    </div>
<!--    Trending now-->
    <div class="row">
        <h2>Trending now</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
        </div>
    </div>
<!--    Top Rated-->
    <div class="row">
        <h2>Top Rated</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>
<!--Action Movies-->
    <div class="row">
        <h2>Action Movies</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>
<!--Comedy Movies-->
    <div class="row">
        <h2>Comedy Movies</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>
<!--Horror Movies-->
    <div class="row">
        <h2>Horror Movies</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>
<!--Romance Movies-->
    <div class="row">
        <h2>Romance Movies</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>
<!--Documentaries-->
    <div class="row">
        <h2>Documentaries</h2>
        <div class="row__posters">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/121/200" alt="a simple image" class="row__poster">

        </div>
    </div>

<script>
    const nav = document.getElementById('nav');

    window.addEventListener('scroll', () => {
        if(window.scrollY > 100)
        {
            nav.classList.add('nav__black');
        }
        else
        {
            nav.classList.remove('nav__black');
        }
    })
</script>
</body>
</html>