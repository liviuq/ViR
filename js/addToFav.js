//get the ID we pass in the URL
const urlParam = new URLSearchParams(window.location.search);

const id = urlParam.get('id');

document.getElementById('addfav__button')
.addEventListener('click', addToFav);

async function addToFav()
{
    //check to see if we have the token
    const cookieValue = document.cookie
    .split('; ')
    .find(row => row.startsWith('token='));
    if(cookieValue)
    {
        const res = await fetch(`https://vira3.herokuapp.com/api/favourite/create.php?id=${id}`, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-type':'application/json',
                'Authorization': `Bearer ${cookieValue}`
            }
            });
        const body = await res.json();
        console.log(body['message']);
    }
    else
    {
        console.log('cookie undefined');
    }
}