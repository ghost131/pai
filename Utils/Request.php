<?php

namespace Utils;


class Request
{
    private $data;

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }

    public function isGet() {
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }

    public function getData() {
        return $this->data;
    }
}