<?php
require_once '/../../models/ViewModels/ProfileViewModel.php';
$model = ProfileViewModel::getData();?>
<h1>Hello <?php $model['username']?> </h1>

