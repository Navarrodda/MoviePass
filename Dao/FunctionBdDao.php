<?php 
namespace Dao;

use \Model\Fuction as Fuction;

class FunctionBdDao
{
    protected $table = "functions";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sum_capcity_functions($idFuction)
    {
        $sql = "SELECT sum(rooms.cant_site) FROM $this->table inner join rooms on rooms.id = functions.room WHERE fuctions.id = \"$idFuction\"";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();


        $sum = $judgment->fetch(\PDO::FETCH_ASSOC);

        if(!empty($sum))
        {
            return $sum;
        }

        return null;
    }

    public function sum_capcity_movie($idMovie)
    {
        $sql = "SELECT sum(rooms.cant_site) FROM $this->table inner join rooms on rooms.id = functions.room WHERE fuctions.id = \"$idFuction\"";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();


        $sum = $judgment->fetch(\PDO::FETCH_ASSOC);

        if(!empty($sum))
        {
            return $sum;
        }

        return null;
    }

    public function bring_id_by_room($idroom){
        $sql = "SELECT id FROM $this->table WHERE room = \"$idroom\" LIMIT 1";

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

    public function bring_id_by_day($day){
        $sql = "SELECT id FROM $this->table WHERE day = \"$day\" LIMIT 1";

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


    public function bring_by_day_for_room($day,$idroom){
        try{
           $sql = "SELECT * FROM $this->table WHERE day = \"$day\" AND room = \"$idroom\"";
            $conec = Conection::conection();
            $judgment = $conec->prepare($sql);
            $judgment->execute();
            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);
            $this->mapear($dataSet);
            if (!empty($dataSet)) {
                return $this->list;
            }
            return null;
            
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function bring_by_day_for_day($day){
        try{
            $sql = "SELECT * FROM $this->table WHERE day = \"$day\"";
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

    public function bring_by_day_for_room_and_movie($day,$idroom,$idmovie){
        try{
            $sql = "SELECT * FROM $this->table WHERE day = \"$day\" AND room = \"$idroom\" AND movie = \"$idmovie\"";
            $conec = Conection::conection();
            $judgment = $conec->prepare($sql);
            $judgment->execute();
            $dataSet = $judgment->fetch(\PDO::FETCH_ASSOC);
            if($dataSet) {
                return true;
            }
            return false;
            
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function bring_id_by_hour($hours){
        $sql = "SELECT id FROM $this->table WHERE hours = \"$hours\" LIMIT 1";

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
        //Devuelve todas las funciones del cine


    public function bring_Function_by_idroom($room)
    {   
        try{
            if ($room != null) {
                $sql = "SELECT * FROM $this->table WHERE room = \"$room\"";

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);

                $judgment->execute();


                $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

                $this->mapear($dataSet);

                if(!empty($this->list)){

                    return $this->list;
                }
            }

            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }



    public function bring_by_date_idroom_hour($idroom,$day,$hour)
    {
        try{
            $sql = ("SELECT * FROM $this->table WHERE day = \"$day\" AND room = \"$idroom\" AND hours =\"$hour\"");

            $conec = Conection::conection();
            $judgment = $conec->prepare($sql);
            $judgment->execute();
            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($dataSet)) {
                return $dataSet;
            }
            return null;

        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }


    public function bring_Function_by_idMovies_for_day($idMovie,$day)
    {   
        try{
            if ($idMovie != null) {
                $sql = ("SELECT * FROM $this->table WHERE movie = \"$idMovie\" AND day = \"$day\"" );
                $conec = Conection::conection();
                $judgment = $conec->prepare($sql);
                $judgment->execute();
                $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);
                $this->mapear($dataSet);
                if (!empty($this->list)) {
                    return $this->list;
                }
                return null;
            }
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function bringe_for_data($day)
    {   
        try{
            if ($day != null) {
                $sql = ("SELECT * FROM $this->table WHERE day = \"$day\"" );
                $conec = Conection::conection();
                $judgment = $conec->prepare($sql);
                $judgment->execute();
                $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);
                $this->mapear($dataSet);
                if (!empty($this->list)) {
                    return $this->list;
                }
                return null;
            }
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function bring_Function_by_idMovies($idMovie)
    {   
        try{
            if ($idMovie != null) {
                $sql = ("SELECT * FROM $this->table WHERE movie = \"$idMovie\"" );
                $conec = Conection::conection();
                $judgment = $conec->prepare($sql);
                $judgment->execute();
                $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);     
                if (!empty($dataSet)) {
                    $this->mapear($dataSet);
                    return $this->list;
                }
                return null;
            }
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function add(Fuction $function){
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (room, movie, day, hours) VALUES (:room, :movie, :day, :hours)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $room = $function->getRoom();
            $movi = $function->getMovie();

            $room = $room->getId();
            $movie = $movi->getId();
            $day = $function->getDia();
            $hour = $function->getHora();

            $judgment->bindParam(":room",$room);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":day",$day);
            $judgment->bindParam(":hours",$hour);

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

    public function remove_by_id_cinema_room($id){
        try{

            $sql = "DELETE FROM $this->table WHERE room = \"$id \"";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();

        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function remove_by_id_movie($id){
        try{

            $sql = "DELETE FROM $this->table WHERE movie = \"$id \"";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();

        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }


    public function to_update(Fuction $function, $id){

        try{
            $sql = ("UPDATE $this->table SET  room=:room, movie=:movie, day=:day, hours=:hours WHERE id=\"$id\"");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $room = $function->getRoom();
            $movi = $function->getMovie();

            $room = $room->getId();
            $movie = $movi->getId();
            $day = $function->getDia();
            $hour = $function->getHora();

            $judgment->bindParam(":room",$room);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":day",$day);
            $judgment->bindParam(":hours",$hour);


            $judgment->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }


    private function bring_by_date_idmovie_idcinema($idcinema,$day,$idmovie)
    {
        try{
            $sql = "SELECT * FROM $this->table WHERE day = \"$day\" AND cinema = \"$idcinema\" AND movie = \"$idmovie\" ";
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

    public function bring_everything(){
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
    }


    public function bring_by_id($idfuncion)
    {   
        try{
            if ($idfuncion != null) {
               $sql = ("SELECT * FROM $this->table WHERE id = \"$idfuncion\" limit 1" );

               $conec = Conection::conection();

               $judgment = $conec->prepare($sql);
               
               $judgment->execute();

               $dataSet[] = $judgment->fetchAll(\PDO::FETCH_ASSOC);
               
               $this->mapear($dataSet[0]);

               if(!empty($this->list[0])){

                return $this->list[0];
            }
            

            return null;
        }
    }catch(\PDOException $e){
        echo $e->getMessage();
    }catch(\Exception $e){
        echo $e->getMessage();
    }
}


public function mapear($dataSet){
  $dataSet = is_array($dataSet) ? $dataSet : false;
    if($dataSet){
        $this->list = array_map(function ($f){
         $daoMovie = MovieBdDao::getInstance();
         $daoRoom = RoomBdDao::getInstance();
         $fuction = new Fuction();

         $fuction->setId($f['id']);
         $fuction->setRoom($daoRoom->bring_by_id($f['room']));
         $fuction->setMovie($daoMovie->bring_by_id($f['movie']));
         $fuction->setDia($f['day']);
         $fuction->setHora($f['hours']);

         return $fuction;

     }, $dataSet);

    }

}
}