//every time this page is loaded, display all cards on screen
function getCards()
{
    fetch("https://vira3.herokuapp.com/api/card/read.php")
    .then((res) => res.json())
    .then((data) => {
        //here you start to edit the DOM
    });
}

getCards();