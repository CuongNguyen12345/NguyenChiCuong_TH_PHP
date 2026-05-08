<?php
require_once __DIR__ . "/../include/connect.inc.php";
session_unset();
session_destroy();
header("Location: index.php");
exit;

