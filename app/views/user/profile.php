<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<style>
    body{
        margin: 15px;
    }
</style>
<h1>hello <?= $model->getUsername(); ?></h1>
<body>
<a href="/ConferenceScheduler/public/conference/createConference" class="btn btn-default">Create Conference</a>
<a href="/ConferenceScheduler/public/conference/createEvent" class="btn btn-default">Add Event</a>
<a href="/ConferenceScheduler/public/conference/all" class="btn btn-default">Upcoming Conferences</a>
<a href="/ConferenceScheduler/public/home/logout" class="btn btn-default">Logout</a>
</body>