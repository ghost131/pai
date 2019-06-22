<?php

namespace Controller;

use Repository\RepositoryFactory;

class Index extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render("index", "index");
    }

    public function login()
    {
        if ($this->request->isPost()) {
            $credentials = $this->request->getData();
            $user = RepositoryFactory::getRepository("UserRepository")->findOneBy([
                'username' => $credentials["username"]
            ]);

            if ($user->checkPassword($credentials["password"])) {
                $roleId = RepositoryFactory::getRepository("UserRepository")->getUserRoleId($user->getId());
                $role = RepositoryFactory::getRepository("RoleRepository")->findOneBy(["id" => $roleId]);
                // set session to logged in
                $this->session->setItem("logged_in", true);
                $this->session->setItem("role", $role->getRoleName());
                $this->session->setItem("userId", $user->getId());
                switch ($role->getRoleName()) {
                    case "admin":
                        header("Location: /pcichon/admin/index");
                        die();
                        break;
                    case "employee":
                        header("Location: /pcichon/employee/index");
                        die();
                        break;
                    default:
                        return $this->render("index", "login");
                        break;
                }
            }
        }

        return $this->render("index", "login");
    }

    public function logout()
    {
        session_destroy();
        header("Location: /pcichon/index");
        die();
    }

    public function unauthorized()
    {
        $this->render("index", "unauthorized");
    }
}