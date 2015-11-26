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
    
    public function login(LoginBindingModel $model)
    {
        $username = $model->getUsername();
        $password = $model->getPassword();
        
        $db = Database::getInstance('app');
        
        $result = $db->prepare("
            SELECT
                id, username, password
            FROM
                users
            WHERE username = ?
        ");

        $result->execute([$username]);

        if ($result->rowCount() <= 0) {
            throw new \Exception('Invalid username');
        }

        $userRow = $result->fetch();

        if (password_verify($password, $userRow['password'])) {
            $_SESSION['userId'] = $userRow['id'];
            header('Location: /ConferenceScheduler/public/home');
        }

        throw new \Exception('Invalid credentials');
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
            var_dump($LoginBM);
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
}

