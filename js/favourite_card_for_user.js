

async function getAndDisplayCardsFavourites()
{
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('token='));
    if (cookieValue) {
        //we have the cookie
        tokenValue = cookieValue.split('=')[1];

        //decode the cookie
        JWTdecoded = parseJWT(tokenValue);
        let username = JWTdecoded['username'];

        //instead of login/register, we display user's username
        document.getElementById('user__name').innerText = `Hello, ${username}`;

        document.getElementById('user__name').setAttribute('onclick', "location.href='user_template.html'");


        //fetching favourite cards
        const res = await fetch(`https://vira3.herokuapp.com/api/favourite/read_user_favourites_and_display.php`, {
        method: "GET",
        headers: {
            'Accept': 'application/json',
            'Content-type': 'application/json',
            'Authorization': `Bearer ${tokenValue}`
        }
        });
        const reply = await res.json();
        
        //constructing the favourite row
        let temp_data = reply['data'];

        //creating the div s

        //created the row div
        const div = document.createElement('div');
        div.setAttribute('class', 'row');

        //create the h2
        const h2 = document.createElement('h2');
        h2.innerText = 'Your favourite movies!';

        //create the movie card list
        const cardsrow = document.createElement('div');
        cardsrow.setAttribute('class', 'row__posters');

        //loop through the cards and add them to the row
        let cards = '';
        temp_data.forEach(element => {
            cards += `<img src="${element['banner']}" class="row__poster" onclick="location.href='movie_template.html?id=${element['id']}'" alt="${element['id']}" width="200" height="400">`;
        });
        console.log(cards);
        //setting the cards
        cardsrow.innerHTML = cards;

        //appending the elements together
        div.appendChild(h2);
        div.appendChild(cardsrow);
        document.querySelector('body').appendChild(div);
        
    }
    else
    {
        console.log('cookie undefined');
    }
}

getAndDisplayCardsFavourites();