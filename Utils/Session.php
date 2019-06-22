<?php

namespace Utils;


class Session
{
    public function setItem($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getItem($key)
    {
        if ($_SESSION && isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

}