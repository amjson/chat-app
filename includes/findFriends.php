<?php
  include ("my_db.php");

	function search_user() {
		global $con; 

		if (isset($_GET['search_btn'])) {
			$search_query = htmlentities($_GET['search_query']);
			$get_user     = "SELECT * FROM users_records WHERE username like '%$search_query%'";
		}
		else {
			$get_user    = "SELECT * FROM users_records ORDER BY username DESC LIMIT 5";
		}

		$run_user  = mysqli_query($con, $get_user);

		while ($row_user = mysqli_fetch_array($run_user)) {
			$user_name    = $row_user['username'];
			$user_profile = $row_user['profile'];
			$phone        = $row_user['phone'];

			//now display all at once
			echo"
        <div class='card'>
            <img src='$user_profile'>
            <h1>
            	<p class='specify'>Phone &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 0$phone</p> 
            	<p class='title'>Username &nbsp $user_name</p> 
            </h1>
            <form method='post'>
                <button name='add' class='add'>Chat with $user_name</button>
            </form>
        </div><br>
        ";

      if (isset($_POST['add'])) {
          echo "<script>window.open('chat.php?username=$user_name', '_self')</script>";
      }
		}

	} 
?>