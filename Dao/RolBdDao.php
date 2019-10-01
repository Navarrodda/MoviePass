<?php

namespace Dao;

use \Model\Role;

class RolBdDao
{
    protected $table = "roles";
    private static $instance;
    protected $list;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add(Role $role)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->table (preority) VALUES (:preority)";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);


        $preority = $role->getPreority();

        $judgment->bindParam(":preority", $preority);

        $judgment->execute();

        return $conection->lastInsertId();
    }

    public function remove($id)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->table WHERE preority = \"$id\" LIMIT 1";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();
    }

    public function to_update(Role $role)
    {
        $sql = "UPDATE $this->table 
        SET preority = :preority 
        WHERE id = :id";


        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $id = $role->getId();

        $judgment->bindParam(":id", $id);

        $judgment->execute();
    }

    public function bring_everything()
    {
     $sql = "SELECT * FROM $this->table";

     $conec = Conection::conection();

     $judgment = $conec->prepare($sql);

     $judgment->execute();

     $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

     $this->mapear($dataSet);

     if(!empty($this->list)){
        return $this->list;
    }

    return null;
}

public function bring_by_id($id)
{
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->table WHERE id = \"$id\" LIMIT 1";

    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();

    $dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

    $this->mapear($dataSet);

    if (!empty($this->list[0])) {
        return $this->list[0];
    }
    return null;
}
public function bring_by_id_priority($preority)
{
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->table WHERE preority = \"$preority\" LIMIT 1";

    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();

    $dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

    $this->mapear($dataSet);

    if (!empty($this->list[0])) {
        return $this->list[0];
    }
    return null;
}

public function mapear($dataSet)
{
    $dataSet = is_array($dataSet) ? $dataSet : false;

    if($dataSet){
        $this->list = array_map(function ($p) {
            $r = new Role($p['preority']);
            $r->setId($p['id']);
            return $r;
        }, $dataSet);
    }
}
}