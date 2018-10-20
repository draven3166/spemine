<?php
/*
 * SCM - Simple Cloud Mining Script
 * Author: Smarty Scripts
 * Official Website: www.smartyscripts.com
 */
session_start();
session_destroy();
header('Location: index.php');
?>