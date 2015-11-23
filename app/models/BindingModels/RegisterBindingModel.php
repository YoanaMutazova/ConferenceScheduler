<?php 
declare (strict_types=1);

class RegisterBindingModel {
    
    private $username;
    private $password;
    private $confirmPassword;
    
    public function __construct(array $params) {
        $this->setUsername($params['username']);
        $this->setPassword($params['password']);
        $this->setConfirm($params['confirmPassword']);
    }
    
    private function setUsername(string $username)
    {
        if (trim($username) == '') {
            throw new Exception("Empty username");
        }
        $this->username = $username;
    }
    
    /*
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    private function setPassword(string $password)
    {
        if (trim($password) == '') {
            throw new Exception("Empty password");
        }
        $this->password = $password;
    }
    
    /*
     * @return string
     */
    public function getPassword() 
    {
        return $this->password;
    }
    
    private function setConfirm(string $confirm)
    {
        if (trim($confirm) == '') {
            throw new Exception("Empty password");
        }
        $this->confirmPassword = $confirm;
    }
    
    /*
     * @return string
     */
    public function getConfirmPassword() 
    {
        return $this->confirmPassword;
    }
}
