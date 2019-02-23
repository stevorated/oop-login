<?php

class Redirect{

    public static function to($location= null, $type='php'){
        if($location){
            if(is_numeric($location)){
                switch ($location) {
                    case 404:
                    header('HTTP/1.0 404 Not Found');
                    include('inc/errors/404.php');
                        exit();
                        break;
                }
            }
            header('Location: '. $location . '.' .$type);
            exit();
        }
    }


}
?>