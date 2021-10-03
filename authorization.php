<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}
require_once 'templates/authorization-template.php';
