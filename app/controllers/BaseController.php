<?php

abstract class BaseController {
    
    protected $model;
    protected $view;
    protected $bindingModel;
    
    public function loadModel($model, $method, $bindingModel = false)
    {
        require_once '../app/models/' . $model . 'Model.php';
        $model = $model . 'Model';
        if ($bindingModel) {
            $this->bindingModel = $this->loadBindingModel($method);
            $this->model = new $model($method, $this->bindingModel);
        }
        $this->model = new $model($method);
    }
    
    public function loadView ($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
    
    public function loadBindingModel($bindingModel)
    {
        require_once '/../models/BindingModels/' . ucfirst($bindingModel) . 'BindingModel.php';
        $bindingModel = $bindingModel . 'BindingModel';
        return new $bindingModel($_POST);
    }
}
