<?php
  session_start();
  include("includes/my_db.php");
  include("includes/findFriends.php");

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
        --clr-lightGray: #DCDCDC;
        --clr-gray: #767676;
        --clr-grey: #ccc;
        --clr-grey2: #e8e8e8;
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

      .friendSpace {
        border: 1px solid transparent;
        margin-top: 0;
        margin-right: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        position: relative;
      }
      .cover {
        border: 1px solid transparent;
        position: absolute;
        width: 100%;
        height: 100%;
      }
      .friends {
        height: 39px;
        margin-top: 0;
        background-color: var(--clr-grey);
      }
      .friends form {
        display: inline-block;
        border: 1px solid transparent;
        margin-top: 3px;
        margin-left: 40px;
        height: 32.5px;
        width: 337px;
        overflow: hidden;
      }
      .friends form input {
        float: right;
        width: 270px;
        height: 31px;
        margin-top: 0px;
        margin-right: 0px;
        padding: 0px 10px;
        border: 1px solid var(--clr-gray);
        background-color: var(--clr-light);
        color: var(--clr-lightDark);
        font-family: var(--ff-secondary); 
        font-size: 15px;
        outline: none;
      }
      .friends form input:focus {
        border: 1px solid var(--clr-dodger);
      }
      .friends form button {
        float: left;
        width: 65px;
        height: 34px;
        margin-top: -3px;
        margin-left:0px;
        border: 0;
        background-color: rgba(0,0,0,.5);
        font-family: var(--ff-secondary);
        font-size: 15px;
        color: var(--clr-light);
        cursor: pointer;
        border-radius: 0px;
      }
      .friends form button:hover {
        background-color: black;
        opacity: 0.7;
      }
      .friendsList {
        width: 100%;
        height: 92%;
        margin-top: 0;
        border: 1px solid transparent;
        overflow: hidden;
      }
      .displayFriend {
        border: 1px solid transparent;
        width: 105%;
        height: 97%;
        margin-top: 5px;
        overflow-y: scroll;
      }
      .card {
        background-color: var(--clr-lightGray);
        max-width: 350px;
        margin-left: 30px;
        font-family: var(--ff-secondary);
        border-radius: 4px;
        box-shadow: var(--bs);
        border: 1px solid transparent;
      }
      .card img {
        float: left;
        width: 75px;
        height: 75px;
        margin-top: 6px;
        margin-left: 20px;
        border-radius:50%;
        border: 1px solid var(--clr-gray);
      }
      .card h1 {
        border: 1px solid transparent;
        float: left;
        font-family: var(--ff-secondary);
        font-weight: var(--fw-s3);
        font-size: 18px;
        margin-top: 0;
        margin-left: 15px;
        color: var(--clr-lightDark);
      }
      .specify {
        margin-top: 10px;
        border: 1px solid transparent;
      }
      .title {
        border: 1px solid transparent;
        margin-bottom: 15px;
      }
      button {
        width: 100.4%;
        padding: 4px;
        font-size: 16px;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        margin-bottom: -1px;
        border: 1px solid dodgerblue;
        background-color: dodgerblue;
        color: var(--clr-light);
      }
      button:hover {
        opacity: 0.7;
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
            <div class="friendSpace">
              <div class="cover">
                <div class="friends">
                  <form action="" autocomplete="off">
                    <input type="text" name="search_query" placeholder="Find Friends" required>
                    <button type="submit" name="search_btn">Search</button>
                  </form>
                </div>

                <div class="friendsList">
                  <div class="displayFriend">
                    <br>
                    <?php search_user(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 rightBox">
            <?php include("includes/rightBar.php"); ?>
          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/digital_clock.js"></script>
    </body>
  </html>
<?php } ?> 