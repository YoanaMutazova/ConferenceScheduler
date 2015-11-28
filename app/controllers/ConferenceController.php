<?php
declare (strict_types=1);

class ConferenceController extends BaseController {
    
    public function createConference()
    {
        $this->loadView('conference/create');
        if (isset($_POST['submit'])) {
            $this->loadModel('conference', 'createConference', true);
        }
    }
    
    public function createEvent ()
    {
        $this->loadView('conference/event');
        if (isset($_POST['submit'])) {
            $this->loadModel('conference', 'createEvent', true);
        }
    }
    
    public function all()
    {
        if (!isset($_SESSION['userId'])) {
            header("Location: /ConferenceScheduler/public/home");
        }
        
        $this->loadModel('conference', 'all');        
        $this->loadView('conference/all');
    }
    public function conferenceInfo(int $id)
    {
        require_once '/../models/conferenceModel.php';
        $model = conferenceModel::conferenceInfo($id);
        $this->loadView('conference/conferenceInfo');
    }
    public function checkConference(int $id)
    {
        if (!isset($_SESSION['userId'])) {
            header("Location: /ConferenceScheduler/public/home");
        }
        require_once '/../models/conferenceModel.php';
        $model = conferenceModel::checkConference($id);
        $this->loadModel('conference', 'all');
        $this->loadView('conference/all');
    }
}
