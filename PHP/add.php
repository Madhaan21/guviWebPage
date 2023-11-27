<?php
include_once("../conf/config.php");
include_once("../PHP/fetch.php");
$email = '';
?>

<div class="row" id="result">
    <div class="col-md-4" id="dispMsg"></div>
    <div class="col-md-8">
        <form method="post" id="myForm">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">       
                    <div class="row">
                        <div class="col-md-6">
                            <label>Age</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="number" id="age" name="age" required></p>
                        </div>
                        <div class="col-md-6">
                            <label>Date of Birth:</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="date" id="dob" name="dob" required></p>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-md-6">
                    <label>Email</label>
                </div>
                <div class="col-md-6">
                    <p><input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"></p>
                </div>
            </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Contact</label>
                        </div>
                        <div class="col-md-6">
                            <p><input type="tel" id="contact" name="contact" required></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cols">
                            <input type="submit" name="submitBtn" class="logout-link" value="Insert">
                            
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

            var age = $("#age").val();
            var dob = $("#dob").val();
            var email = $("#email").val();
            var contact = $("#contact").val();
            
            $.ajax({
                url:"../PHP/add_in.php",
                type:"POST",
                dataType:"html",
                data:{age:age, dob:dob, email:email, contact:contact},
                success:function(data){
                    $("#dispMsg").html(data);
                }
            });
        });
    });
</script>