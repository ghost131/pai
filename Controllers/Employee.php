<?php

namespace Controller;

use Repository\RepositoryFactory;

class Employee extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->authorize();
        $this->render("employee", "index");
    }


    public function parcellist()
    {
        $this->authorize();
        $parcels = RepositoryFactory::getRepository("ParcelRepository")->findAll();
        $usersAssignedParcels = RepositoryFactory::getRepository("ParcelRepository")->getUsersParcelIds($this->session->getItem("userId"));

        $this->render("employee", "parcellist", [
            'parcels' => $parcels,
            'usersAssignedParcels' => $usersAssignedParcels
        ]);
    }

    public function assignparcel()
    {
        $this->authorize();

        header('Content-Type: application/json');
        if (isset($_GET["parcelId"]) && $_GET["parcelId"]) {
            $parcelId = $_GET["parcelId"];
            $userId = $this->session->getItem("userId");
            $result = RepositoryFactory::getRepository("ParcelRepository")->updateStatus($parcelId, 'inprogress');
            $result2 = RepositoryFactory::getRepository("ParcelRepository")->addParcelUser($parcelId, $userId);
            if ($result && $result2) {
                echo '{"success":true}';
                die();
            }
            echo '{"success":false}';
            die();
        } else {
            echo "{'message':'false'}";
            die();
        }
    }

    public function unassignparcel()
    {
        $this->authorize();

        header('Content-Type: application/json');
        if (isset($_GET["parcelId"]) && $_GET["parcelId"]) {
            $parcelId = $_GET["parcelId"];
            $userId = $this->session->getItem("userId");
            $result = RepositoryFactory::getRepository("ParcelRepository")->updateStatus($parcelId, 'pending');
            $result2 = RepositoryFactory::getRepository("ParcelRepository")->removeParcelUser($parcelId, $userId);
            if ($result && $result2) {
                echo '{"success":true}';
                die();
            }
            echo '{"success":false}';
            die();
        } else {
            echo "{'message':'false'}";
            die();
        }
    }

    public function finishparcel()
    {
        $this->authorize();

        header('Content-Type: application/json');
        if (isset($_GET["parcelId"]) && $_GET["parcelId"]) {
            $parcelId = $_GET["parcelId"];
            $userId = $this->session->getItem("userId");
            $result = RepositoryFactory::getRepository("ParcelRepository")->updateStatus($parcelId, 'finished');
            if ($result && $result2) {
                echo '{"success":true}';
                die();
            }
            echo '{"success":false}';
            die();
        } else {
            echo "{'message':'false'}";
            die();
        }
    }

}