<?php
    namespace Dao;

    use Model\Buy as Buy;
    use Model\User as User;
    use Model\Function as Function;
    use Model\Discount as Discount;
    class BuyBdDao
    {
        protected $table = "buy";
        protected $list;
        private static $instance;
        
        public static function getInstance()
        {
            if (!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function bring_buy_by_User($idUser)
        {
            $sql = "SELECT * FROM $this->table WHERE id_user = \"$idUser\" ";

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
        
        public function bring_buy_by_Function($idUfunction)
        {
            $sql = "SELECT * FROM $this->table WHERE id_function = \"$idFunction\" ";

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

        public function add(Buy $buy){
            try{

                /** @noinspection SqlResolve */
                $sql = ("INSERT INTO $this->table (id_user, id_function, id_descuento, date, price, total) VALUES (:id_user, :id_function, :id_descuento, :date, :price, :total)");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);
                $user = new User();
                $function = new Function();
                $discount = new Discount();

                $user = $buy->getUser();
                $function = $buy->getFunction();
                $discount = $buy->getDiscount();

                $id_user = $user->getId();
                $id_function = $function->getId();
                $id_descuento = $discount ->getId();
                $fecha = $buy->getFecha();
                $price = $buy->getPrecio();
                $total = $buy->getTotal();

                $judgment->bindParam(":id_user",$id_user);
                $judgment->bindParam(":id_function",$id_function);
                $judgment->bindParam(":id_descuento", $id_descuento);
                $judgment->bindParam(":date",$fecha);
                $judgment->bindParam(":price",$price);
                $judgment->bindParam(":total",$total);

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


        public function to_update(Buy $buy, $id){

            try{
                $sql = ("UPDATE $this->table SET id_user=:id_user id_function=:id_function id_descuento=:id_descuento date=:date price=:price total=:total WHERE id=\"$id\"");
                // id, genre, movie
                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);
            
                $judgment = $conec->prepare($sql);
                $user = new User();
                $function = new Function();
                $discount = new Discount();

                $user = $buy->getUser();
                $function = $buy->getFunction();
                $discount = $buy->getDiscount();

                $id_user = $user->getId();
                $id_function = $function->getId();
                $id_descuento = $discount ->getId();
                $fecha = $buy->getFecha();
                $price = $buy->getPrecio();
                $total = $buy->getTotal();

                $judgment->bindParam(":id_user",$id_user);
                $judgment->bindParam(":id_function",$id_function);
                $judgment->bindParam(":id_descuento", $id_descuento);
                $judgment->bindParam(":date",$fecha);
                $judgment->bindParam(":price",$price);
                $judgment->bindParam(":total",$total);
                


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
                
                $buy = new Buy();
                $DaoUser = UserBdDao::getInstance();
                $DaoFunction = FunctionBdDao::getInstance();
                $DaoDiscount = DiscountBdDao::getInstance();
                //id_user, id_function, id_descuento, date, price, total
                $buy->setUser(UserBdDao->bring_by_id($p['id_user']);
                $buy->setFunction(FunctionBdDao->bring_by_id($p['id_function']));
                $buy->setDiscount(DiscountBdDao->bring_by_id($p['id_discount']));
                $buy->setFecha($p['date']);
                $buy->getPrecio($p['price']);
                $buy->getTotal($p['total']);

                    return $buy;
                }, $dataSet);
            }
        }
    }
?>