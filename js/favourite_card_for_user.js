//every time this page is loaded, display all cards on screen
function getAndDisplayCards()
{
    let cards = '';
    fetch("https://vira3.herokuapp.com/api/favourite/read_user_favourites_and_display.php")
    .then((res) => res.json())
    .then((data) => {
        //here you start to edit the DOM
        let temp_data = data['data'];

        //display cards by genre
        let i=0;
        while(temp_data.length)
        {
            

            //created the row div
            const div = document.createElement('div');
            div.setAttribute('class', 'flex__vert');

            //create the movie card list
           

            

            //loop htrough the cards and add them to the row
            let cards = '';
            matching_movies.forEach(element => {
                cards += `<img src="${element['banner']}" class="card__opt__remove" onclick="location.href='movie_template.html?id=${element['id']}'" alt="${element['id']}" width="200" height="400">`;
            });
         
            

            //setting the cards
            cardsrow.innerHTML = cards;

            //appending the elements together
           
            div.appendChild(cardsrow);
            document.querySelector('body').appendChild(div);
        
            i++;
        }
    });
}

getAndDisplayCards();