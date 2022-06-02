document.getElementById('login_button')
.addEventListener('click', login);

function login(e)
{
    //prevent default behaviour
    e.preventDefault();

    //get username and password
    let username = document.getElementById('login_username').value;
    let password = document.getElementById('login_password').value;

    //post the data to the address
    fetch('https://vira3.herokuapp.com/api/authentication/login.php', {
        method: "POST",
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-type':'application/json'
          },
        body:JSON.stringify({username:username, password:password})
        })
        .then((res) => console.log(res.text))
        //.then((data) =>
        //{
            console.log(data);
            // if(data['message'] == 'User not registered')
            // {
            //     //register error sent by the server
            //     document.getElementById('reg_error').classList.remove("register_neutral");
            //     document.getElementById('reg_error').classList.add("register_bad");

            //     //remove error
            //     setTimeout(function(){
            //         document.getElementById('reg_error').classList.remove("register_bad");
            //         document.getElementById('reg_error').classList.add("register_neutral");
            //       }, 2000);
            // }
            // else
            // {
            //     //register successfully
            //     document.getElementById('reg_good').classList.remove("register_neutral");
            //     document.getElementById('reg_good').classList.add("register_good");
                
            //     //remove message
            //     setTimeout(function(){
            //         document.getElementById('reg_good').classList.remove("register_good");
            //         document.getElementById('reg_good').classList.add("register_neutral");
            //       }, 2000);
            // }
        //})
}