<?php


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
}
