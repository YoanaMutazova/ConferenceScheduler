<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<style>
body {
    width: 50%;
    margin: 15px;
}

.well{
    margin-top: 10px;
    width: 80%;
}
</style>

<body>
<h1>Upcoming Conferences</h1>

<?php for ($i = 0; $i < $model->getSize(); $i++): ?>
<div class="well well-sm" > 
    <a href="/ConferenceScheduler/public/conference/conferenceInfo/<?= $model->getId($i)?>">
        <h3><?= $model->getName($i) ?></h3>
    </a>
    <p> Start: <?= $model->getStartDate($i) ?><br/> End: <?= $model->getEndDate($i) ?></p>
</div>
    <?php if (!$model->getMustVisitCheck($i)) : ?>
    <a href="/ConferenceScheduler/public/conference/checkConference/<?=$model->getId($i)?>" class="btn btn-primary">must visit</a>   
    <?php else : ?>
    <a href="/ConferenceScheduler/public/conference/checkConference/<?=$model->getId($i)?>" class="btn btn-primary disabled" >must visit</a>
    <?php endif;?>
<?php endfor; ?>
</body>