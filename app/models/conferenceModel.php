<?php
declare (strict_types=1);

require_once '/BindingModels/CreateConferenceBindingModel.php';
require_once '/BindingModels/CreateEventBindingModel.php';
require_once '/../View.php';
require_once '/ViewModels/AllConferencesViewModel.php';
require_once '/ViewModels/ConferenceInfoViewModel.php';


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
        $limit = intval($model->getLimit());
        
        $db = Database::getInstance('app');
        
        $ownerId = intval($_SESSION['userId']);
        
        $result = $db->prepare("
            INSERT INTO conferences 
            (name, venue, hall, start, end, owner_id, `limit`, users)
            VALUES (?, ?, ?, ?, ?, ?, ?, 0)
        ");
        $result->execute(
            [
                $name,
                $venue,
                $hall,
                date_format(date_create($start), 'Y-m-d H:i:s'),
                date_format(date_create($end), 'Y-m-d H:i:s'),
                $ownerId,
                $limit
            ]
        );
        
        if ($result->rowCount() > 0) {
            header('Location: /ConferenceScheduler/public/conference/createEvent');
        }
        throw new \Exception('Cannot create conference');
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
    
    public function all()
    {
        $db = Database::getInstance('app');
        
        $result = $db->prepare("SELECT id,name,start,end FROM conferences WHERE start > ?");
        $datetime = date("Y-m-d H:i:s");
        $result->execute([$datetime]);
        $data = $result->fetchAll();
        
        if ($result->rowCount() <= 0) {
            throw new Exception("No results");
        }
        
        for ($i = 0; $i < count($data); $i++) {
            $userId = $_SESSION['userId'];
            $confId = $data[$i]['id'];
            $check = $db->prepare("SELECT * FROM users_conferences WHERE conference_id = ? AND user_id = ?");
            $check->execute([$confId,$userId]);

            if ($check->rowCount() > 0) {
                $data[$i]['checked'] = true;
            } else {
                $data[$i]['checked'] = false;
            }
        }
        
        $model  = new AllConferencesViewModel($data);
        View::make($model);
    }
    
    public function conferenceInfo(int $id){
        $db = Database::getInstance('app');
        
        $conference = $db->prepare("SELECT * FROM conferences WHERE id = ? ");
        $conference->execute([$id]);
        $conferenceResult = $conference->fetch();
        
        $events = $db->prepare("Select description, start, end, username 
                    FROM events e JOIN users u ON e.speaker_id = u.id
                    where conference_id = ? ");
        
        $events->execute([$id]);
        $eventsResult = $events->fetchAll();
        
        $model  = new ConferenceInfoViewModel($conferenceResult, $eventsResult);
        View::make($model);
    }
    
    public function checkConference(int $id){
        $db = Database::getInstance('app');
        
        $conference = $db->prepare("INSERT INTO users_conferences (user_id, conference_id)
            VALUES (?, ?)");
        $conference->execute([$_SESSION['userId'],$id]);
        
        $conferenceUsers = $db->prepare("SELECT limit, users FROM conferences WHERE id = ?");
        $conferenceUsers->execute([$id]);
//        if $conferenceUsers['users'] < $conferenceUsers['limit'] -> limit++
        
        $newConferenceUsers = $db->prepare("UPDATE conferences SET users = ? WHERE id = ?");
        $newConferenceUsers->execute([$numberOfUsers, $id]);
    }
    
    public function mustVisit(){
        $db = Database::getInstance('app');
        
        $conferences = $db->prepare("
                SELECT name, start, end
                FROM users u 
                JOIN users_conferences uc ON u.id = uc.user_id
                JOIN conferences c ON uc.conference_id = c.id
                WHERE u.id = ?");
        $conferences->execute([$_SESSION['userId']]);
        $result = $conferences->fetchAll();
    }
}