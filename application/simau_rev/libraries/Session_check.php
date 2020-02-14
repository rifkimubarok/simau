<?php

class Session_check {
    private $ci ;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function check_session()
    {
        $userdata = get_session("user");
        if(isset($userdata->status) && $userdata->status){
            return true;
        }else{
            redirect('Landing');
        }
        return false;
    }
}