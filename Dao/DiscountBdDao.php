<?php
    namespace Dao;

    use Model\Discount as Discount;

    class DiscountBdDao
    {
        protected $table = "discount";
        protected $list;
        private static $instance;

        public static function getInstance()
        {
            if (!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function add(Discount $discount)
        {
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (disc, description, fecha) VALUES (:disc, :description, :fecha)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $disc = $discount->getDisc();
            $description = $description->getDescription();
            $fecha = $fecha->getFecha();

            $judgment->bindParam(":disc",$disc);
            $judgment->bindParam(":description",$description);
            $judgment->bindParam(":fecha",$fecha);

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

    public function to_update(Discount $discount, $id){

        try{
            $sql = ("UPDATE $this->table SET disc=:disc description=:description fecha=:fecha WHERE id=\"$id\"");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $disc = $discount->getDisc();
            $description = $description->getDescription();
            $fecha = $fecha->getFecha();

            $judgment->bindParam(":disc",$disc);
            $judgment->bindParam(":description",$description);
            $judgment->bindParam(":fecha",$fecha);


            $judgment->execute();
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
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
            $daoRol = RolBdDao::getInstance();
            $discount = new Discount();
            
            $user = new User
            (
                $p['nikname'],
                $p['email'],
                $p['name'],
                $p['lastname'],
                $p['dni'],
                $p['password'],
                $daoRol->bring_by_id($p['rol'])
            );
            $user->setId($p['id']);
            return $user;
        }, $dataSet);
    }
    }
    }
?>