<?php
  session_start();
  include("includes/my_db.php");

  if (!isset($_SESSION['email'])) {
    echo "<script>window.open('index.php', '_self')</script>";
    exit();
  }
  else { 
    if((time() - $_SESSION['initial_time']) > 600) { //time in seconds  
      $user     = $_SESSION['email'];
      $get_info = "SELECT * FROM users_records WHERE email='$user'";
      $run_info = mysqli_query($con, $get_info);
      $row      = mysqli_fetch_array($run_info);
      $myName   = $row['username'];
      
      $Offline = "UPDATE users_records SET status='Offline' WHERE username='".$myName."'";
      $sleep   = mysqli_query($con, $Offline);
      echo "<script>alert('Session expired after being inactive for long time')</script>";
      echo "<script>window.open('includes/logout.inc.php', '_self')</script>";
      exit();
    }
    else {
      $_SESSION['initial_time'] = time();
    }
  ?>  
  
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <!-- Meta tags -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="This is a personal website">
      <meta name="keywords" content="Joenest Chat, Joenest">
      <meta name="author" content="Joeson Misiani">

      <title>Joenest Chat</title>

      <!-- Favicons -->
      <link rel="icon" href="MyCustom/MyLogo.jfif" type="image/x-icon">

      <!--========== CSS & JQUERY ==========-->
      <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/all.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/v4-shims.min.css"> 
      <link rel="stylesheet" href="MyCustom/fileupload/bootstrap-fileupload.css">

      <script src="MyCustom/js/jquery.js"></script>
      <script src="MyCustom/js/bootstrap.min.js"></script>
    </head>
   
    <style>
      /* custom properties */
      :root {
        /* fonts family */
        --ff-primary: sans-serif;
        --ff-secondary: 'ubuntu';
        --ff-clock: 'digital-7 mono';

        /* font weight */
        --fw-s1: 300;
        --fw-s2: 400;
        --fw-s3: 500;
        --fw-s4: 600;

        /* color */
        --clr-light: #fff;
        --clr-dark: #000;
        --clr-lightDark: #444;
        --clr-gray: #767676;
        --clr-grey: #ccc;
        --clr-dodger: #1e90ff;

        /* box shadow */
        --bs: 0.25em 0.25em 0.75em rgba(0,0,0,.25),
              0.125em 0.125em 0.25em rgba(0,0,0,.15);
      }
      /* custom properties */

      * {
        margin: 0;
        padding: 0;
        outline:0;
        box-sizing: border-box;
      }
      a, a:hover {
        text-decoration: none; 
        outline:0; 
      }
      li {
        list-style: none;
      }
      body {
        margin:0;
        padding:0;
        border:0;
        outline:0;
        background-color: #ccc;
        overflow: hidden;
      }
      .whitePage {
        border: 1px solid transparent;
        box-shadow: var(--bs);
        background-color: var(--clr-light);
        width: 65%;
        height: 500px;
        transform: translate(-3%,16%);
        border-radius: 3px;
        padding: 0;
      }

      /* left box */
      .leftBox {
        border: 1px solid transparent;
        border-right: 1px solid var(--clr-grey); 
        height: 100%;
        padding-left: 0;
        padding-right: 0;
      }

      /* center box */
      .centerBox {
        border: 1px solid transparent;
        border-left: 1px solid var(--clr-grey); 
        border-right: 1px solid var(--clr-grey); 
        height: 100%;
        padding-left: 6px;
        padding-right: 6px;
      }    
      .layerthree {
        border: 1px solid transparent;
        margin-top: 0;
        margin-right: 0;
        width: 100%;
        height: 100%;
      }
      .mt {
        margin-top: 39px;
        border: none;
      }
      .content-panel {
        border: 1px solid var(--clr-grey);
        padding-top: 0;
        padding-bottom: 5px;
      }
      .panel-heading {
        border: none;
        font-size: 15px;
        margin-left: 0px;
        margin-right: 0px;
        text-transform: uppercase;
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s3);
      }
      .nav-tabs {
        background: #e0e1e7;
      }
      .nav-tabs a {
        color: #2f2f2f;
      }
      .detailed h4 {
        text-align: center;
        text-transform: uppercase;
        border-bottom: 1px solid #aaa;        
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s3);
        color: var(--clr-lightDark);
        margin-bottom: 0px;
        padding-bottom: 5px;
        word-spacing: 5px;
      }
      .MyInfo, .boxTwo  {
        width: 100%;
        border: 1px solid transparent;
        background-color: transparent;
        margin-top: 0px;
        padding-left: 0;
        padding-right: 0;
      }
      .mainInfo, .mainPwd {
        border: 1px solid transparent;
        width: 100%;
      }
      #forInfo, #forPwd {
        border: 1px solid transparent;
        width: 100%;
        margin-top: 0px;
        padding-left: 0;
        padding-right: 0;
      }
      #forInfo .jobInfo, #forPwd .job_body {
        border: none;
        padding-top: -10px;
      }
      #forInfo .boxInfo, #forPwd .box {
        width: 100%;
        height: 36px;
        border: 1px solid transparent;
        background-color: transparent;
        padding-left: 0;
        margin-top: 5px;
      }
      #forInfo .jobInfo input, #forPwd .job_body input {
        border: none;
        border-bottom: 1px solid #aaa;
        box-sizing: border-box;
        width: 100%;
        margin-top: 10px;
        outline: none;
        color: rgba(0,0,0,.7);
        background: transparent;     
        font-family: var(--ff-secondary);
        font-size: 16px;
      }
      #forInfo .inputWithIcon, #forPwd .inputWithIcon {
        position: relative;
      }
      #forInfo .inputWithIcon input, #forPwd .inputWithIcon input { 
        padding-left: 37px;
      }
      #forInfo .inputWithIcon i, #forPwd .inputWithIcon i { 
        position: absolute;
        top: 6px;
        left: 0;
        padding-top: 0px;
        padding-left: 8px;
        padding-bottom: 9px;
        padding-right: 8px;
        font-size: 17px;
      }
      #forInfo .inputWithIcon.inputIconBg i, #forPwd .inputWithIcon.inputIconBg i { 
        background-color: transparent;
        color: rgba(0,0,0,.7);
        padding-top: 6px;
        padding-left: 8px;
        padding-bottom: 10px;
        padding-right: 25px;
        border-radius: 5px 0 0 5px;
      }
      #forInfo .finalInfo, #forPwd .finalise {
        width: 100%;
        height: 45px;
        border: none;
        background-color: transparent;
        margin-top: 0px;
        padding-right: 0;
      }
      #forInfo .finalInfo .change, #forPwd .finalise .submit {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        letter-spacing: 2px;
        height: 30px;
        width: 85px;
        margin-top: 8px;     
        font-family: var(--ff-secondary);
        padding-top: 4px;
        padding-left: 15px;
        float: right;
      }
      #forInfo .finalInfo .change:hover, #forPwd .finalise .submit:hover {
        cursor: pointer;
        background: dodgerblue;
        opacity: .8;
      }
      .box-two {
        margin-left: 0px;
        border: 1px solid transparent;
        padding-top: 5px;
        padding-left: 0;
        max-height: 330px;
      }
      .disp {        
        margin-left: -30px;
      }
      .thumbnail {
        max-height: 280px !important;
      }   
      .btn-theme02 {
        background: rgba(0,0,0,.5);
        border-color: transparent;
        border-radius: 3px;
        border: 1px solid transparent;
        color: #fff;
        font-size: 15px;
        letter-spacing: 2px;
        height: 30px;
        margin-top: 8px;
        margin-left: 0px;
        font-family: var(--ff-secondary);
        padding-top: 2px;
      }
      .btn-theme02:hover {
        color: #fff;
        background: rgba(0,0,0,.5);
        opacity: .8;
      }
      .fileExists {
        background: dodgerblue;
        border-color: transparent;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        letter-spacing: 2px;
        height: 29px;
        margin-top: 8px;
        font-family: var(--ff-secondary);
        padding-top: 2px;
        position: absolute;
      }
      .fileExists:hover {
        color: #fff;
        background: dodgerblue;
        opacity: .8;
      }

      /* right box */
      .rightBox {
        border: 1px solid transparent;
        border-left: 1px solid var(--clr-grey); 
        height: 100%;
        padding: 0;
        padding-left: 3px; 
      }
    </style>
    
    <body>
      <section>
        <div class="col-lg-12 col-lg-offset-2 whitePage">
          <div class="col-md-3 leftBox">
            <?php include("includes/leftBar.php"); ?>
          </div>

          <div class="col-md-6 centerBox">

            <!-- ********************************************************************* -->

            <div class="layerthree">
            <div class="col-lg-12 mt">
              <div class="row content-panel">
                <div class="panel-heading">
                  <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                    <li><a data-toggle="tab" href="#photo">Photo</a></li>
                    <li><a data-toggle="tab" href="#password">Password</a></li>
                  </ul>
                </div>

                <div class="panel-body">
                  <div class="tab-content">
                    <?php
                      $user        = $_SESSION['email'];
                      $get_profile = "SELECT * FROM users_records WHERE email='$user'";
                      $run_profile = mysqli_query($con, $get_profile);
                      $row         = mysqli_fetch_array($run_profile);

                      $profile     = $row['profile'];
                      $fullname    = $row['fullname'];
                      $username    = $row['username'];
                      $phone       = $row['phone'];
                      $gender      = $row['gender'];
                      $email       = $row['email'];                     
                    ?>

                    <!-- [ start profile ] -->
                    <div id="profile" class="tab-pane  active">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                          <h4 class="mb">Edit profile</h4>

                          
