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

    public function bring_id_by_title($title){
        $sql = "SELECT id FROM $this->table WHERE title = \"$title\" LIMIT 1";

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
            $sql = ("INSERT INTO $this->table (id,name,address,total_capacity,estimated_price) VALUES (:id,:nombre,:direccion,:capacidad,:valor_entrada)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $id = $cinema->getId();
            $nombre = $cinema->getNombre();
            $capacidad = $cinema->getCapacidad();
            $direccion = $cinema->getDireccion();
            $valor_entrada = $cinema->getValor_entrada();

            $judgment->bindParam(":id",$id);
            $judgment->bindParam(":nombre",$nombre);
            $judgment->bindParam(":capacidad",$capacidad);
            $judgment->bindParam(":direccion",$direccion);
            $judgment->bindParam(":valor_entrada",$valor_entrada);

            $judgment->execute();

            return $conec->lastInsertId();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function remove_by_id($id){
        try{

            $sql = "DELETE FROM $this->table WHERE id = \"$id \"";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();

        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }


    public function to_update(Cinema $cinema, $id){

        try{
            $sql = ("UPDATE $this->table SET id=:id, name=:nombre, total_capacity=:capacidad, estimated_price=:valor_entrada WHERE id=\"$id\"");



            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $id = $cinema->getId();
            $nombre = $cinema->getNombre();
            $capacidad = $cinema->getCapacidad();
            $direccion = $cinema->getDireccion();
            $valor_entrada = $cinema->getValor_entrada();

            $judgment->bindParam(":id",$id);
            $judgment->bindParam(":nombre",$nombre);
            $judgment->bindParam(":capacidad",$capacidad);
            $judgment->bindParam(":direccion",$direccion);
            $judgment->bindParam(":valor_entrada",$valor_entrada);


            $judgment->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
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
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
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

                $dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

                $this->mapear($dataSet);

                if(!empty($this->list[0])){

                    return $this->list[0];
                }
            }

            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
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
                $cinema->setCapacidad($p['address']);
                $cinema->setDireccion($p['total_capacity']);
                $cinema->setValor_entrada($p['estimated_price']);
                
                return $cinema;
            }, $dataSet);
        }
    }
}
?>