<?php
require_once __DIR__ . '/../common_units/config.php';

session_unset();
session_destroy();

header('Location: /health-harmony/auth/login.php');
exit;
