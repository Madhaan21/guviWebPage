<?php
include_once("../conf/config.php");
include_once("../PHP/fetch.php");
?>
<div class="row" id="result">
    <div class="col-md-4" id="dispMsg"></div>
    <div class="col-md-8">
        <form method="post" id="myForm">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">       
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>"></p>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Password</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="password" id="password" name="password" value="<?php echo $password; ?>"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cols">
                            <input type="submit" name="submitBtn" class="logout-link" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myForm").on('submit',function(e){
            e.preventDefault();

            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var password = $("#password").val();
            
            $.ajax({
                url:"../PHP/edit_in.php",
                type:"POST",
                dataType:"html",
                data:{firstname:firstname,lastname:lastname,password:password},
                success:function(data){
                    $("#dispMsg").html(data);
                }
            });
        });
    });
</script>