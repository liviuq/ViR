//get the ID we pass in the URL
const queryString = window.location.search;
const urlParameters = new URLSearchParams(queryString);
console.log(urlParameters.get('id'));
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