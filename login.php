<?php

require_once 'core/init.php';

$errors = '';

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            "username" => array(
                "required" => "true",
                "min" => 2,
                "max" => 20,
                'alphaNum' =>'yes'
              ),
              "password" => array(
                "required" => "true",
                "min" => 6
              )
        ));
        if($validation->passed()){
            $user = new User;
            $remember = (Input::get('remember') === 'on') ? true : false;

            $login = $user->login(Input::get('username'),Input::get('password'),$remember);
            if($login) {
                Redirect::to('index');
            } else {
                echo '<p>Sorry your details are wrong.</p>';
            }
        } else {
            foreach ($validation->errors() as $error){
              $errors .= '<p>'.$error.'</p>';
            }
        }
    }
}




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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="assets/css/style.css">

</head>
<!-- form --------------------------------------- -->





<body>

  <div class="container-fluid text-center img">
    <div class="col-xs-4">
      <form action="" method="post">
        <h1 class=" lead py-5 form">Login</h1>


        <div class="field mt-3 ml-5">
          <label class="mr-2 pb-2  lead" for="username"></label>
          <input type="text" name="username" value="<?php echo escape(Input::get('username')); ?>" id="username"
            placeholder="Username...">
        </div>


        <div class="field mt-3 ml-5">
          <label class="mr-2 pb-2  lead" for="password"></label>
          <input type="password" name="password" value="" autocomplete="off" id="password" placeholder="Password...">
        </div>


        <div class="field mt-3 ml-5 text-white lead">
          <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember me
          </label>
        </div>


        <div class="field mt-3 ml-5">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
          <input type="submit" value="submit">
        </div>

        <div class="error-box">
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