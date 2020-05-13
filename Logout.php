<?php
    include "authentication.php";
    if (!$auth->isLoggedIn()) {
        header("location: index.php");
    }
    try {
        $auth->logOutEverywhereElse();
    }
    catch (\Delight\Auth\NotLoggedInException $e) {
        die('Not logged in');
    } catch (\Delight\Auth\AuthError $e) {
        die("Authentication error");
    }
    $auth->destroySession();
    header("location:index.php");