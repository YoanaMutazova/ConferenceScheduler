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
        
        $ownerId = intval($_SESSION['userId']);
        
        $result = $db->prepare("
            INSERT INTO conferences 
            (name, venue, hall, start, end, owner_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $result->execute(
            [
                $name,
                $venue,
                $hall,
                date_format(date_create($start), 'Y-m-d H:i:s'),
                date_format(date_create($end), 'Y-m-d H:i:s'),
                $ownerId
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
        $conference = $model->getConference();
        
        $db = Database::getInstance('app');
        
        $confId = $db->prepare("SELECT id FROM conferences WHERE name = ?");
        $confId->execute([ $conference ]);
        $conferenceId = $confId->fetch();
        $conf = $conferenceId['id'] + 1 - 1;
        
        if ($conf == null) {
            throw new \Exception('Conference doesn`t exist');
        }
        
        $speakerId = $db->prepare("SELECT id FROM users WHERE username = ?");
        $speakerId->execute([ $speaker ]);
        $userId = $speakerId->fetch();
        $user = $userId['id'] + 1 - 1;
        
        if ($userId == null) {
            throw new \Exception('Username doesn`t exist');
        }
        
        $result = $db->prepare("
            INSERT INTO events 
            (description, start, end, speaker_id, conference_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $result->execute(
            [
                $description,
                date_format(date_create($start), 'Y-m-d H:i:s'),
                date_format(date_create($end), 'Y-m-d H:i:s'),
                $user,
                $conf
            ]
        );
        
        if ($result->rowCount() > 0) {
            header("Location: /ConferenceScheduler/public/home/index");
        }
        throw new \Exception('Cannot create event');
    }
}