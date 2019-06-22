<?php

namespace Controller;

use Repository\RepositoryFactory;

class Admin extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->authorize();
        $this->render("admin", "index");
    }

    public function userlist() {
        $this->authorize();
        $usersList = RepositoryFactory::getRepository("UserRepository")->findAll();

        $this->render("admin", "userslist", [
            'users' => $usersList
        ]);
    }

    public function userdetail() {
        $this->authorize();
        if (isset($_GET["userId"]) && $_GET["userId"]) {
            $userId = $_GET["userId"];
            $userData = RepositoryFactory::getRepository("UserRepository")->getAllUserData($userId);

            $this->render("admin", "userdetail", array_merge([], $userData));
        }
    }

    public function useradd() {
        $this->authorize();
        $message = "";

        if ($this->request->isPost()) {
            $postData = $this->request->getData();

            $user = new \Entity\User();
            $user->setUsername($postData["username"]);
            $user->setPassword($postData["password"]);

            $result = RepositoryFactory::getRepository("UserRepository")->addUserWithData($user, $postData);

            if ($result) {
                RepositoryFactory::getRepository("UserRepository")->addUserRole($postData["role"]);
                $message = "Użytkownik dodany.";
            } else {
                $message = "Użytkownik już istnieje.";
            }
        }

        $this->render("admin", "useradd", ['message' => $message]);

    }

    public function parcellist() {
        $this->authorize();
        $parcels = RepositoryFactory::getRepository("ParcelRepository")->findAll();
        header('Content-Type: text/html; charset=utf-8');
        $this->render("admin", "parcellist", [
            'parcels' => $parcels
        ]);
    }

}