<?php

namespace Model;

class Movie
{
    private $id;
    private $title;
    private $idApi;
    //private $vote_average;	//Calificacion Promedio
    //private $popularity; //Cant espectadores
    private $imagenruta;
    private $overview; 
    private $duration;
    private $genre;
    
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
    public function getVoteAverage()
    {
        return $this->vote_average;
    }

    /**
     * @param mixed $vote_average
     *
     * @return self
     */
    public function setVoteAverage($vote_average)
    {
        $this->vote_average = $vote_average;

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
    public function getImageruta()
    {
        return $this->imageruta;
    }

    /**
     * @param mixed $imageruta
     *
     * @return self
     */
    public function setImagenruta($imagenruta)
    {
        $this->imageruta = "http://image.tmdb.org/t/p/w500/".$imagenruta;

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
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

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
    public function getIdApi()
    {
        return $this->idApi;
    }

    /**
     * @param mixed $idApi
     *
     * @return self
     */
    public function setIdApi($idApi)
    {
        $this->idApi = $idApi;

        return $this;
    }
}