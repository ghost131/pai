<?php

namespace Repository;

use Entity\Role;

class RoleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Role::class, "roles");
    }
}