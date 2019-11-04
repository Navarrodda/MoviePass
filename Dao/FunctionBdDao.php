<?php 
namespace Dao;
use Model\Fuction as Fuction;
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
    public function bring_Function_by_idCinema($idCinema){
        $sql = "SELECT id FROM $this->table WHERE cinema = \"$idCinema\" LIMIT 1";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();


        $arrayMg = $judgment->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($arrayMg);

        if(!empty($this->list))
        {
            return $this->list;
        }

        return null;
    }

    public function bring_Function_by_idMovies($idMovie)
    {
        $sql = "SELECT id FROM $this->table WHERE movie = \"$idMovie\" LIMIT 1";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();


        $arrayMg = $judgment->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($arrayMg);

        if(!empty($this->list))
        {
            return $this->list;
        }

        return null;
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
        $dataSet = is_array($dataSet) ? $dataSet : false;
        if($dataSet){
            $this->list = array_map(function ($p) {
                $function = new Fuction();

                $cine = new Cine();
                $movie = new Movie();
                $cine->setId($p['cine']);
                $movie->setId($p['movie']);
                $function->setId($p['id']);
                    //Carga cine con solo el id;
                $function->setCine($cine);
                    //Carga pelicula con solo el id;
                $function->setMovie($movi);
                $function->setDia($p['day']);
                $function->setHora($p['hours']);

                return $function;
            }, $dataSet);
        }
    }
}
?>