<?php

namespace Repository;

use Entity\Parcel;
use PDO;

class ParcelRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Parcel::class, "all_parce_data");
    }

    public function updateStatus($parcelId, $status) {
        $stmt = $this->pdo->query("UPDATE parcel SET status = '{$status}' WHERE id = {$parcelId}");
        return $stmt->execute();
    }

    public function addParcelUser($parcelId, $userId) {
        $stmt = $this->pdo->query("SELECT parcel_id FROM users_parcels WHERE user_id = {$userId} AND parcel_id = {$parcelId}");
        $result = $stmt->fetch();
        if (empty($result)) {
            return $this->pdo->query("INSERT IGNORE INTO users_parcels (user_id, parcel_id) VALUES ('{$userId}', '{$parcelId}')")->execute();
        } else {
            return false;
        }
    }

    public function removeParcelUser($parcelId, $userId) {
        return $this->pdo->query("DELETE FROM users_parcels WHERE user_id={$userId} AND parcel_id={$parcelId}")->execute();
    }

    public function getUsersParcelIds($userId) {
        $stmt = $this->pdo->query("SELECT parcel_id FROM users_parcels WHERE user_id = {$userId}");
        return $stmt->fetchAll(PDO::FETCH_COLUMN, "parcel_id");
    }


}