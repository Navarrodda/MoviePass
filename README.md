# MoviePass
Programming project + bd + Systems methodology

# MoviePass Key
David Navarro key:cd58ca24ec91f2b6d0a82973ab03b921

Mauro Castillo Key: 1b6861e202a1e52c6537b73132864511

# MoviePass Api URL

https://developers.themoviedb.org/

# MoviePass Api Commands

//fotos_path
http://image.tmdb.org/t/p/original/{file_path}?api_key={api_key} /* Foto tamaño original*/

http://image.tmdb.org/t/p/w500/{file_path}?api_key={api_key}   /* Foto con width = 500*/

Example of movie:

https://api.themoviedb.org/3/movie/{movie_id}/images?api_key={api_key} 
----------------------------------------------------

MOVIE

 Get

/movie/{movie_id};
/movie/{movie_id}/account_states
/movie/{movie_id}/alternative_titles
/movie/{movie_id}/changes
/movie/{movie_id}/credits
/movie/{movie_id}/external_ids
/movie/{movie_id}/images -->Todas las imagenes para la peli
/movie/{movie_id}/keywords
/movie/{movie_id}/release_dates
/movie/{movie_id}/videos
/movie/{movie_id}/translations
/movie/{movie_id}/recommendations
/movie/{movie_id}/similar
/movie/{movie_id}/reviews
/movie/{movie_id}/lists
/movie/latest
/movie/now_playing
/movie/popular
/movie/top_rated
/movie/upcoming

POST
/movie/{movie_id}/rating

----------------------------------------------------

COLLECTIONS

GET

/collection/{collection_id}
/collection/{collection_id}/images
/collection/{collection_id}/translations


----------------------------------------------------

TRENDINGS

GET

/trending/{media_type}/{time_window}  //Types: Media_Type= all, movie, tv, person | time_window= day, week 	
