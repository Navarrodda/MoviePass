<?php 
    namespace Dao;
    use Model\Function as Function;
    class FunctionDao
    {
        protected $table = "functions";
        protected $list;
        private static $instance;

        public static function getInstance()
        {
            if (!self::$instance instanceof self) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        //Devuelve todas las funciones del cine
        public function bring_Function_by_idCinema($idCinema){
            $sql = "SELECT id FROM $this->table WHERE cinema = \"$idCinema\" LIMIT 1";

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

        public function bring_Function_by_idMovies($idMovie)
        {
            $sql = "SELECT id FROM $this->table WHERE movie = \"$idMovie\" LIMIT 1";

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

        public function add(Function $function){
            try{

                /** @noinspection SqlResolve */
                $sql = ("INSERT INTO $this->table (id, cinema, movie, day, hours) VALUES (:id, :cinema, :movie, :day, :hours)");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);

                $cine = $function->getCinema();
                $movi = $function->getMovie();

                $id = $function->getId();
                $cinema = $cine->getId();
                $movie = $movi->getId();
                $day = $function->getDia();
                $hour = $function->getHora();

                //:id, :cinema, :movie, :day, :hours

                $judgment->bindParam(":id",$id);
                $judgment->bindParam(":cinema",$cinema);
                $judgment->bindParam(":movie",$movie);
                $judgment->bindParam(":day",$day);
                $judgment->bindParam(":hours",$hour);
                
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

        // hasta aca llegue

        public function to_update(Movie $movie, $id){

            try{
                $sql = ("UPDATE $this->table SET idApi=:idApi, vote=:vote, poster=:poster, backdrop=:backdrop, lan=:lan, title=:title, popularity=:popularity, overview=:overview, datemdy=:datemdy, average=:average duration=:duration WHERE id=\"$id\"");

                $conec = Conection::conection();

                $judgment = $conec->prepare($sql);

                $idApi = $movie->getIdapi();
                $vote = $movie->getVote();
                $poster = $movie->getPoster();
                $backdrop = $movie->getBackdrop();
                $lan = $movie->getLanguage();
                $title = $movie->getTitle();
                $popularity = $movie->getPopularity();
                $overview = $movie->getOverview();
                $datemdy = $movie->getDate();
                $average = $movie->getAverage();
                $duration = $movie->getDuration();

                $judgment->bindParam(":idApi",$idApi);
                $judgment->bindParam(":vote",$vote);
                $judgment->bindParam(":poster",$poster);
                $judgment->bindParam(":backdrop",$backdrop);
                $judgment->bindParam(":lan",$lan);
                $judgment->bindParam(":title",$title);
                $judgment->bindParam(":popularity", $popularity);
                $judgment->bindParam(":overview", $overview);
                $judgment->bindParam(":datemdy", $datemdy);
                $judgment->bindParam(":average", $average);
                $judgment->bindParam(":duration", $duration);


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
                    $movie = new Movie();
                    $movie->setIdapi($p['idapi']);
                    $movie->setVote($p['vote']);
                    $movie->setPoster($p['poster']);
                    $movie->setBackdrop($p['backdrop']);
                    $movie->setLanguage($p['lan']);
                    $movie->setTitle($p['title']);
                    $movie->setPopularity($p['popularity']);
                    $movie->setOverview($p['overview']);
                    $newDate = date("d/m/Y", strtotime($p['datemdy']));
                    $movie->setDate($newDate);
                    $movie->setAverage($p['average']);
                    $movie->setDuration($p['duration']);
                    $movie->setId($p['id']);
                    return $movie;
                }, $dataSet);
            }
        }
    }
?>