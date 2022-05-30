//every time this page is loaded, display all cards on screen
function getCards()
{
    fetch("https://vira3.herokuapp.com/api/card/read.php")
    .then((res) => res.json())
    .then((data) => {
        //here you start to edit the DOM
        let cards = '';
        let temp_data = data['data'];
        temp_data.forEach(element => {
            //console.log(element);
            cards += `<img src=${element['banner']} class="row__poster" onclick="location.href='movie_template.html?id=${element['id']}'">`;
        });

        document.getElementById('firstrow').innerHTML = cards;
    });
}

getCards();