<style>
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

  <div class='disphoto'><img src='<?php echo $profile ?>' alt='profile photo'></div>

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