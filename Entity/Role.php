<?php

namespace Entity;


class Role
{

    private $id;
    private $role_name;
    private $role_description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * @param mixed $role_name
     */
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;
    }

    /**
     * @return mixed
     */
    public function getRoleDescription()
    {
        return $this->role_description;
    }

    /**
     * @param mixed $role_description
     */
    public function setRoleDescription($role_description)
    {
        $this->role_description = $role_description;
    }



}