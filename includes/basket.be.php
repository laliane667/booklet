<?php
$elem = $_POST['product'];
session_start();
require_once 'functions.be.php';

addToBasket($elem);
$_SESSION['basketSize'] = $_SESSION['basketSize'] + 1;