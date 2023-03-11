<?php
include('config.php');
require_once('Model/Database.php');
require_once('Model/GuestBook.php');
require_once('Model/QueryMapper.php');
require_once('Controller/GuestBookController.php');

// Save data about guest user
$guestBookController = new GuestBookController();
$guestBookController->saveGuest();






