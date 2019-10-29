<?php
    namespace Dao;

    use Model\Ticket as Ticket;
    class TicketBdDao
    {
        protected $table = "tickets";
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
                $sql = ("INSERT INTO $this->table (id, nro_entrada, nro_funcion) VALUES (:id, :nro_entrada, :nro_funcion)");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);

                $id = $ticket->getId();
                $nro_entrada = $ticket->getNro_entrada();
                $nro_funcion = $ticket->getNro_funcion();

               

                $judgment->bindParam(":id",$id);
                $judgment->bindParam(":nro_entrada",$nro_entrada);
                $judgment->bindParam(":nro_funcion",$nro_funcion);
                
                $judgment->execute();

                return $conec->lastInsertId();
            }catch(\PDOException $e){
                echo $e->getMessage();die();
            }catch(\Exception $e){
                echo $e->getMessage();die();
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
                echo $e->getMessage();die();
            }catch(\Exception $e){
                echo $e->getMessage();die();
            }
        }


        public function to_update(Ticket $ticket, $id)
        {

            try{
                $sql = ("UPDATE $this->table SET id=:id nro_entrada=:nro_entrada nro_funcion=:nro_funcion WHERE id=\"$id\"");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);

                $nro_entrada = $ticket->getNro_entrada();
                $nro_funcion = $ticket->getNro_funcion();

                $judgment->bindParam(":id",$id);
                $judgment->bindParam(":nro_entrada",$nro_entrada);
                $judgment->bindParam(":nro_funcion",$nro_funcion);


                $judgment->execute();
            }catch(\PDOException $e){
                echo $e->getMessage();die();
            }catch(\Exception $e){
                echo $e->getMessage();die();
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

        public function mapear($dataSet)
        {
            $dataSet = is_array($dataSet) ? $dataSet : false;
            if($dataSet){
                $this->list = array_map(function ($p) {
                    $ticket = new Ticket();
                    $ticket->setId($p['id']);
                    $ticket->setNro_entrada($p['nro_entrada']);
                    $ticket->setNro_funcion($p['nro_funcion']);
                    return $ticket;
                }, $dataSet);
            }
        }
    }
?>