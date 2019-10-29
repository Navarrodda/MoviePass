<?php
    namespace Model;

    use Model\Movie as Movie;
    use Model\Genre as Genre;
    
    class Movie_X_Genre
    {
        private $id;
        private $movie;
        private $genre;

        public function __construct()
        {

        }
        
         /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of movie
         */ 
        public function getMovie()
        {
                return $this->movie;
        }

        /**
         * Set the value of movie
         *
         * @return  self
         */ 
        public function setMovie(Movie $movie)
        {
                $this->movie = $movie;

                return $this;
        }

        /**
         * Get the value of genre
         */ 
        public function getGenre()
        {
                return $this->genre;
        }

        /**
         * Set the value of genre
         *
         * @return  self
         */ 
        public function setGenre(Genre $genre)
        {
                $this->genre = $genre;

                return $this;
        }
    }
?>