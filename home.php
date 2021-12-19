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
      .homepg {
        border: 1px solid transparent;
        margin-top: 35px;
        width: 97.5%;
      }
      .pgheader {
        border: 1px solid transparent;
        border-bottom: 1px solid var(--clr-lightDark);
        height: 30px;
        line-height: 30px;
        padding-left: 5px;
        color: var(--clr-lightDark);
        font-weight: var(--fw-s3);
        font-family: var(--ff-secondary);
        font-size: 13px;
        word-spacing: 5px;
        margin-bottom: 15px;
      }
      .pgheader span {
        color: dodgerblue;
      }
      .analyse {
        border: 1px solid transparent;
        float: left;
      }
      .iconDisplayTitle {
        border: none;
        border-radius: 3px;
        background: var(--clr-gray);
        height: 30px;
        line-height: 30px;
        margin-top: 20px;
      }
      .iconDisplay {
        border: none;
        border-radius: 3px;
        background: dodgerblue;
        height: 30px;
        line-height: 30px;
        margin-top: 20px;
      }
      .iconDisplayTitle p,
      .iconDisplay p {
        font-family: ubuntu;
        font-size: 14px;
        color: white;
        padding-left: 15px;
        padding-right: 30px;
      }
      .clock {
        position: relative;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        border: 2px solid var(--clr-gray);
        background-color: transparent;
        overflow: hidden;
        margin-top: 10px;
        margin-right: 10px;
        box-shadow: 0 4px 10px 0 rgb(0 0 0 / 26%), 0 4px 20px 0 rgb(0 0 0 / 25%);
        float: right;
      }
      .clock:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
      }
      .clock:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        background-color: black;
        border-radius: 50%;
        transform: translate(-50%, -50%);
      }
      .num {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        padding: 11px;
      }
      .num:after {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 5px;
        height: 15px;
        background-color: black;
      }
      .num1 { transform: rotate(30deg); }
      .num1 div { transform: rotate(-30deg); }
      .num2 { transform: rotate(60deg); }
      .num2 div { transform: rotate(-60deg); }
      .num3 { transform: rotate(90deg); }
      .num3 div { transform: rotate(-90deg); }
      .num4 { transform: rotate(120deg); }
      .num4 div { transform: rotate(-120deg); }
      .num5 { transform: rotate(150deg); }
      .num5 div { transform: rotate(-150deg); }
      .num6 { transform: rotate(180deg); }
      .num6 div { transform: rotate(-180deg); }
      .num7 { transform: rotate(210deg); }
      .num7 div { transform: rotate(-210deg); }
      .num8 { transform: rotate(240deg); }
      .num8 div { transform: rotate(-240deg); }
      .num9 { transform: rotate(270deg); }
      .num9 div { transform: rotate(-270deg); }
      .num10 { transform: rotate(300deg); }
      .num10 div { transform: rotate(-300deg); }
      .num11 { transform: rotate(330deg); }
      .num11 div { transform: rotate(-330deg); }
      .hand {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
      .hand div {
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #000;
      }
      .sec {
        width: 1px;
        height: 40%;
      }
      .min {
        width: 4px;
        height: 38%;
        border-radius: 2px;
      }
      .hour {
        width: 8px;
        height: 28%;
        border-radius: 4px;
      }
      .homeLayout {
        border:1px solid transparent;
        border-top: 1px solid var(--clr-lightDark);
        width: 100%;
        font-family: var(--ff-secondary);
        float: left;
        margin-top: 30px;
      }
      .homeLayout .one {
        font-size: 15px;
        color: var(--clr-dodger);
        border:1px solid transparent;
        margin-top: 20px;
        margin-bottom: 10px;
      }
      .homeLayout .two {
        border:1px solid transparent;
        font-size: 23px;
        font-family: serif;
        font-weight: var(--fw-s4);
        width: 100%;
        margin-bottom: 10px;     
      }
      .homeLayout .sub_two {
        margin-top: -10px;
      }
      .fname {
        font-family: ubuntu !important;
        font-size: 20px !important;
      }
      .clearFix {
        clear: both;
      }
      .textAnimator {
        border: 1px solid red;
        font-size: 20px;
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s2);
        margin-top: 5px;
        margin-left: 0;
        color: var(--clr-dark);
      } 
      .textAnimator span::after {
        content: "";
        position: relative;
        right: -5px;
        width: 5px;
        border-right: 1px solid var(--clr-dodger);
        animation: blink 0.5s infinite ease;
      }    
      @keyframes blink {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
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
            <?php
              $user        = $_SESSION['email'];
              $get_profile = "SELECT * FROM users_records WHERE email='$user'";
              $run_profile = mysqli_query($con, $get_profile);
              $row         = mysqli_fetch_array($run_profile);

              $fullname    = $row['fullname'];
              $username    = $row['username'];                    
            ?>

            <div class="homepg">
              <div class="pgheader">
                <span>JOENEST</span> / Overview
              </div>

              <div class="analyse">
                <div class="iconDisplayTitle">
                  <p>My Feedback</p>               
                </div>

                <div class="iconDisplay">
                  <?php
                    $getUsers = "SELECT * FROM users_records";
                    $resUsers = mysqli_query($con, $getUsers);
                    $allUsers = mysqli_num_rows($resUsers);

                    echo "<p>$allUsers Users</p>";
                  ?>                  
                </div>
                
                <div class="iconDisplay">
                  <?php
                    $user    = $_SESSION['email'];
                    $getName = "SELECT * FROM users_records WHERE email='$user'";
                    $runName = mysqli_query($con, $getName);
                    $resName = mysqli_fetch_array($runName);
                    $display = $resName['username'];

                    $getMessage = "SELECT * FROM users_chats WHERE receiver_username='$display' AND 
                    msg_status='unread' ";
                    $resMessage = mysqli_query($con, $getMessage);
                    $allMessage = mysqli_num_rows($resMessage);

                    if(($allMessage) == 0) { 
                      echo "<p>No New Messages</p>";
                    } else {
                      echo "<p>$allMessage New Messages</p>";
                    }
                  ?>
                </div>
              </div>

              <div class="clock">
                <div class="num num1"><div>1</div></div>
                <div class="num num2"><div>2</div></div>
                <div class="num num3"><div>3</div></div>
                <div class="num num4"><div>4</div></div>
                <div class="num num5"><div>5</div></div>
                <div class="num num6"><div>6</div></div>
                <div class="num num7"><div>7</div></div>
                <div class="num num8"><div>8</div></div>
                <div class="num num9"><div>9</div></div>
                <div class="num num10"><div>10</div></div>
                <div class="num num11"><div>11</div></div>
                <div class="num num12"><div>12</div></div>
                <div class="hand" id="sec"><div class="sec"></div></div>
                <div class="hand" id="min"><div class="min"></div></div>
                <div class="hand" id="hour"><div class="hour"></div></div>
              </div>

              <div class="homeLayout">
                <div class="one">Welcome to Joenest Chat App.</div>

                <div class="two sub_two">
                  Logged in as
                  <span class="txt-type" data-wait="800" data-words='["<?php echo $fullname ?>",
                    "<?php echo $username ?>"]'></span>
                </div>

                <div class="two sub_two fname"><?php echo $fullname ?> &nbsp Account</div>
              </div>

              <div class="clearFix"></div>
            </div>
          </div>

          <div class="col-md-3 rightBox">
            <?php include("includes/rightBar.php"); ?>
          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/digital_clock.js"></script>
      <script src="MyCustom/js/analog_clock.js"></script>
      <script src="MyCustom/js/txtAnimation.js"></script>
    </body>
  </html>
<?php } ?> 