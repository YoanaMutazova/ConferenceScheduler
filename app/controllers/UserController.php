<?php
require_once '/../View.php';
require_once '/../models/ViewModels/ProfileViewModel.php';

class UserController extends BaseController {
    public function profile()
    {
        $db = Database::getInstance('app');

        $result = $db->prepare("
            SELECT username FROM users WHERE id = ?");

        $result->execute([$_SESSION['userId']]);
        $data = $result->fetch();
        
        $model = new ProfileViewModel($data['username']);
        
        View::make($model);
    }
}
