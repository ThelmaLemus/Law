CREATE DATABASE proyectoleyes;

CREATE TABLE usuarios(
	uid integer NOT NULL DEFAULT nextval('usuarios_uid_seq'::regclass),
    nombre character(20) COLLATE pg_catalog."default" NOT NULL,
    apellido character(20) COLLATE pg_catalog."default" NOT NULL,
    usuario character(30) COLLATE pg_catalog."default" NOT NULL,
    "contraseña" character(25) COLLATE pg_catalog."default" NOT NULL,
    correo character(35) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT usuarios_pkey PRIMARY KEY (uid),
    CONSTRAINT correo UNIQUE (correo),
    CONSTRAINT usuario UNIQUE (usuario)
);


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

CREATE TABLE public.biblioteca
(
    uid integer NOT NULL,
    lid integer NOT NULL,
    CONSTRAINT biblioteca_pkey PRIMARY KEY (uid, lid),
    CONSTRAINT lid FOREIGN KEY (lid)
        REFERENCES public.leyes (lid) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT uid FOREIGN KEY (uid)
        REFERENCES public.usuarios (uid) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);



create index cont on contenido(contenido); /* Crea un índice sobre el campo contenido para agilizar la búsqueda dentro del documento */
create index coment on comentarios(comentario); /* Crea un índice sobre el campo comentario para agilizar la búsqueda en los comentarios*/
create index rname on leyes(nombre_original); /* Crea un índice sobre el campo comentario para agilizar la búsqueda en los nombres de las leyes*/
create index fname on leyes(nombre_sintilde); /* Crea un índice sobre el campo comentario para agilizar la búsqueda en los nombres de las leyes*/



sql = "INSERT INTO Respuesta(comentario_id,nivel,padre) VALUES(SELECT $comentario_id as respuesta_id, C.count(*) + 1, $variable as padre 
															FROM Respuesta AS C 
															WHERE comentario_id=$variableId);"

select lid, count (lid) from biblioteca group by lid;    /* Devuelve cuántas veces se han marcado como favoritos los documentos */  

SELECT Extract(month from fecha_c) as month, count(uid) as users FROM usuarios GROUP BY fecha_c ORDER BY Extract(month from fecha_c)
/* Devuelve cuántos usuarios han sido creados cada mes */

INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user1','user1','u1','u1@u.com','1998','2019-01-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user2','user2','u2','u2@u.com','1998','2019-01-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user3','user3','u3','u3@u.com','1998','2019-01-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user4','user4','u4','u4@u.com','1998','2019-01-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user5','user5','u5','u5@u.com','1998','2019-02-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user6','user6','u6','u6@u.com','1998','2019-02-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user7','user7','u7','u7@u.com','1998','2019-02-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user8','user8','u8','u8@u.com','1998','2019-02-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user9','user9','u9','u9@u.com','1998','2019-03-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user10','user10','u10','u10@u.com','1998','2019-03-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user11','user11','u11','u11@u.com','1998','2019-03-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user12','user12','u12','u12@u.com','1998','2019-04-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user13','user13','u13','u13@u.com','1998','2019-04-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user14','user14','u14','u14@u.com','1998','2019-04-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user15','user15','u15','u15@u.com','1998','2019-04-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user16','user16','u16','u16@u.com','1998','2019-05-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user17','user17','u17','u17@u.com','1998','2019-05-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user18','user18','u18','u18@u.com','1998','2019-05-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user19','user19','u19','u19@u.com','1998','2019-06-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user21','user21','u21','u21@u.com','1998','2019-06-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user22','user22','u22','u22@u.com','1998','2019-06-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user23','user23','u23','u23@u.com','1998','2019-06-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user24','user24','u24','u24@u.com','1998','2019-07-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user25','user25','u25','u25@u.com','1998','2019-07-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user26','user26','u26','u26@u.com','1998','2019-08-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user27','user27','u27','u27@u.com','1998','2019-08-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user28','user28','u28','u28@u.com','1998','2019-08-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user29','user29','u29','u29@u.com','1998','2019-08-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user30','user30','u30','u30@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user31','user31','u31','u31@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user32','user32','u32','u32@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user33','user33','u33','u33@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user34','user34','u34','u34@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user35','user35','u35','u35@u.com','1998','2019-09-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user36','user36','u36','u36@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user37','user37','u37','u37@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user38','user38','u38','u38@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user39','user39','u39','u39@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user40','user40','u40','u40@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user41','user41','u41','u41@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user42','user42','u42','u42@u.com','1998','2019-10-15');
INSERT INTO usuarios(nombre,apellido,usuario,correo,contraseña,fecha_c) VALUES('user43','user43','u43','u43@u.com','1998','2019-10-15');











insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley2', 'Penal', 'Documentos/ley2.pdf', 'L', 'Ley2');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley3', 'Penal', 'Documentos/ley3.pdf', 'L', 'Ley3');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley4', 'Penal', 'Documentos/ley4.pdf', 'L', 'Ley4');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley5', 'Penal', 'Documentos/ley5.pdf', 'L', 'Ley5');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley6', 'Penal', 'Documentos/ley6.pdf', 'L', 'Ley6');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley7', 'Penal', 'Documentos/ley7.pdf', 'L', 'Ley7');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley8', 'Penal', 'Documentos/ley8.pdf', 'L', 'Ley8');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley9', 'Penal', 'Documentos/ley9.pdf', 'L', 'Ley9');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley10', 'Penal', 'Documentos/ley10.pdf', 'A', 'Ley10');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley11', 'Penal', 'Documentos/ley11.pdf', 'A', 'Ley11');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley12', 'Penal', 'Documentos/ley12.pdf', 'A', 'Ley12');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley13', 'Penal', 'Documentos/ley13.pdf', 'A', 'Ley13');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley14', 'Penal', 'Documentos/ley14.pdf', 'A', 'Ley14');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley15', 'Penal', 'Documentos/ley15.pdf', 'A', 'Ley15');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley16', 'Penal', 'Documentos/ley16.pdf', 'A', 'Ley16');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley17', 'Penal', 'Documentos/ley17.pdf', 'C', 'Ley17');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley18', 'Penal', 'Documentos/ley18.pdf', 'C', 'Ley18');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley19', 'Penal', 'Documentos/ley19.pdf', 'C', 'Ley19');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley20', 'Penal', 'Documentos/ley20.pdf', 'C', 'Ley20');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley21', 'Penal', 'Documentos/ley21.pdf', 'C', 'Ley21');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley22', 'Penal', 'Documentos/ley22.pdf', 'C', 'Ley22');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley23', 'Penal', 'Documentos/ley23.pdf', 'C', 'Ley23');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley24', 'Penal', 'Documentos/ley24.pdf', 'L', 'Ley24');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley25', 'Penal', 'Documentos/ley25.pdf', 'L', 'Ley25');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley26', 'Penal', 'Documentos/ley26.pdf', 'L', 'Ley26');
insert into leyes(nombre_original,categoria,url,tipo,nombre_sintilde) values ('Ley27', 'Penal', 'Documentos/ley27.pdf', 'L', 'Ley27');