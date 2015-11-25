<?php
declare (strict_types=1);

class CreateEventBindingModel {
    
    private $description;
    private $start;
    private $end;
    private $speaker;
    
    public function __construct(array $params) {
        $this->setDescription($params['description']);
        $this->setStart($params['start']);
        $this->setEnd($params['end']);
        $this->setSpeaker($params['speaker']);
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    private function setDescription(string $description)
    {
        if (trim($description) == '' || $description == NULL) {
            throw new Exception("Empty description");
        }
        $this->description = $description;
    }

    public function getStart()
    {
        return $this->start;
    }
    
    private function setStart(string $start)
    {
        if (trim($start) == '') {
            throw new Exception("Empty start");
        }
        $this->start = $start;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
    
    private function setEnd(string $end)
    {
        if (trim($end) == '') {
            throw new Exception("Empty end");
        }
        $this->end = $end;
    }
    
    public function getSpeaker()
    {
        return $this->speaker;
    }
    
    private function setSpeaker(string $speaker)
    {
        $this->speaker = $speaker;
    }
}
