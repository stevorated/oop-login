<?php

require_once 'core/init.php';

if(!$username = Input::get('user')){
    Redirect::to('index');
} else {
    $user = new User($username);
    if(!$user->exists()) {
        Redirect::to(404);
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo escape($user->data()->name); ?>'s Profile</title>

        </head>
        <body>
        <h1>Name: <?php echo escape($user->data()->name); ?></h1>
        <h1>Username: <?php echo escape($user->data()->username); ?></h1>
        <h1>Joind: <?php echo escape($user->data()->joined); ?></h1>
        <h2> <a href="../../index.php">Go Home?</a></h2>   
        </body>
        </html>
        
        <?php
    }

}


?>