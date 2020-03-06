<?php
namespace Dao;

use \Model\Room;

class RoomBdDao
{
    protected $table = "rooms";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

            public function bring_id_by_titleroom($name_room){
        $sql = "SELECT id FROM $this->table WHERE name_room = \"$name_room\" LIMIT 1";

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

        public function bring_id_by_nameRoom($name_room,$idcinema){
        $sql = "SELECT id FROM $this->table WHERE name_room = \"$name_room\" and cinema = \"$idcinema\" LIMIT 1";

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
        $sql = ("INSERT INTO $this->table (name_room,cant_site,cinema,input_value) VALUES 
            (:name_room,:cant_site,:cinema,:input_value)");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $name_room = $room->getNameRoom();
        $cant_site = $room->getCantSite();
        $cinema = $room->getCinema();
        $idcinema = $cinema->getId();
        $input_value = $room->getInputValue();

        $judgment->bindParam(":name_room",$name_room);
        $judgment->bindParam(":cant_site",$cant_site);
        $judgment->bindParam(":cinema",$idcinema);
        $judgment->bindParam(":input_value",$input_value);

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

public function remove_by_id_cinema($idcinema){
    try{

        $sql = "DELETE FROM $this->table WHERE cinema = \"$idcinema \"";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}


public function to_update(Room $room, $id){

    try{
        $sql = ("UPDATE $this->table SET name_room=:name_room, cinema=:cinema, input_value=:input_value, cant_site=:cant_site WHERE id=\"$id\"");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $name_room = $room->getNameRoom();
        $cant_site = $room->getCantSite();
        $cinema = $room->getCinema();
        $idcinema = $room->getCinema()->getId();
        $input_value = $room->getInputValue();
        $judgment->bindParam(":name_room",$name_room);
        $judgment->bindParam(":cant_site",$cant_site);
        $judgment->bindParam(":cinema",$idcinema);
        $judgment->bindParam(":input_value",$input_value);


        $judgment->execute();
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}
        //Trae todos los rooms
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

public function bring_list_for_id_cinema($idcinema){
    try{

         $sql = "SELECT * FROM $this->table WHERE cinema = \"$idcinema\"";

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


        //Trae Room por Id
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
        $daoCinema = CinemaBdDao::getInstance();        
            $room = new Room();
            $room->setId($p['id']);
            $room->setNameRoom($p['name_room']);
            $room->setCinema( $daoCinema->bring_by_id($p['cinema']));
            $room->setInputValue($p['input_value']);
            $room->setCantSite($p['cant_site']);
            return $room;
        }, $dataSet);
    }
}
}
?>