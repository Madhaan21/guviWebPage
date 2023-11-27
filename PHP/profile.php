<?php
include_once("../conf/config.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="../CSS/profile.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".editButton").click(function(e){
                    e.preventDefault();
                    $.get($(this).attr("href"),function(data){
                        $("#result").html(data);
                    });
                    
                });
            });
        </script>

    </head>
    <body>
    <?php
        include_once("../PHP/fetch.php");
    ?>

                 <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                <img src="<?php echo $image; ?>" alt=""/>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                            <h5>
                                                <?php echo $firstname; ?>
                                            </h5>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">USER INFORMATION</a>
                                        </li>
    
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                
                                <a href="edit.php" class="logout-link editButton">Edit Profile</a><br><br>
                                <a href="logout.php" class="logout-link">Logout</a>
                            </div>
                        </div>
                        <div class="row" id="result">
                            <div class="col-md-2">
                                <a href="add.php" class="logout-link editButton">Additional Information</a><br><br>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>First Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $firstname;?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Last Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $lastname?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php echo $email?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Password</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><input type="password" name="password" readonly="" value="<?php echo $password?>"></p>
                                                    </div>
                                                </div>
                                                <div class="container" id="profileContainer">
                                                    <p>Age: <span id="age"></span></p>
                                                    <p>DOB:<span id="dob"></span></p>
                                                    <p>Email: <span id="email"></span></p>
                                                    <p>Contact: <span id="contact"></span></p>

                                                    <script>
                                                        // Fetch user data from PHP server
                                                        fetch('../PHP/api.php')
                                                            .then(response => {
                                                                if (!response.ok) {
                                                                    throw new Error('Network response was not ok');
                                                                }
                                                                return response.json();
                                                            })
                                                            .then(data => {
                                                                // Update profile details on the page
                                                                document.getElementById('age').textContent = data.age || 'Not Available';
                                                                document.getElementById('dob').textContent = data.dob || 'Not Available';
                                                                document.getElementById('email').textContent = data.email || 'Not Available';
                                                                document.getElementById('contact').textContent = data.contact || 'Not Available';
                                                            })
                                                            .catch(error => {
                                                                console.error('Error fetching data:', error);
                                                            });

                                                    </script>
                                                </div>

                                 </div>
                            </div>
                        </div>
                    </form>           
                </div>
        
    </body>
</html>
