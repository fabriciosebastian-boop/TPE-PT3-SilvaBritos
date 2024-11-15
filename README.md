Descripcion del proyecto :

Este proyecto tiene como objetivo crear una API de los jugadores de las grandes ligas, siguiendo con la idea de la segunda entrega.
La API proporciona acceso a los jugadores, donde podemos obtener cualquiera de ellos, con una opcion de filtro (nacionalidad) y 2 maneras de ordenar los mismos (ASC o DESC).

Integrantes :
|Fabricio Britos
|Kevin Silva

API
(Nuestras solicitudes y respuestas son en formato JSON)

NUESTRA RUTA COMIENZA: http://localhost/Web2-tpe.p3/api/...

En nuestro caso los endpoints que utilizamos son los siguientes:

GET '/jugadores' (Nos devuelve todos los jugadores)

{"nombre" : "Jack Grealish",
"posicion" : "MCI" ,
"pie_habil" : "Diestro" ,
"nacionalidad" : "Inglaterra" ,
"id_equipo" : 3}

DESCRIPCION DE LOS QUERY PARAMS :

|:ID| Recibe un entero, para utilizarlo en las busquedas dentro de la DB.
|:sort_filter| Es el valor que sera el que define por que dato se va a filtrar.. en mi caso espera un `nacionalidad`.
|:sort_mode| Es quien define de que manera se van a ordenar los productos, espra un `ASC` o  `DESC`.

---------------------------------------------

-GET `/jugadores/:ID` : Devuelve el producto con el ':ID'. GET -> (localhost/Web2-tpe.p3/api/jugadores/1)
-PUT `/jugadores/:ID' : Obtiene los datos del body, y cambia los del jugador con el ':ID' proporcionado. PUT -> (localhost/Web2-tpe.p3/api/jugadores/1). + DATOS DEL BODY EN FORMATO JSON.
-POST `/jugadores` : Agrega un jugador proporcionado por el body a la tabla jugadores. POST -> (localhost/Web2-tpe.p3/api/jugadores) + DATOS DEL BODY EN FORMATO JSON.
-GET `jugadores/:sort_filter/:sort_mode`: Obtiene, ordena, y devuelve los jugadores, segun los parametros obtenidos; GET -> (localhost/Web2-tpe.p3/api/jugadores/nacionalidad/ASC);


