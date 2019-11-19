<?php
    namespace Controllers;

    //Dao
    use Dao\ShoppingBdDao as ShoppingDao;
    use Dao\CinemaBdDao as CinemaDao;
    use Dao\RoomBdDao as RoomDao;
    use Dao\FuctionBdDao as FuctionDao;
    use Dao\MovieBdDao as MovieDao;
    class StatsController
    {
        private $shopDao;
        private $cinemaDao;
        private $roomDao;
        private $fuctionDao;
        private $movieDao;
        public function __construct()
        {
            $this->shopDao = ShoppingDao::getInstance();
            $this->cinemaDao = CinemaDao::getInstance();
            $this->roomDao = RoomDao::getInstance();
            $this->fuctionDao = FuctionDao::getInstance();
            $this->MovieBdDao = MovieDao::getInstance();
        }

        //Devuelve cantidades vendidas por cines
        public function qSoldCinema($idCinema)
        {
           return $this->shopDao->sum_buy_by_cinema($idCinema);
        }

        //Devuelve cantidades no vendidas Cinema
        public function notSoldCinema($idCinema)
        {
            $qsold = $this->qSoldCinema($idCinema);
            $qCapacity = $this->cinemaDao->bring_capacity_by_id($idCinema);
            return $qCapacity - $qsold;
        }
        //Devuelve cantidades vendidas por Fuction
        public function qSoldFunction($idFunction)
        {
            $qSoldFunction = $this->shopDao->sum_buy_by_function($idFunction);
            return $qSoldFunction;
        }
        //Devuelve cantidades no vendidas Fuction
        public function notSoldFunction($idFunction)
        {
            $qSoldFunction = $this->shopDao->sum_buy_by_function($idFunction);
            $qCapacityFunction = $this->roomDao->sum_capcity_functions($idFuction);

            return $qCapacityFunction - $qSoldFunction;
        }

        //Devuelve cantidades por pelicula
        public function qSoldMovie($idMovie)
        {

            $qSoldMovie = $this->shopDao->sum_buy_by_Movie($idMovie);
            return $qSoldMovie;
        } 

        //Devuelve cantidades no vendidas por Pelicula
        public function notSoldMovie($idMovie)
        {   
            $qSoldMovie = $this->shopDao->sum_buy_by_Movie($idMovie);
            $qCapacityMovie = $this->sum_capcity_movie($idMovie);
            return $qCapacityMovie - $qSoldMovie;
        }
    }
?>