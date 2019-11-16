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
        $sql = ("INSERT INTO $this->table (name_room,cant_site,cinema,number_room) VALUES 
            (:name_room,:cant_site,:cinema,:number_room)");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $name_room = $room->getNameRoom();
        $cant_site = $room->getCantSite();
        $cinema = $room->getCinema();
        $idcinema = $cinema->getId();
        $number_room = $room->getNumberRoom();

        $judgment->bindParam(":name_room",$name_room);
        $judgment->bindParam(":cant_site",$cant_site);
        $judgment->bindParam(":cinema",$idcinema);
        $judgment->bindParam(":number_room",$number_room);

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
        $sql = ("UPDATE $this->table SET name=:name_room, cant_seat=:cant_seat, cinema=:cinema, number_room=:number_room WHERE id=\"$id\"");



        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $nombre = $room->getNameRoom();
        $precio = $room->getPrice();
        $butacas = $room->getCantSite();

        $judgment->bindParam(":name_room",$name_room);
        $judgment->bindParam(":cant_site",$cant_site);
        $judgment->bindParam(":cinema",$cinema);
        $judgment->bindParam(":number_room",$number_room);


        $judgment->execute();
    }catch(\PDOException $e){
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
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
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
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
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
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
        $daoCinema = CinemaBdDao::getInstance();        
            $room = new Room();
            $room->setId($p['id']);
            $room->setNameRoom($p['name_room']);
            $room->setCinema( $daoCinema->bring_by_id($p['cinema']));
            $room->setNumberRoom($p['number_room']);
            $room->setCantSite($p['cant_site']);
            return $room;
        }, $dataSet);
    }
}
}
?>