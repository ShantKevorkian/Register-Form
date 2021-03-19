<?php

    function setSession ($key, $val) {
        $_SESSION[$key] = $val;
    }

    function getSession($key) {
        if(isset($_SESSION[$key])) {
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
    }