<?php
    if (isset($_POST['forinfo'])) {   
        $fullname = htmlentities($_POST['forName']);
        $username = htmlentities($_POST['forUser']);
        $phone    = htmlentities($_POST['forPhone']);
        $gender   = htmlentities($_POST['forGender']);
        $email    = htmlentities($_POST['forEmail']);
        
        $update = "UPDATE users_records SET fullname='$fullname',username='$username',
        phone='$phone',gender='$gender',email='$email' WHERE email='$user'";

        $upgrade = mysqli_query($con, $update);

        if ($upgrade) {
            // parent directory
            $newUser    = $_GET["token"];
            $getNewUser = "SELECT * FROM users_records WHERE token='$newUser'";
            $resNewUser = mysqli_query($con, $getNewUser);

            if(mysqli_num_rows($resNewUser) == False) { 
            // leave blank
            }
            else {
                $main     = mysqli_fetch_assoc($resNewUser); 
                $mainUser = $main['username'];
            }

            // child directory
            $existing = $_GET["token"];
            $resexist = "SELECT * FROM users_chats WHERE sender_token='$existing'";
            $runexist = mysqli_query($con, $resexist);

            if(mysqli_num_rows($runexist) == False) { 
            // leave blank
            }
            else {
                $sub       = mysqli_fetch_assoc($runexist); 
                $existUser = $sub['sender_username']; 

                if($mainUser == $existUser) {
                // leave blank
                }
                else {
                    $fetchtoken = $_GET["token"];
                    $resToken = "SELECT * FROM users_chats WHERE sender_token='$fetchtoken'";
                    $tokenSQL = mysqli_query($con, $resToken);

                    // assign parent names with new names 
                    $newUserName = $mainUser;

                    // updating child directory with new names
                    $update  ="UPDATE users_chats SET sender_username='$newUserName' 
                    WHERE sender_token='$fetchtoken'";
                    $runUPDT = mysqli_query($con, $update);

                    /*========================================================*/
                    // parent directory
                    $newTwo = $_GET["token"];
                    $getTwo = "SELECT * FROM users_records WHERE token='$newTwo'";
                    $resTwo = mysqli_query($con, $getTwo);

                    if(mysqli_num_rows($resTwo) == False) { 
                    // leave blank
                    }
                    else {
                        $mainTwo     = mysqli_fetch_assoc($resTwo); 
                        $mainUserTwo = $mainTwo['username'];
                    }

                    // child directory
                    $exisTwo = $_GET["token"];
                    $restTwo = "SELECT * FROM users_chats WHERE receiver_token='$exisTwo'";
                    $runTwo  = mysqli_query($con, $restTwo);

                    if(mysqli_num_rows($runTwo) == False) { 
                      // leave blank
                    }
                    else {
                        $subTwo       = mysqli_fetch_assoc($runTwo); 
                        $existUserTwo = $subTwo['receiver_username']; 

                        if($mainUserTwo == $existUserTwo) {
                        // leave blank
                        }
                        else {
                            $myTwo = $_GET["token"];
                            $myRes = "SELECT * FROM users_chats WHERE receiver_token='$myTwo'";
                            $tokenSQL = mysqli_query($con, $myRes);

                            // assign parent names with new names 
                            $newTwo = $mainUserTwo;

                            // updating child directory with new names
                            $update  ="UPDATE users_chats SET receiver_username='$newTwo' 
                            WHERE receiver_token='$myTwo'";
                            $runExit = mysqli_query($con, $update);

                            // updating the status
                            $Offline = "UPDATE users_records SET status='Offline' WHERE email='$email'";
                            $update_msg = mysqli_query($con, $Offline);

                            echo "<script>window.open('includes/logout.inc.php', '_self')</script>";
                        }
                    }
                }
            }
        }
    }
