<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

require_once 'templates/profile-template.php';