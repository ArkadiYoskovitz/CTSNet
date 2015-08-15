<?php

class User {

    protected $data = array();

    public function __construct($id)
    {
        $this->userID = $id;
        $this->userNameFirst = 'Not available';
        $this->userNameLast  = 'Not available';
        $this->userPassword  = 'Not available';
        $this->userEmail     = 'Not available';
        $this->userStatus    = 'Not available'; 
    }
    public function __construct($user_id,$user_nameFirst , $user_nameLast ,$user_password ,$user_email ,$user_status)
    {
        $this->userID 	     = $user_id;
        $this->userNameFirst = $user_nameFirst;
        $this->userNameLast  = $user_nameLast;
        $this->userPassword  = $user_password;
        $this->userEmail     = $user_email;
        $this->userStatus    = $user_status; 
    }
    
    public function __set($name, $value)
    {
        $this -> data[$name] = $value;
    }

    public function __get($name)
    {
        if ( isset($this -> data[$name]) ) {
            return $this -> data[$name];
        } else {
            return false;
        }
    }

    public function getUserStatus()
    {
        if (is_numeric($this->userStatus)) {
            return number_format($this->userStatus);
        } else {
            return $this->userStatus;
        }
    }

    public function __toString()
    {
        $output =  'userID	 : ' . $this->car_id 	    . '<br>';
        $output .= 'userNameFirst: ' . $this->userNameFirst . '<br>';
        $output .= 'userNameLast : ' . $this->userNameLast  . '<br>';
        $output .= 'userPassword : ' . $this->userPassword  . '<br>';
        $output .= 'userEmail	 : ' . $this->userEmail     . '<br>';
        $output .= 'userStatus	 : ' . $this->getUserStatus . '<br>';
        return $output;
    }

}