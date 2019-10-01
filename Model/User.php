<?php

namespace Model;

class User
{
    private $id;
    private $role;
    private $nikname;
    private $email;
    private $password;

    public function __construct($nikname, $email, $password, Role $role)
    {
        $this->setNikname($nikname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setRole($role);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNikname()
    {
        return $this->nikname;
    }

    /**
     * @param mixed $nikname
     *
     * @return self
     */
    public function setNikname($nikname)
    {
        $this->nikname = $nikname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

        /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}