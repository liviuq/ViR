<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="sass/movie_template.css">
    <script src="js/script.js" defer></script>
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
    <div class="flexbox-container">
        <div class="flexbox-item flexbox-item-1">
            <img src="https://picsum.photos/241/400" alt="a simple image" class="poster">
        </div>
        <div class="flexbox-item flexbox-item-2">
            <h1>
                Synopsis:
            </h1>
            <h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean erat neque, elementum nec ligula at, pretium feugiat sem. Mauris orci risus, commodo quis condimentum quis, vestibulum quis libero. Etiam sit amet tellus pharetra, ultrices libero non, tempor massa. Integer congue dapibus velit vitae lacinia. Vivamus eu enim ipsum. Ut egestas enim consequat consequat gravida. Nunc in tortor vulputate, suscipit lectus sed, ultricies sem. Proin eu tincidunt lorem. Vestibulum turpis est, sodales eu euismod in, lobortis at elit. Maecenas lacinia vestibulum lectus. Nullam pellentesque ornare commodo.
            </h2>
            <p class="rating">Rating: </p>
            <p class="actors">Actors: </p>
            <p class="director">Director: </p>
            <p class="writer">Writer: </p>
        </div>
    </div>
    <div class="info">
        <h3>
            Information
        </h3>
        <div class="info_child">
            <p class="status">Status: </p>
            <p class="aired">Aired: </p>
            <p class="source">Source: </p>
            <p class="genre">Genres: </p>
        </div>
    </div>

    <div class="row">
        <h5>Pictures</h5>
        <div class="row__posters">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
            <img src="https://picsum.photos/200/121" alt="a simple image" class="row__poster">
        </div>
    </div>
    <div class="row">
        <h6>Short Clips</h6>
        <div class="row__posters">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/D0NqJgcbHe8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="row__poster"></iframe>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/D0NqJgcbHe8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="row__poster"></iframe>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/D0NqJgcbHe8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="row__poster"></iframe>
        </div>
    </div>
    <div class="comment_box">
        <h6>Comment Section</h6>
        <div class="comment comment1">
            <p class="user">User1</p>
            
            <p class="comment_in">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Ut bibendum dui sit amet dolor laoreet, rutrum sagittis ante pretium. Donec tristique mi accumsan neque consequat porta. Aenean elit neque, vehicula quis porttitor a, cursus aliquam eros. Integer sit amet mi et libero semper condimentum. Ut nec leo euismod, fermentum neque eu, volutpat odio. Nulla eget dui auctor, venenatis quam sed, sagittis purus. In et dui sed sapien placerat consectetur vel non enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p class="rated">7.8</p>
        </div>
        <div class="comment">
            <p class="user">User1</p>
          
            <p class="comment_in">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p class="rated">7.6</p>
        </div>
        <div class="comment">
            <p class="user">User1</p>
           <p class="comment_in">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
           <p class="rated">7.9</p>
        </div>
    </div>
</body> 
</html>

