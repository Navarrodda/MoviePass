<?php
    namespace controllers;

    //Model
    use \Model\Shopping as Shopping;
    use \Model\Message as Message;
    use \Model\Ticket as Ticket;
    //Controllers
    use \Controllers\FuctionController as FuctionC;
    //Dao
    use \Dao\TicketBdDao as TicDao;

    class TicketController
    {
        private $ticketDao;
        private $fuctionController;
        public function __construct()
        {
            $this->ticketDao = TicDao::getInstance();
            $this->fuctionController = new FuctionC();
        }

        //Add a new Ticket or Tickets in the db
        public function add(Shopping $shopping)
        {
            $wear = "LOGIN";
            if(!empty($_SESSION))
            {
                $fuction = $this->fuctionController->bringidfuction($shopping->getFuction()->getId());
                if($fuction !=null)
                {
                    $user = $shopping->getUser();
                    $fuction = $shopping->getFuction();
                    $cinema = $shopping->getFuction()->getCinema();
                    $room = $cinema->getRoom();
                    $movie = $fuction->getMovie();
                    $url = 
                    'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='."-Name: ".$user->getName()." -LastName: ".$user->getLastname()." -Cinema: ". $cinema->getNombre()." -Room: ".$room->getName_room()."-Movie: ".$fuction->getMovie()->getTitle()."-Day: ".$fuction->getgetDia()."-Hour: ".$fuction->getHora(); 
                    
                    $img = $user->getId(); 
                    $nameimg = 'img/Qr/'.$user->getName().$img;
                    $path = 'img/Qr/'.$user->getNikname().'/';
                    $array = array();
                    for($i = 1; $i <= $shopping->getCountrtiket();$i++)
                    {
                        // Function to write image into file
                        if(!is_dir($path))
                        {
                            mkdir( $path, true );
                        } 
                        file_put_contents($nameimg, file_get_contents($url));
                        $ticket = new Ticket();
                        $ticket->setShopping($shopping);
                        $ticket->setMovie($movie);
                        $ticket->setQr("C:/xampp/htdocs/MoviePass".$path.$img);
                        //Number Ticket = idFunction.idCinema.idRoom.idUser.idShopping.Qticket
                        $ticket->setNumbre($fuction->getId().$cinema->getId().$room->getId().$user->getId().$shopping->getId().$i);
                        $this->ticketDao->add($ticket);
                        array_push($array,$ticket->getNumbre);
                    }
                    
                }else{
                    $view = "MESSAGE";
					$wear =  strtolower($view);
					$this->message = new Message("warning","Function don't exist." );
                }
            }else
            {
                $wear = $wear . '.'.'php';
                include URL_VISTA . 'header.php';
                require(URL_VISTA . $wear);
                include URL_VISTA . 'footer.php';
            }
        }
        
    }
?>