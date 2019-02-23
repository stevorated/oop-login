<?php

require_once 'core/init.php';


if(Session::exists('home')){
    echo "<p>" . Session::flash('home') ."</p>" ;
}

$user = new User();

if($user->isLoggedIn()){
?>
<html lang="en">

<head>
  <title>login page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

  <link rel="stylesheet" href="assets/css/style.css">

</head>
<!-- form --------------------------------------- -->

<body>

  <div class="container-fluid img top">
    <div class="col-9">
      <h1 class="header">Hello <a href="profile.1.php?user=<?php echo escape($user->data()->username) ?>"><?php echo escape($user->data()->name) ?></a></h1>

      <ul>
        <li><a href="logout.php">Log Out</a></li>
        <li><a href="update.php">Update Details</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
        <li></li>
        <li></li>
      </ul>
      <?php
      if($user->hasPermission('admin')){
        echo '<h4>Hello there Mister Admin..</h4>';
      }
} else {
  echo('<h1 class="header">You need to <a href="login.php">Log in</a> Or <a href="register.php">Register</a></h1>');
}



?>

    </div>
    <!--  end of form --------------------------------------- -->

  </div>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>