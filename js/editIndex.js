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

    document.getElementById('user__name').className('onclick') = '';

    document.getElementById('user__name').className('onclick') = ' location.href=\'user_template.html\'\" ';
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