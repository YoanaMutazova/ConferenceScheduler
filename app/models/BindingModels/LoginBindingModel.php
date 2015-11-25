<?php
declare (strict_types=1);

class LoginBindingModel {
    
    private $username;
    private $password;
    
    public function __construct(array $params) {
        $this->setUsername($params['username']);
        $this->setPassword($params['password']);
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
}
