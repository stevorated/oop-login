<?php
    class Validate {
        private $_passed=false,
                $_errors = array(),
                $_db=null;
        
        public function __construct(){
            $this->_db= DB::getInstance();
        }

        public function check($source, $items){
            foreach($items as $item=>$rules){
                foreach($rules as $rule=>$rule_value) {
                    $value = trim($source[$item]);
                    $show_item= str_replace('_',' ',$item);
                    $show_rule_value= str_replace('_',' ',$rule_value);
                    if($rule ==='required' && empty($value)){
                        
                        $this->addError("{$show_item} is required");
                    } else if(!empty($value)) {
                        switch($rule){
                            case 'alphaNum':
                                if($rule_value = 'yes' && is_numeric($value)){
                                    $this->addError("{$show_item} must contain letters");
                                }
                            break;
                            case 'min':
                                if(strlen($value)<$rule_value){
                                    $this->addError("{$show_item} must be a MINIMUM of {$rule_value} letters");
                                }
                            break;
                            case 'max':
                                if(strlen($value)>$rule_value){
                                    $this->addError("{$show_item} must be a MAXIMUM of {$rule_value} letters");
                                }
                            break;
                            case 'matches':
                                if($value!==$source[$rule_value]){
                                    $this->addError("{$show_rule_value} must MATCH {$show_item}");
                                }
                            break;
                            case 'unique':
                                $check = $this->_db->get($rule_value,array($item,'=',$value));
                                if($check->count()){
                                    $this->addError("{$show_item} already EXISTS");
                                }
                            break;
                        }
                    }
                }
            }
                    if(empty($this->_errors)){
                        $this->_passed =true;
            }
            return $this;
        }

        private function addError($error){
            $this->_errors[] = $error;
        }
        
        public function errors(){
            return $this->_errors;
        }

        public function passed(){
            return $this->_passed;
        }
    }   

?> 