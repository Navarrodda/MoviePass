<?php
namespace Dao;

use Model\Discount as Discount;

class DiscountBdDao
{
    protected $table = "discounts";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

        public function bring_by_for_id($id){
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

    public function bring_by_day($day)
    {
        try{
            $sql = "SELECT * FROM $this->table WHERE day = \"$day\" LIMIT 1";

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

    public function add(Discount $disc)
    {
        try{

            /** @noinspection SqlResolve */
            $sql = ("INSERT INTO $this->table (discount, description, day, hours) VALUES (:discount, :description, :day, :hours)");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $discount = $disc->getDisc();
            $description = $disc->getDescription();
            $day = $disc->getFecha();
            $hours = $disc->getHora();

            $judgment->bindParam(":discount",$discount);

            $judgment->bindParam(":description",$description);

            $judgment->bindParam(":day",$day);

            $judgment->bindParam(":hours",$hours);
 
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

    public function to_update(Discount $disc, $id){

        try{
            $sql = ("UPDATE $this->table SET discount=:discount, description=:description, day=:day,  hours=:hours WHERE id=\"$id\"");

            $conec = Conection::conection();

            $judgment = $conec->prepare($sql);

            $discount = $disc->getDisc();
            $description = $disc->getDescription();
            $day = $disc->getFecha();
            $hours = $disc->getHora();

            $judgment->bindParam(":discount",$discount);

            $judgment->bindParam(":description",$description);

            $judgment->bindParam(":day",$day);

            $judgment->bindParam(":hours",$hours);


            $judgment->execute();
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

    public function mapear($dataSet){
        $dataSet = is_array($dataSet) ? $dataSet : false;
        if($dataSet){
            $this->list = array_map(function ($p) {
                $discount = new Discount();
                $discount->setId($p['id']);
                $discount->setDisc($p['discount']);
                $discount->setDescription($p['description']);
                $discount->setFecha($p['day']);
                $discount->setHora($p['hours']);
                return $discount;
            }, $dataSet);
        }
    }
}
?>