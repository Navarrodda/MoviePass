<?php
namespace Dao;

use \Model\Cinema;

class CinemaBdDao
{
    protected $table = "cinemas";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

        public function bring_id_by_title($name){
        $sql = "SELECT id FROM $this->table WHERE name = \"$name\" LIMIT 1";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();


        $id = $judgment->fetch(\PDO::FETCH_ASSOC);

        if(!empty($id))
        {
            return $id['id'];
        }

        return null;
    }


public function bring_id_by_id($id){
    $sql = "SELECT id FROM $this->table WHERE id = \"$id\" LIMIT 1";

    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();


    $id = $judgment->fetch(\PDO::FETCH_ASSOC);

    if(!empty($id))
    {
        return $id['id'];
    }

    return null;
}

public function add(Cinema $cinema){
    try{

        /** @noinspection SqlResolve */
        $sql = ("INSERT INTO $this->table (id,name,address) VALUES (:id,:nombre,:direccion)");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $id = $cinema->getId();
        $nombre = $cinema->getNombre();
        $direccion = $cinema->getDireccion();

        $judgment->bindParam(":id",$id);
        $judgment->bindParam(":nombre",$nombre);
        $judgment->bindParam(":direccion",$direccion);

        $judgment->execute();

        return $conec->lastInsertId();
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}

public function remove_by_id($id){
    try{

        $sql = "DELETE FROM $this->table WHERE id = \"$id \"";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}


public function to_update(Cinema $cinema, $id){

    try{
        $sql = ("UPDATE $this->table SET name=:name, address=:address WHERE id=\"$id\"");



        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $nombre = $cinema->getNombre();
        $direccion = $cinema->getDireccion();

        $judgment->bindParam(":name",$nombre);
        $judgment->bindParam(":address",$direccion);

        $judgment->execute();
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}
        //Trae todos los cinemas
public function bring_everything(){
    try{

        $sql = "SELECT * FROM $this->table";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

        $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->list)) {
            return $this->list;
        }
        return null;
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}


        //Trae Cinema por Id
public function bring_by_id($id)
{     
    try{
        if ($id != null) {
            $sql = ("SELECT * FROM $this->table WHERE id = \"$id\"" );

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();

            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

            $this->mapear($dataSet);

            if(!empty($this->list[0])){

                return $this->list[0];
            }
        }

        return null;
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}
        //Mapea el en List lo de $dataset
public function mapear($dataSet){
    $dataSet = is_array($dataSet) ? $dataSet : false;
    if($dataSet){
        $this->list = array_map(function ($p) {
                //,name,address,total_capacity,estimated_price

            $cinema = new Cinema();
            $cinema->setId($p['id']);
            $cinema->setNombre($p['name']);
            $cinema->setDireccion($p['address']);

            return $cinema;
        }, $dataSet);
    }
}
}
?>