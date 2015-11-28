<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<h1><?= $model->getConferenceName() ?></h1>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Description</th>
      <th>Start</th>
      <th>End</th>
      <th>Speaker</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < $model->getCount(); $i++): ?>
    <tr>  
      <td><?= $i ?></td>
      <td><?= $model->getEventDescription($i) ?></td>
      <td><?= $model->getEventStartDate($i) ?></td>
      <td><?= $model->getEventEndDate($i) ?></td>
      <td><?= $model->getEventSpeaker($i) ?></td>
    </tr>
    <?php endfor; ?>
  </tbody>
</table> 