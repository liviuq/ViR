document.getElementById('login_button')
.addEventListener('click', login);

async function login(e)
{
    //prevent default behaviour
    e.preventDefault();

    //get username and password
    let username = document.getElementById('login_username').value;
    let password = document.getElementById('login_password').value;
    if(username.length == 0 || password.length == 0)
    {
        //flash wrong username or password
        document.getElementById('login_message').classList.remove("register_bad");
        document.getElementById('login_message').classList.remove("register_neutral");
        document.getElementById('login_message').classList.remove("register_good");

        document.getElementById('login_message').innerText = 'Wrong username or password';
        document.getElementById('login_message').classList.add("register_bad");

        //remove error
        setTimeout(function(){
            document.getElementById('login_message').classList.remove("register_bad");
            document.getElementById('login_message').classList.remove("register_neutral");
            document.getElementById('login_message').classList.remove("register_good");
            document.getElementById('login_message').classList.add("register_neutral");
          }, 2000);
    }
    else
    {
        //post the data to the address
        //thanks Marius for the await tips n tricks
        const res = await fetch('https://vira3.herokuapp.com/api/authentication/login.php', {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-type':'application/json'
            },
            body:JSON.stringify({username:username, password:password})
            });
        const body = await res.json();
        if(body['message'] == 'Wrong username or password')
        {
            //flash wrong username or password
            document.getElementById('login_message').classList.remove("register_bad");
            document.getElementById('login_message').classList.remove("register_neutral");
            document.getElementById('login_message').classList.remove("register_good");

            document.getElementById('login_message').innerText = 'Wrong username or password';
            document.getElementById('login_message').classList.add("register_bad");

            //remove error
            setTimeout(function(){
                document.getElementById('login_message').classList.remove("register_bad");
                document.getElementById('login_message').classList.remove("register_neutral");
                document.getElementById('login_message').classList.remove("register_good");
                document.getElementById('login_message').classList.add("register_neutral");
            }, 2000);
        }
        else if(body['message'] == 'Only POST actions are allowed')
        {
            //flash only post actions
            document.getElementById('login_message').classList.remove("register_bad");
            document.getElementById('login_message').classList.remove("register_neutral");
            document.getElementById('login_message').classList.remove("register_good");

            document.getElementById('login_message').innerText = 'Only POST actions are allowed';
            document.getElementById('login_message').classList.add("register_bad");

            //remove error
            setTimeout(function(){
                document.getElementById('login_message').classList.remove("register_bad");
                document.getElementById('login_message').classList.remove("register_neutral");
                document.getElementById('login_message').classList.remove("register_good");
                document.getElementById('login_message').classList.add("register_neutral");
            }, 2000);
        }
        else if(body['message'] == 'Internal server error')
        {
            //flash internal server error
            document.getElementById('login_message').classList.remove("register_bad");
            document.getElementById('login_message').classList.remove("register_neutral");
            document.getElementById('login_message').classList.remove("register_good");

            document.getElementById('login_message').innerText = 'Internal server error';
            document.getElementById('login_message').classList.add("register_bad");

            //remove error
            setTimeout(function(){
                document.getElementById('login_message').classList.remove("register_bad");
                document.getElementById('login_message').classList.remove("register_neutral");
                document.getElementById('login_message').classList.remove("register_good");
                document.getElementById('login_message').classList.add("register_neutral");
            }, 2000);
        }
        else
        {
            document.getElementById('login_message').classList.remove("register_bad");
            document.getElementById('login_message').classList.remove("register_neutral");
            document.getElementById('login_message').classList.remove("register_good");

            document.getElementById('login_message').innerText = 'Login successful';
            document.getElementById('login_message').classList.add("register_good");

            //remove error
            setTimeout(function(){
                document.getElementById('login_message').classList.remove("register_bad");
                document.getElementById('login_message').classList.remove("register_neutral");
                document.getElementById('login_message').classList.remove("register_good");
                document.getElementById('reg_error').classList.add("register_neutral");
            }, 2000);

            //what the
            //set cookie with the JWT
            let date = new Date();
            date.setTime(date.getTime() + (10 * 60 * 1000)); //10 min cookie
            const expires = date.toUTCString();
            document.cookie = `token=${body['message']}; expires=${expires}; path=/`;
            setTimeout(function(){
                window.location.href = "index.php";
            }, 2000);
        }
    }   
}