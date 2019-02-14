<?php

class User {
    private $_db;

    public function __construct($user= null) {
        $this->_db = DB::getInstance();
    }

    public function create(){
        if(!$this->_db->insert('users',$fields=array()));
        throw new Exception('There was a PROBLEM CREATING the user.');
    }


}



?>