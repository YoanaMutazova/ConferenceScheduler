<?php
declare (strict_types=1);

class CreateConferenceBindingModel {
    
    private $name;
    private $venue;
    private $hall;
    private $start;
    private $end;
    private $limit;

    public function __construct(array $params) {
        $this->setName($params['name']);
        $this->setVenue($params['venue']);
        $this->setHall($params['hall']);
        $this->setStart($params['start']);
        $this->setEnd($params['end']);
        $this->setLimit($params['limit']);
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    private function setName(string $name)
    {
        if (trim($name) == '') {
            throw new Exception("Empty name");
        }
        $this->name = $name;
    }
    
    public function getVenue()
    {
        return $this->venue;
    }
    
    private function setVenue(string $venue)
    {
        if (trim($venue) == '') {
            throw new Exception("Empty venue");
        }
        $this->venue = $venue;
    }
    
    public function getHall()
    {
        return $this->hall;
    }
    
    private function setHall(string $hall)
    {
        if (trim($hall) == '') {
            throw new Exception("Empty hall");
        }
        $this->hall = $hall;
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
            throw new Exception("Conference cannot end befor it has started");
        }
        $this->end = $end;
    }
    
    public function getLimit()
    {
        return $this->limit;
    }
    
    private function setLimit(string $limit)
    {
        if (trim($limit) == '') {
            throw new Exception("Empty limit");
        }
        $this->limit = $limit;
    }
}
