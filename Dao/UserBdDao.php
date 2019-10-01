<?php

namespace Dao;

use \Model\User;

class UserBdDao{

    protected $table = "users";
    protected $list;
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bring_id_by_email($email){
        $sql = "SELECT id FROM $this->table WHERE email = \"$email\" LIMIT 1";

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

    public function add(User $user){
      try{

        /** @noinspection SqlResolve */
        $sql = ("INSERT INTO $this->table (rol, nikname ,email, password) VALUES (:rol, :nikname, :email, :password)");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $r = $user->getRole();
        $rol = $r->getId();

        $nikname = $user->getNikname();
        $email = $user->getEmail();
        $password = $user->getPassword();


        $judgment->bindParam(":rol",$rol);
        $judgment->bindParam(":nikname",$nikname);
        $judgment->bindParam(":email", $email);
        $judgment->bindParam(":password", $password);

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

public function remove_by_mail($email){
    /** @noinspection SqlResolve */
    $sql = "DELETE FROM $this->table WHERE email = \"$email\"";

    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();
}

public function to_update(User $user, $id){

    try{
        $sql = ("UPDATE $this->table SET rol=:rol, nombre=:nombre,  nikname=:nikname, email=:email,pass=:pass WHERE id=\"$id\"");

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $r = $user->getRole();
        $rol = $r->getId();

        $nikname = $user->getNikname();
        $email = $user->getEmail();
        $password = $user->getPassword();


        $judgment->bindParam(":rol",$rol);
        $judgment->bindParam(":nikname",$nikname);
        $judgment->bindParam(":email", $email);
        $judgment->bindParam(":password", $password);


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


public function verify_email($email){


    $sql = "SELECT * FROM $this->table WHERE email = \"$email\" LIMIT 1";
    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();
    
    $dataSet = $judgment->fetch(\PDO::FETCH_ASSOC);

    if(!empty($dataSet))
    {
        return TRUE;
    }

    return FALSE;
}

public function bring_by_id($id)
{   
    try{
        if ($id_usuario != null) {
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

public function bring_by_mail($email){
    try{
        $sql = "SELECT * FROM $this->table WHERE email =  \"$email\" LIMIT 1";

        $conec = Conection::conection();

        $judgment = $conec->prepare($sql);

        $judgment->execute();

        $dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->list[0])) {
            return $this->list[0];
        }

        return null;
    }catch(\PDOException $e){
        echo $e->getMessage();die();
    }catch(\Exception $e){
        echo $e->getMessage();die();
    }
}

public function bring_by_nikname($nikname){
    /** @noinspection SqlResolve */
    $sql = "SELECT * FROM $this->table WHERE nikname =  \"$nikname\" LIMIT 1";

    $conec = Conection::conection();

    $judgment = $conec->prepare($sql);

    $judgment->execute();

    $dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

    $this->mapear($dataSet);

    if (!empty($this->list[0])) {
        return $this->list[0];
    }

    return null;
}

public function mapear($dataSet){
    $dataSet = is_array($dataSet) ? $dataSet : false;
    if($dataSet){
       $this->list = array_map(function ($p) {
        $daoRol = RolBdDao::getInstance();
        $usuario = new User
        (
            $p['nikname'],
            $p['email'],
            $p['password'],
            $daoRol->traerPorId($p['rol'])
        );
        $usuario->setId($p['id']);
        return $usuario;
    }, $dataSet);
   }
}
}
