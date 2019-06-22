<?php

namespace Controller;

use Utils\Session;
use Utils\Request;

class BaseController
{

    public $request;
    public $session;

    public function __construct()
    {
        session_start();
        $this->request = new Request();
        $this->session = new Session();
    }

    public function render($templatePath, $templateName, $variables = []) {
        $basePath = dirname(dirname(__FILE__)) . "\\Views";
        $template = "$basePath\\$templatePath\\$templateName.php";
        $variables["template"] = $template;
        $filePath = $basePath. "\\base.php";

        $output = NULL;
        if(file_exists($filePath)){
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }

        print $output;

    }

    public function authorize() {
        global $controller, $action;
        if ($this->session->getItem("role") === "admin") {
            return true;
        }

        $role = $this->session->getItem("role") ? $this->session->getItem("role") : "unlogged";

        $allowedActions = [
            'employee' => [
                "index" => ["login", "logout"],
                "employee" => ["index", "parcellist", "assignparcel", "unassignparcel", "finishparcel"]
            ],
            'unassigned' => ["login"],
            'unlogged' => [
                "index" => ["login"]
            ]
        ];

        if (in_array($action, $allowedActions[$role][$controller])) {
            return true;
        }

        header("Location: /pcichon/index/unauthorized");
        die();
    }
}