

</body>

<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/jquery-3.2.1.min.js"></script>


<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/bricklayer.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/TweenMax.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/login.js"></script>
<script src="<?php echo base_url() ?>/assets/js/toastr.js" type="text/javascript"></script>

<script>

$(document).ready(function() {

    var where = window.location.host;
    if(where == 'localhost:8899' || where == 'localhost' || where == '192.168.64.2'){
        var base_url = window.location.protocol + "//" + window.location.host + "/adv_dashboard/";
    }
    else{
        var base_url = window.location.protocol + "//" + window.location.host + "/";
    }

    $("#username").keypress(function(e) {
            if(e.which == 13) {
                tryLogin();
            }
    });
    $("#password").keypress(function(e) {
            if(e.which == 13) {
                tryLogin();
            }
    });
    
    function tryLogin(){
        $("#loginButton").click();
    }
    
    
    $("#loginButton").click(function(e) {
        var username = $("#username").val();
        var password = $("#password").val();
        
        loginButton.style.display = 'none'
        loadingGif.style.display = 'block';
        
        // console.log(username +"="+ password);
        if ($.trim(username).length == 0 || password =="") {
            // alert('input your username and password');
            loginButton.style.display = 'flex'
            loadingGif.style.display = 'none';
            toastr["error"]("Can't find username in our database", "Notification");
            e.preventDefault();
        }
        
            $.ajax({
            type: 'POST',
            url: base_url + 'login/user_login',
            dataType: 'json',
            data: {username : username, password: password}
            }).done(function (response) {
                if(response.status){
                    window.setTimeout(function(){ 
                        window.location = base_url
                        //toastr[response.type](response.msg, "Notification");
                    } ,2000);
                }else{
                   loginButton.style.display = 'flex'
                   loadingGif.style.display = 'none';
                   toastr[response.type](response.msg, "Notification");
                }
            });

        

    })
})

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

// $(document).on('click', '#loginButton', function(){
//     var username = $("#username").val();
//     var password = $("#password").val();

//     console.log(username +"="+ password);
//     // $.ajax({
//     //     type:"POST",//or POST
//     //     url:"<?php echo base_url(); ?>" + "login/user_login"
//     //     data:{username:username,password:password},
//     //     success:function(responsedata){
//     //         alert("got response as "+"'"+responsedata+"'");
//     //     }
//     // })

// });
</script>

</body>
</html>