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
      <link rel="icon" href="MyCustom/images/aj.png" type="image/x-icon">

      <!--========== CSS & JQUERY ==========-->
      <link rel="stylesheet" href="MyCustom/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/all.css">
      <link rel="stylesheet" href="MyCustom/fontawesome-free/css/v4-shims.min.css"> 

      <script src="MyCustom/js/jquery.js"></script>
      <script src="MyCustom/js/bootstrap.min.js"></script>
    </head>
   
    <style>
      /* custom properties */
      :root {
        /* fonts family */
        --ff-primary: sans-serif;
        --ff-secondary: 'ubuntu';
        --ff-brid: 'Trebuchet MS';
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
        /*overflow: hidden;*/
      }
      .whitePage {
        border: 1px solid transparent;
        box-shadow: var(--bs);
        background-color: var(--clr-light);
        width: 65%;
        height: 500px;
        /*min-height: 500px;*/
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
        border: none;
        border-left: 1px solid var(--clr-grey); 
        border-right: 1px solid var(--clr-grey); 
        height: 100%;
        padding-left: 0;
        padding-right: 0;
        overflow: hidden;
      }

      /*forNotifyTab*/
      .notifyTab {
        display: flex;
        justify-content: space-between;
        background-color: rgba(0,0,0,0.3);
        width: 100%;
      } 
      .userProfile {
        border: 1px solid transparent;
        padding: 3px 8px;
      }
      .userProfile .o2 {
        border: 1px solid transparent;
        float: left;
      }
      .userProfile .o2 img {
        width: 50px;
        height: 50px;
        border: 2px solid #6B6F79;
        border-radius: 50%;
      }
      .userProfile .o1 {
        border: 1px solid transparent;
        float: left;
        padding: 0 15px;
      }
      .userProfile .o1 p {
        border: 1px solid transparent;
        font-size:20px;
        font-family:Trebuchet MS;
        margin-top: -2px;
        margin-bottom: 0;
        color: #6B6F79;
      }
      .userProfile .o1 span {
        border: 1px solid transparent;
        font-size:16px;
        color: #fff;
        font-family: Bahnschrift;
      }
      .backColor {
        border: none;
        padding-right: 8px;
        padding-top: 5px;
      }
      .burger {
        display: inline-block;
        border: 1px solid transparent;
      } 
      .burger div {
        width: 23px;
        height: 3px;
        background-color: white;
        margin: 4px;
        transition: all 0.2s ease;
        cursor: pointer;
      }
      .nav-links {
        position: absolute;
        left: -1vh;
        top: 0;
        height: 100vh;
        background-color: #A9A9A9;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 40%;
        transform: translateX(-100%);
        transition: transform 0.5s ease-in-out !important;
        z-index: 99;
        box-shadow: var(--bs);
      }
      .user_blank {
        border: 1px solid transparent;
        width: 100%;
        height: 40px;
      }
      .user_blank i {
        font-size: 17px;
        color: var(--clr-light);
        float: right;        
        margin: 10px 10px;
      }
      .user_nav {
        border: 1px solid transparent;
        border-bottom: 1px solid #6B6F79;
        width: 100%;
        height: 50px;
        margin-bottom: 5px;
      }
      .user_img {
        float: left;
        width: 40px;
        height: 100%;
        border: 1px solid transparent;
        margin-left: 10px;
      }
      .user_img img {
        width: 100%;
        height: 85%;
        border: 2px solid #6B6F79;
        border-radius: 50%;
      }
      .user_detail {
        float: right;
        height: 100%;
        border: 1px solid transparent;
      }
      .user_detail p {
        display: flex;
        justify-content: space-between;
        padding: 0 5px;
        border: 1px solid transparent;
      }
      .user_detail p a {
        color: var(--clr-light);
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s2);
        font-size: 15px;
      }
      .user_detail p span {
        padding-left: 10px;
        font-size: 15px;
      }
      .nav-active {
        transform: translateX(0%);
      }
      .toggle .line1 {
        transform: rotate(-45deg) translate(-5px,5px);
      }
      .toggle .line2 {
        opacity: 0;
      }
      .toggle .line3 {
        transform: rotate(45deg) translate(-5px,-5px);                  
      }

      /*forChatSpace*/
      .chatSpace {
        border: 1px solid transparent;
        background-color: #E6E6FA;
        width: 100%;
        padding: 0 23px;
        overflow-y: scroll;
      } 
      .chatSpace ul li {
        list-style: none;
        margin-top: 15px;
      }
      .chatSpace .leftside_chat p,
      .chatSpace .rightside_chat p {
        padding: 5px 10px;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        font-size: 15px;
        font-family: var(--ff-brid);
      }
      .chatSpace .leftside_chat {
        float: left;
        width: 70%;
        position: relative;
      }
      .chatSpace .leftside_chat p {
        background-color: #00BFFF;
        color: var(--clr-dark);
      }
      .chatSpace .leftside_chat:before {
        content: " ";
        position: absolute;
        top: 14px;
        left: -12px;
        border: 13px solid transparent;
        border-bottom-color: #00BFFF;
        z-index: 1;
        transform: rotate(180deg);
        margin-top: -14px;
      }
      .chatSpace .leftside_chat span {
        color: black;
        float: left;
        font-size: 13px;
        font-family: Trebuchet MS;
        background: #00BFFF;
        border: 1px solid transparent;
        border-top: 1px solid #ccc;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        margin-top: -10px;
        width: 100%;
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .chatSpace .leftside_chat span small {
        float: right;
        padding-top: 2px;
      }
      .chatSpace .rightside_chat {
        float: right;
        width: 70%;
        position: relative;
      }
      .chatSpace .rightside_chat p {
        background-color: #C0C0C0;
        color: var(--clr-dark);
      }
      .chatSpace .rightside_chat:before {
        content: " ";
        position: absolute;
        top: 14px;
        left: 256px;
        border: 13px solid transparent;
        border-bottom-color: #C0C0C0;
        z-index: 1;
        transform: rotate(180deg);
        margin-top: -14px;
      }
      .chatSpace .rightside_chat span {
        color: black;
        float: right;
        font-size: 13px;
        font-family: Trebuchet MS;
        background: #C0C0C0;
        border: 1px solid transparent;
        border-top: 1px solid #ccc;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        margin-top: -10px;
        width: 100%;
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .chatSpace .rightside_chat span small {
        float: right;
        padding-top: 2px;
      }

      /*scrollbar */
      ::-webkit-scrollbar { /* width */
        width: 7px;
      }
      ::-webkit-scrollbar-track { /* Track */
        box-shadow: inset 0 0 5px grey; 
        /*border-radius: 4px;*/
      }
      ::-webkit-scrollbar-thumb { /* Handle */
        background: grey; 
        border-radius: 4px;
      }
      ::-webkit-scrollbar-thumb:hover { /* Handle on hover */
        background: grey;
      }

      /*forForm*/
      .textBox {
        background-color: rgba(0,0,0,0.3);
        width: 100%;
        height: 80px;
      } 
      .textBox form {
        height: 100%;
        border: none;
        padding: 9px 17px; 
      }
      .textBox form textarea {
        background-color: #fff;
        color: var(--clr-lightDark);
        width:86%;
        height:63px;
        font-family: var(--ff-secondary);
        resize: none;
        padding: 2px 7px;
        border-radius: 3px;
        line-height: 17px;
      }
      .textBox form .send_cancel {
        border: none;
        width: 10%;
        height: 64px;
      }
      .textBox form .send_cancel button {
        background: transparent;
        border: none;
        border-radius: 3px;
        margin-bottom: 9px;
      }
      .textBox form .send_cancel button i {
        background-color: dodgerblue;
        color: white;
        font-size: 20px;
        padding-top: 3px;
        padding-left: 15px;
        padding-bottom: 3px;
        padding-right: 15px;
        border-radius: 5px;
      }
      .textBox form .send_cancel a {
        background: transparent;
        border: none;
        border-radius: 3px;
        color: red;
      }
      .textBox form .send_cancel a i {
        width: 100%;
        background-color: red;
        color: white;
        font-size: 20px;
        padding-top: 3px;
        padding-left: 13px;
        padding-bottom: 3px;
        padding-right: 5px;
        border-radius: 5px;
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
            <!-- [ start 1st row ] -->
            <div class="notifyTab">
              <!-- getting the user information who is logged in -->
              <?php
                $user     = $_SESSION['email'];
                $get_user = "SELECT * FROM users_records WHERE email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row      = mysqli_fetch_array($run_user);
                
                $user_name    = $row['username'];
                $sender_token = $row['token'];
              ?>

              <!-- getting the user data on which user click -->
              <?php
                if (isset($_GET['username'])) {
                  global $con;

                  $get_username = $_GET['username'];
                  $get_user     = "SELECT * FROM users_records WHERE username='$get_username'";
                  $run_user     = mysqli_query($con, $get_user);
                  $row_user     = mysqli_fetch_array($run_user);

                  $username           = $row_user['username'];
                  $user_profile_image = $row_user['profile'];
                  $user_status        = $row_user['status'];
                  $receiver_token     = $row_user['token'];
                  $account_user       = $row_user['username'];
                }

                $total_messages = "SELECT * FROM users_chats WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                $run_messages   = mysqli_query($con, $total_messages);
                $total          = mysqli_num_rows($run_messages);
              ?>

              <div class="backColor">
                <ul class="nav-links">
                  <?php include("includes/allMyUsers.php"); ?>
                </ul>

                <div class="burger">
                  <div class="line1"></div>
                  <div class="line2"></div>
                  <div class="line3"></div>
                </div>
              </div>

              <div class="userProfile">
                <div class="o1">
                  <p>
                    <?php 
                      $account_user = $row_user['username'];
                      echo $account_user;
                    ?>
                  </p>

                  <span><?php echo $total; ?>&nbsp messages</span>
                </div>

                <div class="o2">
                  <img src='<?php echo "$user_profile_image"; ?>' alt='profile photo'>
                </div>
              </div>
            </div>
            <!-- [ end 1st row ] -->

            <!-- [ start 2nd row ] -->
            <div class="chatSpace" id="scrolling_to_bottom">
              <!-- Retrieving the message from the database -->
              <?php
                $update_msg = mysqli_query($con, "UPDATE users_chats SET msg_status='read' WHERE 
                sender_username='$username' AND receiver_username='$user_name'");
                
                $sel_msg    = "SELECT * FROM users_chats WHERE (sender_username='$user_name' 
                AND receiver_username='$username') OR (receiver_username='$user_name' AND 
                sender_username='$username') ORDER BY 1 ASC";
                
                $run_msg    = mysqli_query($con, $sel_msg);

                while ($row = mysqli_fetch_array($run_msg)) 
                {
                  $sender_username   = $row['sender_username'];
                  $receiver_username = $row['receiver_username'];
                  $msg_content       = $row['msg_content'];

                  $msg_date = strftime("%b %d, %Y", strtotime($row["msg_date"])); ?>

                  <ul>
                    <?php
                      if($user_name == $sender_username AND $username == $receiver_username) { 
                        // The sender
                        $getSender = $_SESSION['email'];
                        $runSender = "SELECT * FROM users_records WHERE email='$getSender'";
                        $resSender = mysqli_query($con, $runSender);
                        $dispRow   = mysqli_fetch_assoc($resSender);
                        $owner     = $dispRow['username'];

                        echo "
                          <li>
                            <div class='rightside_chat'>
                              <p>$msg_content</p>

                              <span>$owner &nbsp&nbsp <small>$msg_date</small></span>
                              <br>
                            </div>
                          </li>
                        "; 
                      }
                      else if ($user_name == $receiver_username AND $username == $sender_username) { 
                        // The receiver
                        $forSender = $_GET["username"];
                        $resSender = "SELECT * FROM users_records WHERE username='$forSender'";
                        $runSender = mysqli_query($con, $resSender);
                        $getSender = mysqli_fetch_assoc($runSender);
                        $friend    = $getSender['username'];
                        
                        echo "
                          <li>
                            <div class='leftside_chat'>
                              <p>$msg_content</p>

                              <span>$friend &nbsp&nbsp <small>$msg_date</small></span>
                              <br>
                            </div>
                          </li>
                        ";                            
                      }
                    ?>
                  </ul>
                <?php } 
              ?>
            </div>
            <!-- [ end 2nd row ] -->

            <!-- [ start 3rd row ] -->
            <div class="textBox">
              <?php 
                if (isset($_POST['submit'])) {
                  $msg = htmlentities($_POST['msg_content']);

                  if ($msg == "") {
                    echo "<script>alert('Error you cannot send empty message.')</script>";
                    echo "<script>window.open('chat.php?username=$username', _self')</script>";
                  }
                  else if (strlen($msg) > 150) {
                    echo "<script>alert('Error your message was too long to send.')</script>";
                    echo "<script>window.open('chat.php?username=$username', '_self')</script>";
                  }
                  else {
                    $insert = "INSERT INTO users_chats(sender_username,sender_token,
                    receiver_username,receiver_token,msg_content,msg_status,msg_date) 
                    VALUES('$user_name','$sender_token','$username','$receiver_token',
                    '$msg','unread', now())";
                    $run_insert = mysqli_query($con, $insert);

                    if ($run_insert) {                        
                      echo "<script>window.open('chat.php?username=$username', '_self')</script>";
                    }
                  }
                }
              ?>

              <form method="post">
                <textarea autocomplete="off" type="text" name="msg_content" 
                placeholder="Write your message ..." style="float:left;"></textarea>

                <div class="send_cancel" style="float:right;">
                  <button name="submit">
                    <i class="fa fa-angle-right" aria-hidden="true" title="send"></i>
                  </button>

                  <a href='<?php echo "chat.php?username=$username" ?>' title="cancel">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                  </a>
                </div>
              </form>
            </div>
            <!-- [ end 3rd row ] -->
          </div>

          <div class="col-md-3 rightBox">
            <?php include("includes/rightBar.php"); ?>
          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/digital_clock.js"></script>

      <script type="text/javascript">
        // ---- [ for sideBar ] ---- //
        const navSlide = () => {
          const burger = document.querySelector('.burger');
          const nav = document.querySelector('.nav-links');
          
          // when the burger is clicked use function below 
          burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');

            //burger animation
            burger.classList.toggle('toggle');
          }); 

          // when the nav is clicked use function below 
          nav.addEventListener('click', () => {
            nav.classList.remove('nav-active');

            //burger animation
            burger.classList.toggle('toggle');
          });
        }
        navSlide();
        
        // ---- [ for chatSpace ] ---- //
        // auto scroll downwards
        $('#scrolling_to_bottom').animate({
        scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);

        // height
        $(document).ready(function(){
          var height = $(window).height();
          $('.chatSpace').css('height', (height - 310) + 'px');
        });
      </script>
    </body>
  </html>
<?php } ?> 