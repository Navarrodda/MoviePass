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
            $fuction = $this->fuctionController->bringidfuction($shopping->getFunction()->getId());
            if($fuction !=null)
            {
                $user = $shopping->getUser();
                $fuction = $shopping->getFunction();
                $cinema = $shopping->getFunction()->getRoom()->getCinema();
                $room = $shopping->getFunction()->getRoom();
                $movie = $fuction->getMovie();
                $img = $user->getId(); 
                $path = 'img/Qr/'.$user->getNikname().'/';
                $array = array();
                for($i = 1; $i <= $shopping->getCountrtiket();$i++)
                {
                    // Function to write image into file
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='."-Name:".$user->getName()."-LastName:".$user->getLastname()."-Cinema:".$cinema->getNombre()."-Room:".$room->getNameRoom()."-Movie:".$fuction->getMovie()->getTitle()."-Day:".$fuction->getDia()."-Hour:".$fuction->getHora().$i; 
                    $url = str_replace(' ', '', $url);
                    $nameimg = 'img/Qr/'.$user->getNikname().'/'.$img.'-'.$shopping->getId().'-'.$shopping->getDate().'-'.$i.".png";
                    file_put_contents($nameimg, file_get_contents($url));
                    $ticket = new Ticket();
                    $ticket->setShopping($shopping);
                    $ticket->setMovie($movie);
                    $ticket->setQr("http://localhost/MoviePass/".$nameimg);
                        //Number Ticket = idFunction.idCinema.idRoom.idUser.idShopping.Qticket
                    $ticket->setNumbre($fuction->getId().$cinema->getId().$room->getId().$user->getId().$shopping->getId().$i);
                    $this->ticketDao->add($ticket);
                }

            }
        }
        
    }

    public function brindforidshopping($idshopping)
    {
       return $this->ticketDao->bring_by_id_tha_shoping($idshopping);
    }
}
