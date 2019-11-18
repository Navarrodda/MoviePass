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

            $arrayMg = $judgment->fetch(\PDO::FETCH_ASSOC);

            $this->mapear($arrayMg);

            if(!empty($this->list))
            {
                return $this->list;
            }

            return null;
        }catch(\PDOException $e){
            echo $e->getMessage();die();
        }catch(\Exception $e){
            echo $e->getMessage();die();
        }
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

    public function add(Shopping $shopping){
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (user, function, discount, day, countrtiket, price, total) VALUES (:user, :function, :discount, :day, ,:countrtiket :price, :total)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $user = $shopping->getUser();
            $function = $shopping->getFunction();
            if($shopping->getDiscount() != null)
            {
                $discount = $shopping->getDiscount();
                $discount = $discount ->getId();
            }else{
                $discount = 0;
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

                $buy = new Buy();
                $DaoUser = UserBdDao::getInstance();
                $DaoFunction = FunctionBdDao::getInstance();
                $DaoDiscount = DiscountBdDao::getInstance();
                //id_user, id_function, id_descuento, date, countrtiket, price, total
                $buy->setId('id');
                $buy->setUser($DaoUser->bring_by_id($p['user']));
                $buy->setFunction($DaoFunction->bring_by_id($p['function']));
                $buy->setDiscount($DaoDiscount->bring_by_id($p['discount']));
                $buy->setDate($p['date']);
                $buy->setCountrtiket('countrtiket');
                $buy->setPrice($p['price']);
                $buy->setTotal($p['total']);
                return $buy;
            }, $dataSet);
        }
    }
}
?>