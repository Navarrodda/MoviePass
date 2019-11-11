<?php
namespace Dao;

use \Model\Room;

class RoomBdDao
{
    protected $table = "room";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

        public function bring_id_by_nameRoom($name_room){
        $sql = "SELECT id FROM $this->table WHERE name = \"$name_room\" LIMIT 1";

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

public function add(Room $room){
    try{

        /** @noinspection SqlResolve */
        $sql = ("INSERT INTO $this->table (id,name_room,price,cant_seat) VALUES (:id,:nombre,:precio,:butacas)");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $id = $room->getId();
        $nombre = $room->getNameRoom();
        $precio = $room->getPrice();
        $butacas = $room->getCantSeat();

        $judgment->bindParam(":id",$id);
        $judgment->bindParam(":nombre",$name_room);
        $judgment->bindParam(":precio",$price);
        $judgment->bindParam(":butacas",$butacas);

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


public function to_update(Room $room, $id){

    try{
        $sql = ("UPDATE $this->table SET name=:name_room, price=:price, cant_seat=:cant_seat WHERE id=\"$id\"");



        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $nombre = $room->getNameRoom();
        $precio = $room->getPrice();
        $butacas = $room->getCantSeat();

        $judgment->bindParam(":name_room",$nombre);
        $judgment->bindParam(":price",$precio);
        $judgment->bindParam(":cant_seat",$butacas);


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

            $room = new Room();
            $room->setId($p['id']);
            $room->setNameRoom($p['name_room']);
            $room->setPrice($p['price']);
            $room->setCantSeat($p['cant_seat']);

            return $room;
        }, $dataSet);
    }
}
}
?>