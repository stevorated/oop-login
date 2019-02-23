<?php


require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index');
}
$errors_list = '';
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            'name' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        )));
    if ($validation->passed()) {
        try {
          $user->update(array(
            'name'=>Input::get('name')
          ));
          Session::flash('home','Your Details Have been updated!.');
          Redirect::to('index');
        } catch (Exception $e) {
          die($e->getMessage);
        }
        } else {
            foreach ($validation->errors() as $error) {
            $errors_list .= $error.'<br>';
        }
    }

}
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Update Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">

  <link rel="stylesheet" href="assets/css/update.css">

</head>

<body>
  <div class="container img top text-center">
    <div class="col-xs-4 left">
      <form action="" method="post">
        <h1 class="lead text-weight-bold py-5">Update Details</h1>
        <div class="field">
          <label for="name">Name</label>
          <input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
          <!--  -->
          <input type="submit" value="Update">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
          <p class="mt-2 error"><?php echo $errors_list ; ?></p>
        </div>
      </form>
    </div>
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
