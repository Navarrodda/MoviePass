<?php

namespace Model;

class Role
{

    private $id;
    private $preority;


       public function __construct($preority)
    {
        $this->setPreority($preority);
    
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
    public function getPreority()
    {
        return $this->preority;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setPreority($preority)
    {
        $this->preority = $preority;

        return $this;
    }
}