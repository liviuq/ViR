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
    
    //create the logout button
    const button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.setAttribute('class', 'button--toggle');
    button.setAttribute('id', 'logout__button');
    button.setAttribute('onclick', "location.href='index.php'");
    button.innerText = 'Logout';

    //append the button to header__buttons
    document.getElementById('header__buttons')
    .appendChild(button);
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

//add event listener for click on  logout button: id="logout__button"
const element = document.getElementById('logout__button');
if(element != null)
{
    element.addEventListener('click', logout);
}


function logout()
{
    //this only sets the cookie exp time to a past time
    document.cookie = "token=old; expires=Sat, 20 Jan 1980 12:00:00 UTC";
    document.location.reload(true);
    window.location = 'https://vira3.herokuapp.com/index.php';
}


