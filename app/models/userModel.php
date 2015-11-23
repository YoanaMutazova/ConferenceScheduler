<?php
declare (strict_types=1);

require_once '/BindingModels/LoginBindingModel.php';
require_once '/BindingModels/RegisterBindingModel.php';

class userModel 
{   
    public function __construct($method, $bindingModel = null) {
        if ($bindingModel != null) {
            $this->$method($bindingModel);
        }
        $this->$method();
    }
    
    public function register(RegisterBindingModel $model)
    {
        $username = $model->getUsername();
        $password = $model->getPassword();
        $confirm = $model->getConfirmPassword();

        if ($password != $confirm) {
            throw new \Exception("Passwords do not match");
        }
        
        $db = Database::getInstance('app');

        if ($this->exists($username)) {
            throw new \Exception("User already registered");
        }

        $result = $db->prepare("
            INSERT INTO users (username, password)
            VALUES (?, ?);
        ");

        $result->execute(
            [
                $username,
                password_hash($password, PASSWORD_DEFAULT)
            ]
        );

        if ($result->rowCount() > 0) {
            $LoginBM = new LoginBindingModel(['username' => $username,'password' => $password]);
            $this->login($LoginBM);
        }

        throw new \Exception('Cannot register user');
    }
    
    public function exists(string $username)
    {
        $db = Database::getInstance('app');

        $result = $db->prepare("SELECT id FROM users WHERE username = ?");
        $result->execute([ $username ]);

        return $result->rowCount() > 0;
    }
    
    public function logout()
    {
        unset($_SESSION['userId']);
        header('Location: /ConferenceScheduler/public/home');
    }
    
    public function profile()
    {
        $data = $this->getInfo($_SESSION['userId']);  
        
        $db = Database::getInstance('app');
        
        $result->execute([date("Y/m/d h:i:s"), $_SESSION['userId']]);
        $result->fetch();
        
        $data = $this->getInfo($_SESSION['userId']);
        $_POST['temp'] = $data;
    }
    
    public function getInfo($id)
    {
        $db = Database::getInstance('app');

        $result = $db->prepare("
            SELECT
                id, username, password
            FROM
                users
            WHERE id = ?
        ");

        $result->execute([$id]);
        return $result->fetch();
    }
}

