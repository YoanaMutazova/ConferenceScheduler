<?php

class ConferenceInfoViewModel {
    private $conference;
    private $events;
    private $count;
    
    public function __construct(array $conference, array $events) {
        $this->conference = $conference;
        $this->events = $events;
        $this->count = count($events);
    }
    
    public function getCount(){
        return $this->count;
    }
    
    public function getConferenceName(){
        return $this->conference['name'];
    }
    
    public function getConferenceVenue(){
        return $this->conference['venue'];
    }
    
    public function getConferenceTown(){
        return $this->conference['town'];
    }
    
    public function getConferenceStartDate(){
        return $this->conference['start'];
    }
    
    public function getConferenceEndDate(){
        return $this->conference['end'];
    }
    
    public function getEventDescription(int $id){
        return $this->events[$id]['description'];
    }
    
    public function getEventSpeaker(int $id){
        return $this->events[$id]['username'];
    }
    
    public function getEventStartDate(int $id){
        return $this->events[$id]['start'];
    }
    
    public function getEventEndDate(int $id){
        return $this->events[$id]['end'];
    }
}
