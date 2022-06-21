//get the ID we pass in the URL
const queryString = window.location.search;
const urlParameters = new URLSearchParams(queryString);

const id = urlParameters.get('id');

//fetch the movie with the passed id
fetch(`https://vira3.herokuapp.com/api/movie/read_single.php?id=${id}`)
    .then((res) => res.json())
    .then((data) =>
    {   
        //start changing values
        document.querySelector('title').innerText = data['title'];
        try {
            document.getElementById('banner').setAttribute('src', data['banner']);
        } catch (error) {
            console.log(error);
        }
        
        document.getElementById('synopsis').innerText = data['synopsis'];
        document.getElementById('rating').innerText = 'Rating: ' + data['rating'];
        document.getElementById('actors').innerText = 'Actors: ' + data['actors'];
        document.getElementById('director').innerText = 'Director: ' + data['director'];
        document.getElementById('writer').innerText = 'Writer: ' + data['writer'];
        document.getElementById('status').innerText = data['status'] == 0? 'Status: In progress' : 'Status: Completed';
        document.getElementById('aired').innerText = 'Aired: ' + data['aired'];
        document.getElementById('genre').innerText = 'Genre: ' + data['genre_name'];
    });


    let reviews='';
    fetch(`https://vira3.herokuapp.com/api/review/read_movie_reviews.php?id=${id}`)
    .then((res) => res.json())
    .then((data) =>{

        let temp_data = data['data'];
         
        temp_data.forEach(element => {
            //console.log(element);
            const div = document.createElement('div');
            div.setAttribute('class', 'comment');

            const p1 = document.createElement('p');
            p1.setAttribute('class','user');
            p1.innerText=element['username'];
            
            //userDATE
            const p8 = document.createElement('p');
            p8.setAttribute('class','userDATE');
            p8.innerText=element['created_at'];

            const p2 = document.createElement('p');
            p2.setAttribute('class','comment_in');
            p2.innerText=element['body'];

            const p3 = document.createElement('p');
            p3.setAttribute('class','rated');
            p3.innerText=element['rating'];

            div.appendChild(p1);
            div.appendChild(p8);
            div.appendChild(p2);
            div.appendChild(p3);
            document.getElementById('reviews').appendChild(div);
        });
       
    })
    .catch((error)=>{console.error(error);});
     

    //exista cookiu token
    document.getElementById('hidden_form_btn')
    .addEventListener("click",submitReview);

async function submitReview(e){
    e.preventDefault();

    //get review body, rating and cookie JWT
    let body = document.getElementById('text__area').value;
    let rating = document.getElementById('rating__value').value;
   
    const cookieValue = document.cookie
    .split('; ')
    .find(row => row.startsWith('token='))
    ?.split('=')[1];

    //create the POST request
    const res = await fetch(`https://vira3.herokuapp.com/api/review/create.php?id=${id}`, {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-type':'application/json',
            'Authorization': `Bearer ${cookieValue}`
            },
            body:JSON.stringify({body:body, rating:rating})
        });
    const reply = await res.json();
    
    if(reply.message.localeCompare("Invalid token")==0){
        alert("You need to be logged in to add to leave a review!")
    }
    document.location.reload(true);
    //marcu will do this
    
}

document.getElementById('addfav__button')
.addEventListener('click', addToFav);

async function addToFav()
{
    //check to see if we have the token
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('token='))
        ?.split('=')[1];
    const res = await fetch(`https://vira3.herokuapp.com/api/favourite/create.php?id=${id}`, {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-type':'application/json',
            'Authorization': `Bearer ${cookieValue}`
        }
        });
        const reply = await res.json();
        console.log(reply);
    

        //string_a.localeCompare(string_b)
        if(reply.message.localeCompare("Invalid token")==0){
            alert("You need to be logged in to add to favorite!")
        }
}

// document.getElementById('getfav__button__json')
// .addEventListener('click', getFavJson);

async function getFavJson(){
    window.location = "https://vira3.herokuapp.com/favourite_movies_user.php";
}

//add remove from fav functionality
document.getElementById('rmfav__button')
.addEventListener('click', rmFromFav);

async function rmFromFav()
{
    //check to see if we have the token
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('token='))
        ?.split('=')[1];
    const res = await fetch(`https://vira3.herokuapp.com/api/favourite/delete.php?id=${id}`, {
        method: "DELETE",
        headers: {
            'Accept': 'application/json',
            'Content-type':'application/json',
            'Authorization': `Bearer ${cookieValue}`
        }
        });
        const reply = await res.json();
        console.log(reply);
    

        //string_a.localeCompare(string_b)
        if(reply.message.localeCompare("Favourite not deleted")==0){
            alert("You need to be logged in to delete from favorites!")
        }
}