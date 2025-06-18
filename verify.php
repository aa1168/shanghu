<?php

    header("Access-Control-Allow-Origin: *");

    session_start();

    function verifyCaptcha($userInput) {
        if (isset($_SESSION['captcha']) && strtolower($userInput) === strtolower($_SESSION['captcha'])) {
            return true;
        }
        return false;
    }

    // Usage Example
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userInput = $_POST['captcha'];
        if (verifyCaptcha($userInput)) {
            echo "1";
        } else {
            echo "0";
        }
    }
