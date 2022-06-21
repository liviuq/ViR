async function getFavJson(){
    const cookieValue = document.cookie
    .split('; ')
    .find(row => row.startsWith('token='))
    ?.split('=')[1];


const res = await fetch(`https://vira3.herokuapp.com/api/favourite/read_user_favourites.php`, {
    method: "GET",
    headers: {
        'Accept': 'application/json',
        'Content-type':'application/json',
        'Authorization': `Bearer ${cookieValue}`
    }
    });
    const reply = await res.json();
    console.log(reply);

    var str= JSON.stringify(reply);
    document.body.appendChild(document.createElement("pre")).innerHTML=str;
}
getFavJson();
