<?php
declare (strict_types=1);

class CreateEventBindingModel {
    
    private $description;
    private $start;
    private $end;
    private $speaker;
    private $conference;
    
    public function __construct(array $params) {
        $this->setDescription($params['description']);
        $this->setStart($params['start']);
        $this->setEnd($params['end']);
        $this->setSpeaker($params['speaker']);
        $this->setConference($params['conference']);
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
        if (date_create($end) < date_create($this->start)) {
            throw new Exception("Event cannot end befor it has started");
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
    
    public function getConference()
    {
        return $this->conference;
    }
    
    private function setConference(string $conference) 
    {
         if (trim($conference) == '') {
            throw new Exception("Choose conference");
        }
        $this->conference = $conference;
    }
}
