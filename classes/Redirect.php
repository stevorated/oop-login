<?php

class Redirect{

    public static function to($location= null, $type='php'){
        if($location){
            if(is_numeric($location)){
                switch ($location) {
                    case 404:
                        header('Location: inc/errors/404.php');
                        
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