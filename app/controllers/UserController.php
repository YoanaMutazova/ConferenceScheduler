<?php

class UserController extends BaseController {
    public function profile()
    {
        if (!isset($_SESSION['userId'])) {
           header('Location: /ConferenceScheduler/public/home');
        }
        
        $this->loadModel('user', 'profile');
        $this->loadView('user/profile');
        unset($_POST['temp']);
    }
}
