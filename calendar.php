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
      /*-- calendar --*/
      .centerBox-bottom {
        border: none;
        margin-top: 40px;
        padding-left: 0;
        padding-right: 0;
      }
      .calendar {
        margin: auto;
        width: 100%;
        background: #fff;
        /*box-shadow: var(--bs);*/
        border: 1px solid var(--clr-grey);
      }
      .month {
        font-family: var(--ff-secondary);
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        width: 100%;
        color: #fff;
        background-color: dodgerblue;
        padding-left: 20px;
        padding-right: 20px;
      }
      .prev, .next {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        width: 35px;
        height: 26px;
        border-radius: 3px;
        background-color: var(--clr-light);
        color: var(--clr-lightDark);
        border: none;
        cursor: pointer;
      }
      #month {
        font-size: 30px;
      }
      .weekends {
        font-family: var(--ff-secondary);
        display: flex;
        color: #fff;
        background-color: dodgerblue;
        opacity: .8;
        padding: 7px 0;
      }
      .weekends div, .days div {
        width: 14.28%;
        text-align: center;
      }
      .days {
        display: flex;
        flex-wrap: wrap;
        font-family: sans-serif;
        padding: 10px 0;
      }
      .days div {
        margin-bottom: 10px;
        padding: 10px 0;
        transition: all 0.4s;
      }
      .days div:hover {
        background-color: #dfe6e9;
        cursor: pointer;
      }
      .prev_date {
        color: #999;
      }
      .today {
        color: #fff;
        background-color: dodgerblue;
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
    
    <body onload="RenderDate()">
      <section>
        <div class="col-lg-12 col-lg-offset-2 whitePage">
          <div class="col-md-3 leftBox">
            <?php include("includes/leftBar.php"); ?>
          </div>

          <div class="col-md-6 centerBox">
            <!-- calendar -->
            <div class="centerBox-bottom">
              <div class="calendar"> 
                <div class="month">
                  <div class="prev" onclick="moveDate('prev')">
                    <span>&#10094</span>
                  </div>

                  <div>
                    <h2 id="month"></h2>
                    <p id="date_str"></p>
                  </div>

                  <div class="next" onclick="moveDate('next')">
                    <span>&#10095</span>
                  </div>
                </div>

                <div class="weekends">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>

                <div class="days"></div>
              </div>
            </div>
            <!-- calendar -->
          </div>

          <div class="col-md-3 rightBox">
            <?php include("includes/rightBar.php"); ?>
          </div>
        </div>                   
      </section>

      <!--============ javascript Files ============-->
      <script src="MyCustom/js/digital_clock.js"></script>
      <!-- <script src="MyCustom/js/cal1.js"></script> -->
    </body>
  </html>
<?php } ?> 