function signup(){

    // takes the values form DOM
    var fullname = $("#signup_fullname").val();
    var email = $("#signup_email").val();
    var password = $("#signup_password").val();
    var address =  $("#signup_address_1").val() + ', ' + $("#signup_address_2").val() + ', ' + $("#signup_address_3").val() + ', ' + $("#signup_address_4").val() + ', ' + $("#signup_address_5").val();
    var address_1 = $("#signup_address_1").val();
    var address_2 = $("#signup_address_2").val();
    var address_3 = $("#signup_address_3").val();
    var address_4 = $("#signup_address_4").val();
    var address_5 = $("#signup_address_5").val();



    // Data validation
    var emailFilter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
        if (fullname.length == 0){
            Materialize.toast('Please enter your fullname.', 4000);
                return false;
        }
        if (!emailFilter.test(email)) {
            Materialize.toast('Please enter a valid e-mail address.', 4000)
            return false;
        }
        if (password.length == 0){
            Materialize.toast('Please enter your password.', 4000);
            return false;
        }
        if (address_1.length < 1){
            Materialize.toast('Address part 1 is too short.', 4000);
            return false;
        }
        if (address_2.length < 1){
            Materialize.toast('Address part 2 is too short.', 4000);
            return false;
        }
        if (address_3.length < 1){
            Materialize.toast('Address part City is too short.', 4000);
            return false;
        }
        if (address_4.length < 1){
            Materialize.toast('Address part State is too short.', 4000);
            return false;
        }
        if (address_5.length < 1){
            Materialize.toast('Address part Country is too short.', 4000);
            return false;
        }

        if (password.length < 8){
            Materialize.toast('Password requires atleast 8 characters.', 4000);
            return false;
        }
        if (address.length == 0){
            Materialize.toast('Please enter your full address.', 4000);
            return false;
        }
        else {
            var i=0;
            var comma_count=0
            for(i=0;i<address.length;i++)
                if(address[i]==',')
                    comma_count++;

                if(comma_count!=4){
                    Materialize.toast('Please enter your valid address.', 4000);
                    return false;
                }
        }

        // Ajax Request to signup.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var status = xhttp.responseText;
            console.log(status);
            if(status=="already")
                Materialize.toast('Memeber already exists.', 4000);
            else if(status=="notsuccessful")
                Materialize.toast('Sign Up not Successful.', 4000);
            else if( status == "successful"){
                Materialize.toast('Sign Up Successful.', 4000);
                //location.reload();
            }
            else if (status == "login")
                location.reload();
            else
                Materialize.toast('Unknown Error.', 4000);
            }
        };
        xhttp.open("GET", "signup.php?fullname="+fullname + "&email=" + email + "&password=" + password + "&address=" + address, true);
        xhttp.send();
    }


function login()
{
    // takes the values form DOM
    var username = $("#login_username").val();
    var password = $("#login_password").val();

    // Data validation
    var emailFilter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailFilter.test(username)) {
        alert('Please enter a valid e-mail address.');
        return false;
    }
    if (password.length == 0)
    {
        alert('Enter password');
        return false;
    }

    // Ajax Request to login_check.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {


            var status = xhttp.responseText;
            console.log(status);
            if(status=="loginpass")
                location.reload();
            else
                Materialize.toast('The username or password is not valid!', 4000) 				}
      };
      xhttp.open("GET", "login_check.php?username="+username + "&userpass=" + password, true);
      xhttp.send();
}
