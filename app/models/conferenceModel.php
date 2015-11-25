<?php
declare (strict_types=1);

require_once '/BindingModels/CreateConferenceBindingModel.php';
require_once '/BindingModels/CreateEventBindingModel.php';

class conferenceModel 
{   
    public function __construct($method, $bindingModel = null) {
        if ($bindingModel != null) {
            $this->$method($bindingModel);
        }
        $this->$method();
    }
    
    public function createConference(CreateConferenceBindingModel $model)
    {
        $name = $model->getName();
        $venue = $model->getVenue();
        $hall = $model->getHall();
        $start = $model->getStart();
        $end = $model->getEnd();
        
        $db = Database::getInstance('app');
        
        $result = $db->prepare("
            INSERT INTO conferences 
            (name, venue, hall, start, end)
            VALUES (?, ?, ?, ?, ?)
        ");

        $result->execute(
            [
                $name,
                $venue,
                $hall,
                date_format(date_create($start), 'Y-m-d H:i:s'),
                date_format(date_create($end), 'Y-m-d H:i:s'),
            ]
        );
        
        if ($result->rowCount() <= 0) {
            throw new \Exception('Cannot create conference');
        }
        header('Location: /ConferenceScheduler/public/conference/createEvent');
    }
    
    public function createEvent(CreateEventBindingModel $model)
    {
        $description = $model->getDescription();
        $start = $model->getStart();
        $end = $model->getEnd();
        $speaker = $model->getSpeaker();
        
        $db = Database::getInstance('app');
        
        $speakerId = $db->prepare("SELECT id FROM users WHERE username = ?");
        $speakerId->execute([ $speaker ]);
        $userId = $speakerId->fetch();
        $user = $userId['id'] + 1 - 1;

        if ($userId == null) {
            throw new \Exception('Username doesn`t exist');
        }
        
        $result = $db->prepare("
            INSERT INTO events 
            (description, start, end, speaker_id)
            VALUES (?, ?, ?, ?)
        ");
        $result->execute(
            [
                $description,
                date_format(date_create($start), 'Y-m-d H:i:s'),
                date_format(date_create($end), 'Y-m-d H:i:s'),
                $user
            ]
        );
        
        if ($result->rowCount() == 0) {
            throw new \Exception('Cannot create event');
        }
        
        $programe = $db->prepare("
            INSERT INTO conferences_events (conference_id, event_id)
            VALUES (?, ?)
        ");
        $result->execute(
            [
                $description,
                $user
            ]
        );
        
        header("Location: /ConferenceScheduler/public/home/index");
    }
}
