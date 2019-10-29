<?php
    namespace Dao;

    use Model\Movie_X_Genre as Movie_X_Genre;
    use Dao\MovieBdDao as MovieBdDao;
    
    class MovieGenreBdDao
    {
        protected $table = "movie_for_genre";
        protected $list;
        private static $instance;
        
        public static function getInstance()
        {
            if (!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function bring_id_by_Movie($idMovie)
        {
             $sql = "SELECT id FROM $this->table WHERE movie = \"$idMovie\" LIMIT 1";

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

        public function bring_id_by_Genero($idGenre)
        {
             $sql = "SELECT id FROM $this->table WHERE genre = \"$idGenre\" LIMIT 1";

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

        public function bring_id_by_MovieAll($idMovie)
        {
             $sql = "SELECT id FROM $this->table WHERE movie = \"$idMovie\" ";

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

        public function bring_id_by_GeneroAll($idGenre)
        {
             $sql = "SELECT id FROM $this->table WHERE genre = \"$idGenre\" ";

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

        public function add(Movie_X_Genre $movieGenre){
            try{

                /** @noinspection SqlResolve */
                $sql = ("INSERT INTO $this->table (id, genre, movie) VALUES (:id, :genre, :movie)");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);
                $gen = $movieGenre->getGenre();
                $mov = $movieGenre->getMovie();

                $id = $movieGenre->getId();
                $genre = $gen->getId();
                $movie = $mov->getId();

                $judgment->bindParam(":id",$id);
                $judgment->bindParam(":genre",$genre);
                $judgment->bindParam(":movie",$movie);
                
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


        public function to_update(Movie_X_Genre $movieGenre, $id){

            try{
                $sql = ("UPDATE $this->table SET id=:ide genre=:genre movie=:movie WHERE id=\"$id\"");
                // id, genre, movie
                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);
            
                $gen = $movieGenre->getGenre();
                $mov = $movieGenre->getMovie();

                $ide = $id;
                $genre = $gen->getId();
                $movie = $mov->getId();

                $judgment->bindParam(":ide",$ide);
                $judgment->bindParam(":genre",$genre);
                $judgment->bindParam(":movie",$movie);
                


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
                    $movieGenre = new Movie_X_Genre();
                    $movieGenre->setId($p['id']);
                    // Esta mal mapea movie y genero con numero  id y no con objetos 
                    $movieGenre->setMovie($p['movie']);
                    $movieGenre->setGenre($p['genre']);

                    return $movieGenre;
                }, $dataSet);
            }
        }
    }
?>