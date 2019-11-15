CREATE TABLE contenido
(
	lid integer NOT NULL,
	articulo_inicio integer NOT NULL, #ANTES ERA articulo
	contenido character(10000) NOT NULL,
	pagina integer NOT NULL,
	#AGREGADO
	articulo_final integer NOT NULL, ##AGREGADO
	contenido_sintilde character(10000) NOT NULL,
	FOREIGN KEY (lid) REFERENCES leyes (lid),
	PRIMARY KEY (lid, articulo)
);

CREATE TABLE leyes
(
	lid integer NOT NULL, ##ponerlo serial por decirlo así
	nombre_original character(100) NOT NULL, #ANTES ERA nombre
	categoria character(20) NOT NULL,
	url character(100) NOT NULL, ##ANTES ERA contenido
	tipo char(1) NOT NULL,
	nombre_sintilde character(100) NOT NULL, ##ANTES ERA clave
	#AGREGADAS
	palabras_clave_original character(3000),
	palabras_clave_sintilde character(3000),
	PRIMARY KEY(lid)
);

CREATE TABLE comentarios
(
	uid integer NOT NULL,
	lid integer NOT NULL,
	comentario character(500),
	#DESDE AQUÍ, AGREGADAS
	cid integer NOT NULL, ##serial
	pagina integer NOT NULL,
	articulo_inicio integer,
	articulo_final integer,
	fecha DATE NOT NULL,
	puntaje integer,
	padre integer,
	posicionXinicio integer,
	posicionYinicio integer,
	posicionXfinal integer,
	posicionYfinal integer,
	FOREIGN KEY (lid) REFERENCES leyes(lid),
	FOREIGN KEY (uid) REFERENCES usuarios(uid),
	FOREIGN KEY (padre) REFERENCES comentarios(cid)
);
