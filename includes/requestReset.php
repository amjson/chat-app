<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'PHPMailer/src/credential.php';

  if (isset($_POST["email"])) 
  {  
    include("includes/my_db.php");
    session_start();

    $mailTo  = $_POST["email"];

    $email_inquiry = "SELECT * FROM users_records WHERE email='".$mailTo."' ";
    $run_inquiry   = mysqli_query($con, $email_inquiry);

    if (mysqli_num_rows($run_inquiry) == 0) 
    {
      echo "<script>alert('Your Email is invalid')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
      exit();
    }
    else
    {
      $mailTo  = $_POST["email"];
      $token   = uniqid(true);
      $pwd_change = "INSERT INTO pwd_request(user_token,user_email)VALUES('$token','$mailTo')";
      $run_request  = mysqli_query($con, $pwd_change);

      if (!$run_request) {
        exit("Your Password request had an Error");
      }
    
      $mail   = new PHPMailer(true);
      try  
      {
        //Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';  
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = EMAIL;                     
        $mail->Password   = PASS;                             
        $mail->SMTPSecure = 'tls';                   
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom(EMAIL, 'Joenest Chat');
        $mail->addAddress($mailTo);                   
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');   

        // Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpass.php?token=$token";

        $mail->isHTML(true);                                  
        $mail->Subject = 'Joenest Chat send you a password reset link';
        $mail->Body    = "<h3 align=center>
                            Request : You requested a password rest<br>
                            Link : clink <a href='$url'>remote talk</a> to do so
                          </h3>";
                          

        $mail->send();
        echo "<script>alert('Reset Password link has been sent to your email')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
        exit();
      } 
      catch (Exception $e)
      {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        exit();
      }  
      exit();
    }
  }
?>