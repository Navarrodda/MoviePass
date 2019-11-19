<?php
    namespace Controllers;

    //Dao
    use Dao\Shopping as Shopping;
    use Dao\Cinema as Cinema;
    class StatsController
    {
        private $shopDao;
        private $cinemaDao;
        public function __construct()
        {
            $this->shopDao = Shopping::getInstance();
            $this->cinemaDao = Cinema::getInstance();
        }

        //Devuelve cantidades vendidas por cines
        public function qSoldCinema($idCinema)
        {
           return $this->shopDao->sum_buy_by_cinema($idCinema);
        }

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

        // public function notSoldFunction($idFunction)
        // {
        //     $qSoldFunction = $this->shopDao->sum_buy_by_function($idFunction);
        //     $qCapacityFunction = $this->cinema

        // }

    }
?>