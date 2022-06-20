//check to see if we have the token
const cookieValue = document.cookie
.split('; ')
.find(row => row.startsWith('token='));
if(cookieValue)
{
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


function parseJWT (token)
{
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};


document.getElementById("csv__button")
.addEventListener("click",parseCSV);

document.getElementById("rss__button")
.addEventListener("click",showRSS);

function parseCSV(){
    //fetch the movie with the passed id 
    window.location = "https://vira3.herokuapp.com/api/stat/csv.php";
}

function showRSS(){
    window.location = "https://vira3.herokuapp.com/api/rss/rss.php";
}

document.getElementById('search__bar')
.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        window.location = `https://vira3.herokuapp.com/search.html?string=${document.getElementById('search__bar').value}`;
    }
});




