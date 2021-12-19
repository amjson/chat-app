<style>
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
  }
  .bar i { 
    padding-left: 20px;
    font-size: 20px; 
  }
  .bar a {
    font-family: var(--ff-secondary);
    font-weight: var(--fw-s2);
    font-size: 17px;
    border: none;
    color: var(--clr-lightDark);
    margin-left: 33px;    
    transition: color 0.2s ease;
  }
  .bar a:hover {
    color: dodgerblue; 
  }  
</style>

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
        <a class='dropdown-item locate' href='includes/help.php?token=<?php echo $reUsedToken ?>'>Help</a>
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
          
          echo"<script>window.open('includes/logout.inc.php', '_self')</script>";
        }
      ?>
    </li>
  </ul>

  <div class="bottom-layer">
    <ul>
      <li class='bar'>
        <i class='fa fa-desktop fa-lg fa-fw' aria-hidden='true'></i>
        <a href='home.php?username=<?php echo $username ?>'>Home</a>
      </li>

      <li class='bar'>
        <i class='fa fa-comments-o fa-lg fa-fw' aria-hidden='true'></i>
        <!-- from chat to procopy  -->
        <a href='chat.php?username=<?php echo $username ?>'>Chat</a>
      </li>

      <li class='bar'>
        <i class='fa fa-users fa-lg fa-fw' aria-hidden='true'></i>
        <a href='friends.php?username=<?php echo $username ?>'>Friends</a>
      </li>

      <li class='bar'>
        <i class='fa fa-calendar fa-lg fa-fw' aria-hidden='true'></i>
        <a href='calendar.php?username=<?php echo $username ?>'>Calendar</a>
      </li>

      <li class='bar'>
        <i class='fa fa-wrench fa-lg fa-fw' aria-hidden='true'></i>
        <a href='settings.php?token=<?php echo $reUsedToken ?>'>Settings</a>
      </li>
    </ul>
  </div>
</div>