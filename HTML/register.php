<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="../CSS/register.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="form">
            <form autocomplete="off" id="regForm">
                <div class="banner">

                </div>
                <h1>CREATE AN ACCOUNT</h1>
                <div class="form-message"></div>
                <div class="row">
                    <div class="field column">
                        <label>First Name:</label>
                        <input type="text" name="firstname">
                    </div>
                    <div class="field column">
                        <label>Last Name:</label>
                        <input type="text" name="lastname" >
                    </div>
                </div>

                <div class="row">
                    <div class="field column">
                        <label>Email:</label>
                        <input type="email" name="email" >
                    </div>
                </div>
                <div class="row">
                    <div class="field column">
                        <label>Password:</label>
                        <input type="password" name="password" >
                    </div>
                    <div class="field column">
                        <label>Upload picture:</label>
                        <input type="file" name="file" >
                    </div>
                </div>
                <div class="row">
                    <div class="field column">
                        <input type="submit" name="submit_btn" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#regForm").on('submit',function(e){
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../PHP/signup.php",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData:false,

                        success:function(response){
                            $(".form-message").css("display","block");

                            if(response.status == 1){
                                $("#regForm")[0].reset();
                                $(".form-message").html('<p>'+response.message+'</p>');
                                window.location.href = 'login.php';
                            }
                            else{
                                $(".form-message").css("display","block");
                                $(".form-message").html('<p>'+response.message+'</p>');
                            }
                        }
                    });
                }); 

                $("#file").change(function(){
                    var file = this.files[0];
                    var fileType = file.type;
                    var match = ['image/jpeg','image/jpg','image/png'];
                    if(!((fileType == match[0]) || (fileType == match[1]) ||(fileType == match[2]) )){
                        alert("Sorry, only JPEG, JPG and PNG files are allowed to upload");
                        $("#file").val('');
                        return false;
                    }
                });
            });
        </script>

    </body>
</html>