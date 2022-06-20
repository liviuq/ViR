document.getElementById('register_button')
.addEventListener('click', register);

function register(e)
{
    //prevent default behaviour
    e.preventDefault();

    //get email, username and password
    let email = document.getElementById('reg_email').value;
    let username = document.getElementById('reg_username').value;
    let password = document.getElementById('reg_password').value;
    if(email.length == 0 || username.length == 0 || password.length == 0)
    {
        //register error sent by the server
        document.getElementById('reg_error').classList.remove("register_neutral");
        document.getElementById('reg_error').classList.add("register_bad");

        //remove error
        setTimeout(function(){
            document.getElementById('reg_error').classList.remove("register_bad");
            document.getElementById('reg_error').classList.add("register_neutral");
          }, 2000);
    }
    else
    {
        //post the data to the address
        fetch('https://vira3.herokuapp.com/api/user/create.php', {
        method: "POST",
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-type':'application/json'
          },
        body:JSON.stringify({email:email, username:username, password:password})
        })
        .then((res) => res.json())
        .then((data) => {
            if(data['message'] == 'User not registered')
            {
                //register error sent by the server
                document.getElementById('reg_error').classList.remove("register_neutral");
                document.getElementById('reg_error').classList.add("register_bad");

                //remove error
                setTimeout(function(){
                    document.getElementById('reg_error').classList.remove("register_bad");
                    document.getElementById('reg_error').classList.add("register_neutral");
                  }, 2000);
            }
            else
            {
                //register successfully
                document.getElementById('reg_good').classList.remove("register_neutral");
                document.getElementById('reg_good').classList.add("register_good");
                
                //remove message
                setTimeout(function(){
                    document.getElementById('reg_good').classList.remove("register_good");
                    document.getElementById('reg_good').classList.add("register_neutral");
                  }, 2000);
            }
        })
    }
}