<?php
namespace Dao;

use \Model\Shopping as Shopping;
use \Model\User as User;
use \Model\Fuction as Fuction;
use \Model\Discount as Discount;

class ShoppingsBdDao
{
    protected $table = "shoppings";
    protected $list;
    private static $instance;
    
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bring_buy_by_user($idUser)
    {
        try{
            $sql = "SELECT * FROM $this->table WHERE user = \"$idUser\" ";

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
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
    }

    public function sum_buy_by_cinema($idCinema)
    {
        $sql = "SELECT sum(shoppings.countrtiket) FROM $this->table inner join functions on $this->table.function = functions.id inner join rooms on functions.room = rooms.id  WHERE rooms.cinema = \"$idCinema\" ";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

        $count = $judgment->fetch(\PDO::FETCH_ASSOC);

        

        if(!empty($count))
        {
            return $count;
        }

        return null;
    }

    public function sum_buy_by_function($idFunction)
    {
        $sql = "SELECT sum(shoppings.countrtiket) FROM $this->table WHERE function = \"$idFunction\" ";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

        $count = $judgment->fetch(\PDO::FETCH_ASSOC);

        

        if(!empty($count))
        {
            return $count;
        }

        return null;
    }
    
    public function bring_buy_by_Function($idFunction)
    {
        $sql = "SELECT * FROM $this->table WHERE function = \"$idFunction\" ";

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

    public function add(Shopping $shopping){
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (user, function, discount, day, countrtiket, price, total) VALUES (:user, :function, :discount, :day, :countrtiket, :price, :total)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $user = $shopping->getUser();
            $function = $shopping->getFunction();
            if($shopping->getDiscount() != null)
            {
                $discount = $shopping->getDiscount();
                $discount = $discount ->getId();
            }else{
                $discount = null;
            }
           

            $user = $user->getId();
            $function = $function->getId();
            $date = $shopping->getDate();
            $countrtiket = $shopping->getCountrtiket();
            $price = $shopping->getPrice();
            $total = $shopping->getTotal();

            $judgment->bindParam(":user",$user);
            $judgment->bindParam(":function",$function);
            $judgment->bindParam(":discount", $discount);
            $judgment->bindParam(":day",$date);
            $judgment->bindParam(":countrtiket",$countrtiket);
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



    public function update(Shopping $shopping, $id){

        try{
            $sql = ("UPDATE $this->table SET user=:user, function=:function, discount=:discount, date=:date, countrtiket=:countrtiket, price=:price, total=:total WHERE id=\"$id\"");
                // id, genre, movie
            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $user = $shopping->getUser();
            $function = $shopping->getFunction();
            $discount = $shopping->getDiscount();
            if(!empty($discount))
            {
                $discount = $discount ->getId();
            }

            $user = $user->getId();
            $function = $function->getId();
            
            $date = $shopping->getDate();
            $price = $shopping->getPrice();
            $total = $shopping->getTotal();
            $countrtiket = $shopping->getCountrtiket();

            $judgment->bindParam(":user",$user);
            $judgment->bindParam(":function",$function);
            $judgment->bindParam(":discount", $discount);
            $judgment->bindParam(":date",$date);
            $judgment->bindParam(":countrtiket",$countrtiket);
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

                $shopping = new Shopping();
                $daoUser = UserBdDao::getInstance();
                $daoFunction = FunctionBdDao::getInstance();
                $daoDiscount = DiscountBdDao::getInstance();
                //id_user, id_function, id_descuento, date, countrtiket, price, total
                $shopping->setId($p['id']);
                $shopping->setUser($daoUser->bring_by_id($p['user']));
                $shopping->setFunction($daoFunction->bring_by_id($p['function']));
                if(!empty($daoDiscount->bring_by_id($p['discount'])))
                {
                    $shopping->setDiscount($daoDiscount->bring_by_id($p['discount']));
                }
                $shopping->setDate($p['day']);
                $shopping->setCountrtiket($p['countrtiket']);
                $shopping->setPrice($p['price']);
                $shopping->setTotal($p['total']);
                return $shopping;
            }, $dataSet);
        }
    }
}
?>