?>

                          <div class="MyInfo">
                            <div class="mainInfo">
                              <form action="" method="post" id="forInfo" autocomplete="off">
                                <div class="jobInfo">
                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forName" value="<?php echo $fullname ?>">
                                      <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forUser" value="<?php echo $username ?>">
                                      <i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forPhone" value="<?php echo '0'.$phone ?>">
                                      <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="text" name="forGender" value="<?php echo $gender ?>">
                                      <i class="fa fa-venus fa-lg fa-fw" aria-hidden="true" 
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="boxInfo">
                                    <div class="inputWithIcon inputIconBg">
                                      <input type="text" name="forEmail" value="<?php echo $email ?>">
                                      <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true" 
                                      style="margin-top:3px"></i>
                                    </div>
                                  </div>

                                  <div class="finalInfo">
                                    <input type="submit" class="form-control change" 
                                    name="forinfo" value="update">  
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [ end profile ] -->

                    <!-- [ start photo ] -->
                    <div id="photo" class="tab-pane">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                          <h4 class="mb">Change photo</h4>

                          <?php 
                            if(isset($_POST['profilepic'])) {
                              $file = $_FILES['u_image'];
                    
                              $fileName    =  $_FILES['u_image']['name'];
                              $fileTmpName =  $_FILES['u_image']['tmp_name'];
                              $fileSize    =  $_FILES['u_image']['size'];
                              $fileError   =  $_FILES['u_image']['error'];
                              $fileType    =  $_FILES['u_image']['type'];
                            
                              $fileExt       =  explode('.', $fileName);
                              $fileActualExt =  strtolower(end($fileExt));
                            
                              $allowed = array('jpg', 'jpeg', 'png', 'jfif');
        
                              if(in_array($fileActualExt, $allowed)) {
                                if($fileError === 0) {
                                  if($fileSize < 10000000) {
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    $fileDestination = 'MyProfiles/'.$fileNameNew;
                                    unlink($profile);
                                    move_uploaded_file($fileTmpName, $fileDestination);

                                    $update = "UPDATE users_records SET profile='$fileDestination' 
                                    WHERE email='$user'";
                                    $run    = mysqli_query($con, $update);

                                    if ($run) {
                                      echo "<script>alert('Your Profile Updated successfully')</script>";
                                      echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                      exit();
                                    }
                                  }
                                  else {
                                    echo "<script>alert('Your file is too big')</script>";
                                    echo "<script>window.open('settings.php?token=$reUsedToken', 
                                    '_self')</script>";
                                    exit();
                                  }
                                }
                                else {
                                  echo "<script>alert('There was an error uploading your file')</script>";
                                  echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                  exit();
                                }
                              }
                              else {
                                echo "<script>alert('You cannot upload files of this type')</script>";
                                echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                exit();
                              }
                            }
                          ?>

                          <div class="col-lg-12 col-lg-offset-2 box-two">
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="col-md-2"></div>

                              <div class="col-md-8">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <!-- ============================================ -->
                                  <?php
                                    $user    = $_SESSION['email'];
                                    $getProf = "SELECT * FROM users_records WHERE email='$user'";
                                    $runProf = mysqli_query($con, $getProf);
                                  ?>

                                  <?php if(mysqli_num_rows($runProf) > 0) { 
                                    $resProf = mysqli_fetch_assoc($runProf);
                                    $newProf = $resProf['profile']; ?>
                                    
                                    <div class="fileupload-new thumbnail disp" 
                                    style="width:200px;">
                                      <img src='<?php echo $newProf; ?>' alt="">
                                    </div>
                        
                                  <?php } else { ?>
                                    <div class="fileupload-new thumbnail disp" 
                                    style="width:200px;height:160px;">
                                      <img src="MyCustom/images/placeholder.jpg" alt="placeholder" 
                                      width="86%">
                                    </div>
                                  <?php } ?> 
                                  <!-- ============================================ -->
                      
                                  <div class="fileupload-preview fileupload-exists thumbnail" 
                                  style="max-width:200px;max-height:200px;line-height:60px;">
                                  </div>

                                  <div>
                                    <span class="btn btn-theme02 btn-file">
                                      <span class="fileupload-new">Select image</span>
                                      <span class="fileupload-exists">Change</span>
                                      <input type="file" name="u_image" class="default">
                                    </span>

                                    <input type="submit" name="profilepic" value="Update"
                                    class="btn btn-theme04 fileupload-exists fileExists"> 
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-2"></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [ end photo ] -->

                    <!-- [ start password ] -->
                    <div id="password" class="tab-pane">
                      <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 detailed">
                          <h4 class="mb">Change password</h4>

                          <?php 
                            if(isset($_POST['forpassword'])) {
                              $c_pass = htmlentities($_POST['user_pass']);
                              $pass1  = htmlentities($_POST['u_pass1']);
                              $pass2  = htmlentities($_POST['u_pass2']);

                              if(empty($c_pass) || empty($pass1) || empty($pass2)) {
                                echo "<script>alert('You cant submit an empty form')</script>";
                                echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                exit();
                              } 
                              else {
                                $password_hash = $row['password'];
                            
                                if(password_verify($c_pass, $password_hash)) {
                                  if ($pass1 === $pass2) {
                                    if(strlen($pass1) > 9) {
                                      $user_recovery = $row['username'];

                                      $encript_pwd = password_hash($pass1, PASSWORD_BCRYPT);
                                      $update_pass = "UPDATE users_records SET password='$encript_pwd' 
                                      WHERE username='$user_recovery'";
                                      $run_pass    = mysqli_query($con, $update_pass);

                                      if ($run_pass) {
                                        echo "<script>alert('Next time you sign in, use your new password')</script>";
                                        echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                        exit();
                                      }
                                    }
                                    else {
                                      echo "<script>alert('Use atleast 9 characters in your password')</script>";
                                      echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                      exit();
                                    }
                                  }
                                  else {
                                    echo "<script>alert('Your password doesnt match with confirm password')</script>";
                                    echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                    exit();
                                  }
                                }
                                else {
                                  echo "<script>alert('Your password is invalid. Please try again')</script>";
                                  echo "<script>window.open('settings.php?token=$reUsedToken', '_self')</script>";
                                  exit();
                                }
                              }
                            }
                          ?>

                          <div class="boxTwo">
                            <div class="mainPwd">
                              <form action="" method="post" id="forPwd" autocomplete="off">
                                <div class="job_body">
                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="password" name="user_pass" 
                                      placeholder="Current Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg"> 
                                      <input type="password" name="u_pass1" 
                                      placeholder="New Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="box">
                                    <div class="inputWithIcon inputIconBg">
                                      <input type="password" name="u_pass2" 
                                      placeholder="Confirm Password">
                                      <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"
                                      style="margin-top:2px"></i>
                                    </div>
                                  </div>

                                  <div class="finalise">
                                    <input type="submit" class="form-control submit" 
                                    name="forpassword" value="change">  
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- [ end password ] -->

                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- ********************************************************************* -->

          </div>

          <div class="col-md-3 rightBox">
            <?php include("includes/rightBar.php"); ?>
          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/digital_clock.js"></script>
      <script src="MyCustom/fileupload/bootstrap-fileupload.js"></script>
    </body>
  </html>
<?php } ?> 