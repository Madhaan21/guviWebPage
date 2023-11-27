<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="../CSS/login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="form">
            <form autocomplete="off" id="LogForm">
                <div class="banner">

                </div>
                <h1>LOGIN</h1>
                <div class="form-message"></div>

                <div class="row">
                    <div class="field column">
                        <label>Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="field column">
                        <label>Password:</label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>
                <div class="row" style="float: right; margin-right:10%; width: auto;">
                    <div class="field column">
                        <input type="checkbox" name="remember_me">
                        <label class="remember_me">Remember Me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="field column">
                        <input type="submit" name="submit_btn" value="Sign in">
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                // Retrieve login details from localStorage if available
                var storedEmail = localStorage.getItem('email');
                var storedPassword = localStorage.getItem('password');

                if (storedEmail && storedPassword) {
                    $("#email").val(storedEmail);
                    $("#password").val(storedPassword);
                }

                $("#LogForm").on('submit',function(e){
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../PHP/login.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData:false,

                        success:function(response){
                            $(".form-message").css("display","block");

                            if(response.status == 1){
                                // Store login details in localStorage
                                localStorage.setItem('email', $("#email").val());
                                localStorage.setItem('password', $("#password").val());

                                $("#LogForm")[0].reset();
                                $(".form-message").html('<p>'+response.message+'</p>');
                            }
                            else{
                                $(".form-message").css("display","block");
                                $(".form-message").html('<p>'+response.message+'</p>');
                            }
                        }
                    });
                });
            });
        </script>


    </body>
</html>

<?php
if(isset($_COOKIE['email']) || isset($_COOKIE['password'])){
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

    echo "<script>document.getElementById('email').value = '$email'</script>";
    echo "<script>document.getElementById('password').value = '$password'</script>";
}
?>