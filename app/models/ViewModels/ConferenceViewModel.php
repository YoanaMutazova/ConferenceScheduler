<?php

class ConferenceViewModel {
    private $id;
    private $name;
    private $venue;
    private $hall;
    private $start;
    private $end;
    

    public function __construct($id, $name, $venue, $hall, $start, $end)
    {
        $this->id = $id;
        $this->name = $name;
        $this->venue = $venue;
        $this->hall = $hall;
        $this->start = $start;
        $this->end = $end;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getVenue()
    {
        return $this->venue;
    }
    
    public function getHall()
    {
        return $this->hall;
    }
    
    public function getStart()
    {
        return $this->start;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
}
