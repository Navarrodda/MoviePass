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

    public function bring_id_by_cunema($idcinema){
        $sql = "SELECT id FROM $this->table WHERE cinema = \"$idcinema\" LIMIT 1";

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

    public function bring_by_day_for_cinema($day,$idcinema){
        try{
            $sql = "SELECT * FROM $this->table WHERE day = \"$day\" AND cinema = \"$idcinema\"";
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


    public function bring_Function_by_idCinema($cinema)
    {   
        try{
            if ($cinema != null) {
                $sql = "SELECT * FROM $this->table WHERE cinema = \"$cinema\"";

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
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }



    public function bring_by_date_idmovie_idcinema_hour($idcinema,$day,$idmovie,$hour)
    {
        try{
            $sql = ("SELECT * FROM $this->table WHERE day = \"$day\" AND cinema = \"$idcinema\" AND movie = \"$idmovie\" AND hours =\"$hour\"");

            $conec = Conection::conection();
            $judgment = $conec->prepare($sql);
            $judgment->execute();
            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($dataSet)) {
                return $dataSet;
            }
            return null;

        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
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
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }

    }

    public function add(Fuction $function){
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (cinema, movie, day, hours) VALUES (:cinema, :movie, :day, :hours)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $cine = $function->getCinema();
            $movi = $function->getMovie();

            $cinema = $cine->getId();
            $movie = $movi->getId();
            $day = $function->getDia();
            $hour = $function->getHora();

            $judgment->bindParam(":cinema",$cinema);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":day",$day);
            $judgment->bindParam(":hours",$hour);

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

    public function remove_by_id_cinema($id){
        try{

            $sql = "DELETE FROM $this->table WHERE cinema = \"$id \" Limit 1";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();

        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }


    public function to_update(Fuction $function, $id){

        try{
            $sql = ("UPDATE $this->table SET id=:id, cinema=:cinema, movie=:movie, day=:day, hours=:hours WHERE id=\"$id\"");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $cine = $function->getCinema();
            $movi = $function->getMovie();

            $cinema = $cine->getId();
            $movie = $movi->getId();
            $day = $function->getDia();
            $hours = $function->getHora();

            $judgment->bindParam(":id",$id);
            $judgment->bindParam(":cinema",$cinema);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":day",$day);
            $judgment->bindParam(":hours",$hour);


            $judgment->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function bring_by_date_dmovie_cinema($idcinema,$day,$idmovie)
    {
        return $this->bring_by_date_idmovie_idcinema($idcinema,$day,$idmovie);
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
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

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

    public function mapear($dataSet){
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->list = array_map(function ($f){
         $daoMovie = MovieBdDao::getInstance();
         $daoCinema = CinemaBdDao::getInstance();
         $fuction = new Fuction();

         $fuction->setId($f['id']);
         $fuction->setCinema($daoCinema->bring_by_id($f['cinema']));
         $fuction->setMovie($daoMovie->bring_by_id($f['movie']));
         $fuction->setDia($f['day']);
         $fuction->setHora($f['hours']);

         return $fuction;

     }, $dataSet);

        return count($dataSet) > 0 ? $dataSet : null;
        
    }
} 