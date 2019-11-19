<?php
    namespace Controllers;

    //Dao
    use Dao\ShoppingBdDao as ShoppingDao;
    use Dao\CinemaBdDao as CinemaDao;
    use Dao\RoomBdDao as RoomDao;
    class StatsController
    {
        private $shopDao;
        private $cinemaDao;
        private $roomDao;
        public function __construct()
        {
            $this->shopDao = ShoppingDao::getInstance();
            $this->cinemaDao = CinemaDao::getInstance();
            $this->roomDao = RoomDao::getInstance();
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

        public function qSoldFunction($idFunction)
        {
            $qSoldFunction = $this->shopDao->sum_buy_by_function($idFunction);
            return $qSoldFunction;
        }

        public function notSoldFunction($idFunction)
        {
            $qSoldFunction = $this->shopDao->sum_buy_by_function($idFunction);
            $qCapacityFunction = $this->roomDao->

        }

    }
?>