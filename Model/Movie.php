<?php

namespace Model;

class Movie
{
    private $id;
    private $idapi;
    private $vote;
    private $poster;
    private $backdrop;
    private $language;
    private $title;
    private $genre;
    private $popularity;
    private $overview; 
    private $date;
    private $average;


    public function __construct()
    {
    	
    }





    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdapi()
    {
        return $this->idapi;
    }

    /**
     * @param mixed $idapi
     *
     * @return self
     */
    public function setIdapi($idapi)
    {
        $this->idapi = $idapi;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     *
     * @return self
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param mixed $poster
     *
     * @return self
     */
    public function setPoster($poster)
    {
        $this->poster = "http://image.tmdb.org/t/p/w500".$poster;
        $heders = get_headers($this->poster,1); 
        if ($heders[0] == "HTTP/1.1 404 Not Found") 
        {
            $this->poster = "/MoviePass/img/imgrot.jpg";
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackdrop()
    {
        return $this->backdrop;
    }

    /**
     * @param mixed $backdrop
     *
     * @return self
     */
    public function setBackdrop($backdrop)
    {
       $this->backdrop = "http://image.tmdb.org/t/p/w500".$backdrop;
       $heders = get_headers($this->backdrop,1); 
       if ($heders[0] == "HTTP/1.1 404 Not Found") 
       {
        $this->backdrop = "/MoviePass/img/imgrot.jpg";
    }
    return $this;
}

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     *
     * @return self
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @param mixed $popularity
     *
     * @return self
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param mixed $overview
     *
     * @return self
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAverage()
    {
        return $this->average;
    }

    /**
     * @param mixed $average
     *
     * @return self
     */
    public function setAverage($average)
    {
        $this->average = $average;

        return $this;
    }
}