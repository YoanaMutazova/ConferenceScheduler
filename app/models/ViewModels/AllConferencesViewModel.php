<?php
declare (strict_types=1);

class AllConferencesViewModel {
    private $data;
    private $size;
    
    public function __construct($data) {
        $this->data = $data;
        $this->size = count($data);
    }
    
    public function getSize(){
        return $this->size;
    }
    
    public function getId(int $index){
        if ($index > $this->size) {
            throw new Exception("Invalid index");
        }
        return $this->data[$index]['id'];
    }

    public function getName(int $index){
        if ($index > $this->size) {
            throw new Exception("Invalid index");
        }
        return $this->data[$index]['name'];
    }
    
    public function getStartDate(int $index){
        if ($index > $this->size) {
            throw new Exception("Invalid index");
        }
        return $this->data[$index]['start'];
    }
    
    public function getEndDate(int $index){
        if ($index > $this->size) {
            throw new Exception("Invalid index");
        }
        return $this->data[$index]['end'];
    }
    
    public function getMustVisitCheck(int $index){
        if ($index > $this->size) {
            throw new Exception("Invalid index");
        }
        return $this->data[$index]['checked'];
    }
}
