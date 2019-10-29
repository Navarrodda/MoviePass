<?php 
namespace Dao;

use Model\Genre;

class GenreBdDao{

	protected $table = "genres";
	protected $list;
	private static $instance;

	public static function getInstance()
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function bring_id_by_name($name){
		$sql = "SELECT id FROM $this->table WHERE title = \"$name\" LIMIT 1";

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

		public function bring_id_by_idapi($idapi){
		$sql = "SELECT idapi FROM $this->table WHERE idapi = \"$idapi\" LIMIT 1";

		$conec = Conection::conection();

		$judgment = $conec->prepare($sql);

		$judgment->execute();


		$idapi = $judgment->fetch(\PDO::FETCH_ASSOC);

		if(!empty($idapi))
		{
			return $idapi['idapi'];
		}

		return null;
	}

	public function add(Genre $genre){
		try{

			/** @noinspection SqlResolve */
			$sql = ("INSERT INTO $this->table (idapi, name, image) VALUES (:idapi ,:name, :image)");

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);


			$idapi = $genre->getIdapi();
			$name = $genre->getName();
			$image = $genre->getImage();

			$judgment->bindParam(":idapi", $idapi);
			$judgment->bindParam(":name",$name);
			$judgment->bindParam(":image",$image);

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


	public function to_update(Genre $genre, $id){

		try{
			$sql = ("UPDATE $this->table SET idapi=:idapi name=:name image=:image WHERE id=\"$id\"");

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);

			$idapi = $genre->getIdapi();
			$name = $genre->getName();
			$image = $genre->getImage();

			$judgment->bindParam(":idapi", $idapi);
			$judgment->bindParam(":name",$name);
			$judgment->bindParam(":image",$image);

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
				$genre = new Genre();

				$genre->setIdapi($p['idapi']);
				$genre->setName($p['name']);
				$genre->setImage($p['image']);
				$genre->setId($p['id']);
				
				return $genre;
			}, $dataSet);
		}
	}

}
