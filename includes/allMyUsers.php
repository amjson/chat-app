<?php
  $dispNav    = "SELECT * FROM users_records";
  $rundispNav = mysqli_query($con, $dispNav);

  echo "
    <li class='user_blank'>
      <a href=''>
        <i class='fa fa-times' aria-hidden='true'></i>
      </a>
    </li>
  ";

  while ($disp_row = mysqli_fetch_array($rundispNav)) {
    $dispNav_uname   = $disp_row['username'];
    $dispNav_profile = $disp_row['profile'];
    $dispNav_status  = $disp_row['status'];

    echo " 
      <li class='user_nav'>
        <div class='user_img'><img src='$dispNav_profile'></div>

        <div class='user_detail'>";
          if ($dispNav_status == 'Online') {
            echo "
              <p>
                <a href='chat.php?username=$dispNav_uname'>$dispNav_uname</a>
                <span style='rgba(0,0,0,.1);'><i class='fa fa-circle' aria-hidden='true'></i></span>
              </p>
            ";
          }
          else {
            echo "
              <p>
                <a style='color:rgba(0,0,0,.7);' href='chat.php?username=$dispNav_uname'>$dispNav_uname</a>
                <span style='rgba(0,0,0,.1);'><i class='fa fa-circle-o' aria-hidden='true'></i></span>
              </p>
            ";
          }
        "</div>
      </li>
    ";
  }
?>