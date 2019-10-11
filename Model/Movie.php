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
    private $release_date;
    private $vote_count;
    private $vote_average;
    private $original_language;
    
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
        $this->imageruta = "http://image.tmdb.org/t/p/w500".$imagenruta;
        $heders = get_headers($this->imageruta,1); 
        if ($heders[0] == "HTTP/1.1 404 Not Found") {
            $this->imageruta = "/MoviePass/img/imgrot.jpg";
        }
                
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

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @param mixed $release_date
     *
     * @return self
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoteCount()
    {
        return $this->vote_count;
    }

    /**
     * @param mixed $vote_count
     *
     * @return self
     */
    public function setVoteCount($vote_count)
    {
        $this->vote_count = $vote_count;

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
    public function getOriginalLanguage()
    {
        return $this->original_language;
    }

    /**
     * @param mixed $original_language
     *
     * @return self
     */
    public function setOriginalLanguage($original_language)
    {
        $this->original_language = $original_language;

        return $this;
    }
}