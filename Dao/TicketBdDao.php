<?php
namespace Dao;

use Model\Ticket as Ticket;
class TicketBdDao
{
    protected $table = "tikets";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bring_id_by_nrEntrada($nroEntrada)
    {
        $sql = "SELECT id FROM $this->table WHERE nro_entrada = \"$nroEntrada\" LIMIT 1";

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

    public function add(Ticket $ticket)
    {
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (shopping, movie, qr, numbre) VALUES (:shopping, :movie, :qr, :numbre)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);
            
            $idshopping = $ticket->getShopping();
            $idmovie =  $ticket->getMovie();
            
            if(!empty($ticket->getSeat()))
            {
                $seat = $ticket->getSeat();
            }
            else
            {
                $seat = null;
            }
            $qr = $ticket->getQr();
            $numbre = $ticket->getNumbre();

            $shopping =  $ticket->getShopping()->getId();
            $movie = $ticket->getMovie()->getId();

            $judgment->bindParam(":shopping",$shopping);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":qr",$qr);
            $judgment->bindParam(":numbre",$numbre);

            $judgment->execute();

            return $conec->lastInsertId();
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function remove_by_id($id)
    {
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


    public function to_update(Ticket $ticket, $id)
    {

        try{
            $sql = ("UPDATE $this->table SET  shopping=:shopping, movie=:movie, seat=:seat, qr=:qr, numbre=:numbre WHERE id=\"$id\"");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $idshopping = $ticket->getShopping();
            $idmovie =  $ticket->
            $seat = $ticket->getSeat();
            $qr = $ticket->getQr();
            $numbre = $ticket->getNumbre();

            $shopping =  $idshopping->getId();
            $movie = $idmovie->getId();



            $judgment->bindParam(":shopping",$shopping);
            $judgment->bindParam(":movie",$movie);
            $judgment->bindParam(":seat",$seat);
            $judgment->bindParam(":qr",$qr);
            $judgment->bindParam(":numbre",$numbre);

            $judgment->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function bring_everything()
    {
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
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }


    public function bring_by_id_tha_shoping($idsoping)
    {
        try{
            $sql = "SELECT * FROM $this->table WHERE shopping = \"$idsoping\" ";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();


            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

            $this->mapear($dataSet);

            if(!empty($this->list)){

                return $this->list;
            }
            

            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

        public function bring_by_id_tha_movie($idmovie)
    {
        try{
            $sql = "SELECT * FROM $this->table WHERE movie = \"$idmovie\" ";

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $judgment->execute();


            $dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

            $this->mapear($dataSet);

            if(!empty($this->list)){

                return $this->list;
            }
            

            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : false;
        if($dataSet){
            $this->list = array_map(function ($p) { 
                $DaoShopping = ShoppingsBdDao::getInstance();
                $DaoMovie = MovieBdDao::getInstance();
                $ticket = new Ticket();
                $ticket->setId($p['id']);
                $ticket->setShopping($DaoShopping->bring_by_id($p['shopping']));
                $ticket->setMovie($DaoMovie->bring_by_id($p['movie']));
                $ticket->setSeat($p['seat']);
                $ticket->setQr($p['qr']);
                $ticket->setNumbre($p['numbre']);
                return $ticket;
            }, $dataSet);
        }
    }

}