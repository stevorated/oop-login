<?php

require_once 'core/init.php';

?>


<!-- form --------------------------------------- -->






  <?php 
$errors = '';

if(Input::exists()){
  if(Token::check(Input::get('token')));
}



if(Input::exists()) {
  $validate = new Validate();
  $validation = $validate->check($_POST,array(
    "username" => array(
      "required" => "true",
      "min" => 2,
      "max" => 20,
      "unique" => 'users',
      'alphaNum' =>'yes'
    ),
    "password" => array(
      "required" => "true",
      "min" => 6,
    ),
    "password_again" => array(
      "required" => "true",
      "min" => 6,
      "matches" => 'password'
    ),
    "name" => array(
      "required" => "true",
      "min" => 2,
      "max" => 50,
    )
  ));


  if($validation->passed()){
    $user = new User();
    $salt = Hash::salt(32);

    
    

    try {

      $user->create(array(
        'username'=> Input::get('username'),
        'password'=> Hash::make(Input::get('password'),$salt),
        'salt'=> $salt,
        'name'=> Input::get('name'),
        'joined'=> date('Y-m-d H:i:s'),
        'user_group'=> 1,
      ));

      Session::flash('home','Welcome You are now PART of the Crowd, Wise of you');
      // Redirect::to(404);
      Redirect::to('index');

    } catch (Exception $e) {
      die($e->getMessage());
    }

  } else {
    foreach($validation->errors() as $error){
      $errors .='<p class="">'. $error.'</p>';

    }
  }

  
} 




?>

<!doctype html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="assets/css/style.css">
</head> 
<body>  
  <div class="container-fluid text-center img">
    <div class="col-xs-4">
      <form action="" method="post">
        <h1 class="text-weight-bold py-5 lead form">Register</h1>

        <div class="field mt-3 ml-5">
          <label for="username"></label>
          <input type="text" name="username" value="<?php echo escape(Input::get('username')); ?>" id="username"
            placeholder="Username...">
        </div>

        <div class="field mt-3 ml-5">
          <label for="password"></label>
          <input type="password" name="password" value="" autocomplete="off" id="password" placeholder="Password...">
        </div>

        <div class="field mt-3 ml-5">
          <label for="password_again"></label>
          <input type="password" name="password_again" value="" autocomplete="off" id="password_again" placeholder="Password again...">
        </div>

        <div class="field mt-3 ml-5">
          <label for="name"></label>
          <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name" placeholder="name...">
        </div>

        <div class="field mt-3 ml-5">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
          <input type="submit" value="submit">

        </div>

        <div class="error-box text-center">
          <?php if($errors) {
        echo($errors);} ?>
        </div>
      </form>

    </div>



  </div>








  <!--  end of form --------------------------------------- -->




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