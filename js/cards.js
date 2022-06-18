//every time this page is loaded, display all cards on screen
function getAndDisplayCards()
{
    let cards = '';
    fetch("https://vira3.herokuapp.com/api/card/read.php")
    .then((res) => res.json())
    .then((data) => {
        //here you start to edit the DOM
        let temp_data = data['data'];

        //display cards by genre
        let i=0;
        while(temp_data.length)
        {
            //get current genre
            let current_genre = temp_data[0]['genre_name'];

            //created the row div
            const div = document.createElement('div');
            div.setAttribute('class', 'row');

            //create the h2
            const h2 = document.createElement('h2');
            h2.innerText = current_genre;

            //create the movie card list
            const cardsrow = document.createElement('div');
            cardsrow.setAttribute('class', 'row__posters');

            //filter the array to get the matching genre movies
            const matching_movies = temp_data.filter(card => card['genre_name'] == current_genre);

            //loop htrough the cards and add them to the row
            let cards = '';
            matching_movies.forEach(element => {
                cards += `<img src="${element['banner']}" class="row__poster" onclick="location.href='movie_template.html?id=${element['id']}'" alt="${element['id']}" width="200" height="400">`;
            });
         
            //reassign temp_data to contain all the other movies except the ones with matching genre
            temp_data = temp_data.filter(card => card['genre_name'] != current_genre);

            //setting the cards
            cardsrow.innerHTML = cards;

            //appending the elements together
            div.appendChild(h2);
            div.appendChild(cardsrow);
            document.querySelector('body').appendChild(div);
        
            i++;
        }
    });
}

getAndDisplayCards();