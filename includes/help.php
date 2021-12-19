<?php
  session_start();
  include("my_db.php");

  if (!isset($_SESSION['email'])) {
    echo "<script>window.open('../index.php', '_self')</script>";
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
      echo "<script>window.open('logout.inc.php', '_self')</script>";
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
      <link rel="icon" href="../MyCustom/MyLogo.jfif" type="image/x-icon">

      <!--========== CSS & JQUERY ==========-->
      <link rel="stylesheet" href="../MyCustom/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="../MyCustom/fontawesome-free/css/all.css">
      <link rel="stylesheet" href="../MyCustom/fontawesome-free/css/v4-shims.min.css"> 

      <script src="../MyCustom/js/jquery.js"></script>
      <script src="../MyCustom/js/bootstrap.min.js"></script>
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
      .layertwo {
        margin-top: 0;
        margin-left: 0;
        width: 100%;
        height: 100%;
        border: 1px solid transparent;
      }
      .blur,.focused {
        position: relative;
        font-weight: var(--fw-s4);
        margin: 0px;
        background: none;
        font-family: var(--ff-secondary);
        color: var(--clr-light);
        letter-spacing: 0.5px;
        text-transform: uppercase;
      }
      .section_logo {
        border: 1px solid transparent;
        border-bottom: 1px solid var(--clr-grey);
        width: 70%;
        height: 40px;
        cursor: pointer;
        padding-top: 7px;
      }
      .section_logo-big {
        position: relative;
        width: 100%;
        text-align: center;
      }
      .section_logo-big .blur {
        position: absolute;
        top: 0;
        line-height: 27px;
        font-size: 1.7em;
        width: 100%;
      }
      .section_logo-big .blur a {
        color: #999;
        opacity: .6;
      }
      .section_logo-small {
        display: inline-block;
      }
      .focused a {
        color: var(--clr-dark);
        letter-spacing: 1.7px;
      }
      .section_logo-small strong {
        color: var(--clr-dodger);
        opacity: 0.9;
      }
      .section_logo-big h3 {
        margin-top: 4px;
        padding-top: 4px;
        padding-left: 5px;
        padding-right: 4px;
        padding-bottom: 5px;
        line-height: 10px;
        position: relative;
        display: inline-block;
        font-size: .9em;
      }
      .section_logo-big .focused:before {
        bottom: 0;
        left: 0;
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        opacity: 1;
        border-bottom: 1px solid var(--clr-dodger);
        border-left: 1px solid var(--clr-dodger);
      }
      .section_logo-big .focused:after {
        top: 0;
        right: 0;
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        opacity: 1;
        border-top: 1px solid var(--clr-dodger);
        border-right: 1px solid var(--clr-dodger);
      }

      .dropMenu {
        border: 1px solid transparent;
        border-bottom: 1px solid var(--clr-grey);
        height: 40px;
        width: 65px;
        position: absolute;
        margin-top: -40px;
        margin-left: 150px;
      }
      .dropMenu .caret {
        border:1px solid transparent;
        height: 38px;
        line-height: 40px;
        width: 100%;
        margin-left: 0;
        font-size: 18px;
        padding-left: 30px;
      }
      .dropMenu .caret a {
        color: var(--clr-lightDark);
        cursor: pointer;
      }
      .dropMenu .caret .drop_me_down {
        margin-left: -98px;
        padding-left: 15px;
        box-shadow: var(--bs);
      }
      .dropMenu .caret .drop_me_down .locate {
        font-family: var(--ff-secondary);
        font-size: 18px;
      }

      .form_exit input {
        font-family: var(--ff-secondary);
        font-size: 18px;
        border: none;
        box-sizing: border-box;
        outline: none;
        background: transparent;
        cursor: pointer;
        color: var(--clr-lightDark);    
        transition: color 0.2s ease;
      }
      .form_exit input:hover {
        color: dodgerblue;
        background: none;
        box-shadow: none;
        text-decoration: none;
      }

      .bottom-layer {
        border: 1px solid transparent;
        width: 100%;
      }
      .bottom-layer ul {
        border: 1px solid transparent;
        width: 100%;
      }
      .bar {
        border: 1px solid transparent;
        width: 100%;
        height: 40px;
        line-height: 40px;
        margin-top: 8px;
        margin-left: 0;
        opacity: .7;
      }
      .bar i { 
        padding-left: 19px;
        font-size: 20px; 
        border: 1px solid transparent;
      }
      .bar p {
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s2);
        font-size: 17px;
        border: 1px solid transparent;
        color: var(--clr-lightDark);
        margin-top: -41px;
        margin-left: 61.5px;    
        transition: color 0.2s ease;
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
      .mytitle {
        position: relative;
        text-align: center;
        font-size: 30px;
        font-weight: var(--fw-s3);
        margin-bottom: 25px;
        padding-bottom: 15px;
        font-family: var(--ff-secondary);
        color: var(--clr-dark);
      }
      .mytitle::before { 
        content: "";
        position: absolute;
        bottom: 0px;
        left: 50%;
        width: 160px;
        height: 3px;
        background: var(--clr-dark);
        transform: translateX(-50%);
      }
      .mytitle::after {
        content: "get in touch";
        position: absolute;
        bottom: -10px;
        left: 50%;
        padding: 5px;
        background: var(--clr-light);
        font-size: 18px;
        color: var(--clr-dodger);
        transform: translateX(-50%);
      }
      .contact {
        border: 1px solid transparent;
        margin-top: 21px;
      }
      .contact form .fields {
        display: flex;
      }
      .contact form .field,
      .contact form .fields .field {
        height: 45px;
        width: 100%;
        margin-bottom: 15px;
      }
      .contact form .name {
        margin-right: 10px;
      }
      .contact form .email {
        margin-left: 10px;
      }
      .contact form .textarea {
        height: 110px;
        width: 100%;
      }
      .contact form .field input,
      .contact form .textarea textarea  {
        height: 100%;
        width: 100%;
        border: 1px solid var(--clr-gray);
        color: var(--clr-gray);
        font-family: var(--ff-secondary);
        border-radius: 5px;
        outline: none;
        padding: 0 15px;
      }
      .contact form .textarea textarea  {
        padding-top: 10px;
        resize: none;
      }
      .contact form .button {
        height: 35px;
        width: 120px;
      }
      .contact form .button button {
        height: 100%;
        width: 100%;
        border: 2px solid var(--clr-dodger);
        background: var(--clr-dodger);
        color: var(--clr-light);
        font-family: var(--ff-secondary);
        font-size: 15px;
        font-weight: var(--fw-s2);
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      .contact form .button button:hover {
        background: var(--clr-dodger);
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
      .rightBox-top {
        border: 1px solid transparent;
        border-bottom: 1px solid var(--clr-grey);
        width: 100%;
        height: 55%;
      }
      .section_time {
        border: 1px solid transparent;
        border-bottom: 1px solid var(--clr-grey);
        width: 100%;
        height: 40px;
        cursor: pointer;
      }
      .digitSix {
        border: 1px solid transparent;
        text-align: center;
        font-size: 25px;
        font-weight: var(--fw-s4);
        font-family: var(--ff-clock);
        color:  var(--clr-dark);
        width: 100%;
        height: 38px;
        line-height: 38px;
      }
      .disphoto {
        border: none;
        border-radius: 50%;
        margin-top: 25px;
        margin-left: 40px;
        width: 60%;
        height: 46%;
        box-shadow: var(--bs);
      }
      .disphoto img {
        border: 1px solid var(--clr-grey);
        border-radius: 50%;
        width: 100%;
        height: 100%;
      }
      .forNames {
        border: 1px solid transparent;
        margin-top: 10px;
        width: 100%;
        height: 55px;
      }
      .forNames h5 {
        color: var(--clr-dark);
        font-family: var(--ff-secondary);
        font-size: 17px;
        text-align: center;
        font-weight: var(--fw-s4);
      }
      .rightBox-bottom {
        border: 1px solid transparent;
        width: 100%;
        height: 45%;
        padding-left: 8px;
        padding-right: 5px;
      }
      .rightBox-bottom h2 {
        font-family: var(--ff-secondary);
        font-size: 20px;
        border: none;
        border-bottom: 1px solid var(--clr-gray);
        color: var(--clr-dark);
        margin-top: 10px;  
        padding-bottom: 0px;
      }
      .rightBox-bottom .dispInfo {
        font-family: var(--ff-secondary);
        font-size: 15px;
        border: none;
        border-bottom: 1px solid var(--clr-grey);
        color: var(--clr-dark);
        margin-top: 10px; 
        display: flex;
        justify-content: space-between;
      }
    </style>
    
    <body>
      <section>
        <div class="col-lg-12 col-lg-offset-2 whitePage">
          <div class="col-md-3 leftBox">
            <div class="layertwo">
              <div class="section_logo">
                <div class="section_logo-big"> 
                  <h1 class="blur"><a href="">Joenest</a></h1>

                  <h3 class="focused">
                    <a href="">
                      <span class="section_logo-small">Joe<strong>nest</strong></span>
                    </a>
                  </h3>
                </div>
              </div> 

              <?php
                $user        = $_SESSION['email'];
                $get_profile = "SELECT * FROM users_records WHERE email='$user'";
                $run_profile = mysqli_query($con, $get_profile);
                $row         = mysqli_fetch_array($run_profile);

                $profile     = $row['profile'];
                $fullname    = $row['fullname'];
                $username    = $row['username'];
                $reUsedToken = $row['token'];                     
              ?>

              <ul class="dropMenu">
                <li class='nav-item dropdown caret'>
                  <a class='nav-link' id='navbarDropdownProfile' data-toggle='dropdown'
                  aria-haspopup='true' aria-expanded='false'>
                    <i class='fa fa-sign-in fa-lg fa-fw' aria-hidden='true'></i>
                  </a>

                  <div class='dropdown-menu dropdown-menu-right drop_me_down' 
                  aria-labelledby='navbarDropdownProfile'>
                    <a class='dropdown-item locate' href='../home.php?username=<?php echo $username ?>'>
                      Back
                    </a>

                    <div class='dropdown-item locate form_exit'>
                      <form action='' method='post'>
                        <input type='submit' name='exit' value='Logout'>
                      </form>
                    </div>
                  </div>

                  <?php
                    if(isset($_POST['exit'])) {      
                      $Offline   = "UPDATE users_records SET status='Offline' WHERE username='".$username."' ";
                      $update_msg = mysqli_query($con, $Offline);
                      
                      echo"<script>window.open('logout.inc.php', '_self')</script>";
                    }
                  ?>
                </li>
              </ul>

              <div class="bottom-layer">
                <ul>
                  <li class='bar'>
                    <i class='fa fa-desktop fa-lg fa-fw' aria-hidden='true'></i>
                    <p>Home</p>
                  </li>

                  <li class='bar'>
                    <i class='fa fa-comments-o fa-lg fa-fw' aria-hidden='true'></i>
                    <p>Chat</p>
                  </li>

                  <li class='bar'>
                    <i class='fa fa-users fa-lg fa-fw' aria-hidden='true'></i>
                    <p>Friends</p>
                  </li>

                  <li class='bar'>
                    <i class='fa fa-calendar fa-lg fa-fw' aria-hidden='true'></i>
                    <p>Calendar</p>
                  </li>

                  <li class='bar'>
                    <i class='fa fa-wrench fa-lg fa-fw' aria-hidden='true'></i>
                    <p>Settings</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-6 centerBox">
            <h2 class="mytitle">Need Help</h2>
            <div class="contact">
              <form method="POST" action="contact.php" autocomplete="off">
                <div class="fields">
                  <div class="field name">
                    <input type="text" name="fullname" placeholder="Name" required>
                  </div>

                  <div class="field email">
                    <input type="email" name="email" placeholder="Email" required>
                  </div>
                </div>

                <div class="field">
                  <input type="text" name="subject" placeholder="Subject" required>
                </div>

                <div class="field textarea">
                  <textarea name="message" cols="30" rows="10" placeholder="Write your message here" required></textarea>
                </div>

                <div class="button">
                  <button type="submit" name="send">Send message</button>
                </div>              
              </form>
            </div>
          </div>

          <div class="col-md-3 rightBox">
            <?php
              $user     = $_SESSION['email'];
              $get_user = "SELECT * FROM users_records WHERE email='$user'";
              $run_user = mysqli_query($con, $get_user);
              $row      = mysqli_fetch_array($run_user);
              $fname    = $row['fullname'];
              $uname     = $row['username'];
              $phone    = $row['phone'];
              $gender   = $row['gender'];
              $profile  = $row['profile'];
            ?>

            <div class="rightBox-top">
              <div class="section_time">
                <div id="MyClockDisplay" class="digitSix"></div>
              </div> 

              <div class='disphoto'>
                <img src='../<?php echo $profile ?>' alt='profile photo'>
              </div>

              <div class='forNames'>
                <h5><?php echo $fname ?></h5>
                <h5><?php echo $uname ?></h5>
              </div>
            </div>

            <div class="rightBox-bottom">
              <h2>Joenest</h2>

              <div class="dispInfo">
                <span>Full name</span>
                <span><?php echo $fname ?></span>
              </div>

              <div class="dispInfo">
                <span>Username</span>
                <span> <?php echo $uname ?></span>
              </div>

              <div class="dispInfo">
                <span>Phone</span>
                <span><?php echo '0'.$phone ?></span>
              </div>

              <div class="dispInfo">
                <span>Gender</span>
                <span> <?php echo $gender ?></span>
              </div>
            </div>

          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="../MyCustom/js/digital_clock.js"></script>
    </body>
  </html>
<?php } ?> 