CREATE TABLE extravio_patente
(
	nombre_documento character(50),
	fecha_emision character(60),
	notario_name character(60),
	direccion character(80),
	affected_name character(60),
	affected_dpi character(15),
	nombre_entidad character(60),
	fecha_emision_actanotarial character(60),
	nombre_notario_actanotarial character(60),
	empresa_afectada character(60),
	usuario integer,
	pid serial
);

CREATE TABLE acta_de_declaracion
(
	fecha character(60),
	nombre_notario character(50),
	direccion character(50),
	ombre_solicitante character(50),
	dpi_solicitante character(15),
	institucion character(50),
	solicitud character(500),
	usuario integer,
	nombre_plantilla character(50),
	pid serial
);

CREATE TABLE autenticacion_de_firma
(
	fecha character(10),
	nombre_notario character(50),
	nombre_solicitante character(50),
	dpi character(15),
	uid integer,
	pid serial,
	nombre_archivo character(50)
);

CREATE TABLE carta_de_poder
(
	fecha_emision character(60),
	nombre_otorgante character(50),
	nombre_apoderado character(50),
	responsabilidades character(500),
	dpi_otorgante character(15),
	dpi_apoderado character(15),
	dpi_testigo1 character(15),
	dpi_testigo2 character(15),
	fecha_caducidad character(60),
	uid integer,
	pid serial
);

CREATE TABLE comentarios_documentos
(
	tipo integer,
	pid integer,
	comentario character(500)
);

CREATE TABLE public.vistas
(
    lid integer,
    uid integer,
    views integer,
    name character(100) COLLATE pg_catalog."default",
    CONSTRAINT "Vistas_uid_fkey" FOREIGN KEY (uid)
        REFERENCES public.usuarios (uid) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT lid FOREIGN KEY (lid)
        REFERENCES public.leyes (lid) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

CREATE TABLE nombramiento
(
	nombre_entidad character(60),
	fecha_emision character(60),
	nombre_notario character(60),
	direccion character(60),
	nombre_solicitante character(60),
	dpi_solicitante character(15),
	numero_escritura character(60),
	notario_escritura character(60),
	fecha_autorizacion character(60),
	actividades character(500),
	numero_acta character(60),
	fecha_acta character(60),
	plazo_enaños character(30),
	usuario integer,
	nombre_archivo character(30),
	pid serial
)