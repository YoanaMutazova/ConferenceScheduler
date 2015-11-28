<?php

class HomeController extends BaseController
{
   public function index()
   {     
       if (isset($_SESSION['userId'])) {
           header('Location: /ConferenceScheduler/public/user/profile');
       }
       $this->loadView('home/index');
   }
   
    public function login()
    {
       if (isset($_SESSION['userId'])) {
           header('Location: /ConferenceScheduler/public/user/profile');
       }
       
       $this->loadView('home/login');
       if (isset($_POST['submit'])) {
           $this->loadModel('user', 'login', true);
       }
    }
   
   public function register()
   {
        if (isset($_SESSION['userId'])) {
           header('Location: /ConferenceScheduler/public/user/profile');
        }
        
        $this->loadView('home/register');
        if (isset($_POST['submit'])) {
            $this->loadModel('user', 'register', true);
        }
   }
   
   public function profile(){
        header('Location: /ConferenceScheduler/public/user/profile');
   }
   
   public function logout()
   {
       $this->loadModel('user', 'logout');
   }
}