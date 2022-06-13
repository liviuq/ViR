function getAndDisplayReviews(){
    let reviews='';
    fetch("https://vira3.herokuapp.com/api/review/read_movie_reviews.php")
    .then((res) => res.json())
    .then((data) =>{

        let temp_data = data['data'];
            while(temp_data.length){

                const div = document.createElement('div');
                div.setAttribute('class', 'comment');

                const p1 = document.createElement('p');
                p1.setAttribute('class','user');

                const p2 = document.createElement('p');
                p2.setAttribute('class','comment_in');

                const p3 = document.createElement('p');
                p3.setAttribute('class','rated');

                let review='';

                div.appendChild(p1);
                div.appendChild(p2);
                div.appendChild(p3);
                document.getElementById('reviews').appendChild(div);

            }
    });
}