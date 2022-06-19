//every time this page is loaded, display all cards on screen



function parseJWT(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};

async function getAndDisplayCards() {

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

        //document.getElementById('user__name').setAttribute('onclick', '');

        document.getElementById('user__name').setAttribute('onclick', "location.href='user_template.html'");
    }
    else
    {
        console.log('cookie undefined');
    }

    const res = await fetch(`https://vira3.herokuapp.com/api/favourite/read_user_favourites_and_display.php`, {
        method: "GET",
        headers: {
            'Accept': 'application/json',
            'Content-type': 'application/json',
            'Authorization': `Bearer ${cookieValue.split('=')[1]}`
        }
    });
    const reply = await res.json();
    console.log(reply);


    // let cards = '';
    // fetch("https://vira3.herokuapp.com/api/favourite/read_user_favourites_and_display.php")
    //     .then((res) => res.json())
    //     .then((data) => {
    //         //here you start to edit the DOM
    //         let temp_data = data['data'];

    //         //display cards by genre
    //         let i = 0;
    //         while (temp_data.length) {


    //             //created the row div
    //             const div = document.createElement('div');
    //             div.setAttribute('class', 'flex__vert');

    //             //create the movie card list




    //             //loop htrough the cards and add them to the row
    //             let cards = '';
    //             matching_movies.forEach(element => {
    //                 cards += `<img src="${element['banner']}" class="card__opt__remove" onclick="location.href='movie_template.html?id=${element['id']}'" alt="${element['id']}" width="200" height="400">`;
    //             });



    //             //setting the cards
    //             cardsrow.innerHTML = cards;

    //             //appending the elements together

    //             div.appendChild(cardsrow);
    //             document.querySelector('body').appendChild(div);

    //             i++;
    //         }
    //     });
}

getAndDisplayCards();