<?php
declare(strict_types=1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileViewModel
 *
 * @author Yoana
 */
class ProfileViewModel {
    private $username;
    private static $data;
    
    public function __construct(array $data) {
        $this->data = $data;
        $this->setUsername($data['username']);
    }
    
    public function setUsername(string $username){
        $this->username = $username;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getData(){
        return $this->data;
    }
}
