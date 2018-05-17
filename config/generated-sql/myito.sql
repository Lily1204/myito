
BEGIN;

-----------------------------------------------------------------------
-- usuarios
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "usuarios" CASCADE;

CREATE TABLE "usuarios"
(
    "correo" VARCHAR(30) NOT NULL,
    "nombre" VARCHAR(30) NOT NULL,
    "edad" INT2 NOT NULL,
    "sexo" CHAR(15) NOT NULL,
    PRIMARY KEY ("correo")
);

-----------------------------------------------------------------------
-- articulos
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "articulos" CASCADE;

CREATE TABLE "articulos"
(
    "id_articulo" serial NOT NULL,
    "titulo" VARCHAR(50) NOT NULL,
    "descripcion" VARCHAR(150) NOT NULL,
    "links" VARCHAR(70),
    "imagen" VARCHAR(70),
    "calificacion" INT2,
    "correo" VARCHAR(30) NOT NULL,
    "actividad_id" INT2 NOT NULL,
    PRIMARY KEY ("id_articulo")
);

-----------------------------------------------------------------------
-- actividades
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "actividades" CASCADE;

CREATE TABLE "actividades"
(
    "actividad_id" serial NOT NULL,
    "nombre" VARCHAR NOT NULL,
    "categoria_actividad_id" INT2 NOT NULL,
    PRIMARY KEY ("actividad_id"),
    CONSTRAINT "nombre_uni" UNIQUE ("nombre")
);

-----------------------------------------------------------------------
-- categoria_actividad
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "categoria_actividad" CASCADE;

CREATE TABLE "categoria_actividad"
(
    "categoria_actividad_id" serial NOT NULL,
    "nombre_actividad" VARCHAR NOT NULL,
    PRIMARY KEY ("categoria_actividad_id"),
    CONSTRAINT "nombre_actividad_uni" UNIQUE ("nombre_actividad")
);

-----------------------------------------------------------------------
-- usuario_categoria_actividad
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "usuario_categoria_actividad" CASCADE;

CREATE TABLE "usuario_categoria_actividad"
(
    "correo" VARCHAR NOT NULL,
    "categoria_actividad_id" INT2 NOT NULL,
    "estatus" BOOLEAN NOT NULL,
    PRIMARY KEY ("correo","categoria_actividad_id")
);

-----------------------------------------------------------------------
-- preguntas
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "preguntas" CASCADE;

CREATE TABLE "preguntas"
(
    "pregunta_id" serial NOT NULL,
    "pregunta" VARCHAR NOT NULL,
    "categoria_actividad_id" INT2 NOT NULL,
    PRIMARY KEY ("pregunta_id"),
    CONSTRAINT "pregunta_uni" UNIQUE ("pregunta")
);

-----------------------------------------------------------------------
-- respuestas
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "respuestas" CASCADE;

CREATE TABLE "respuestas"
(
    "respuesta_id" serial NOT NULL,
    "respuesta" VARCHAR NOT NULL,
    "pregunta_id" INT2 NOT NULL,
    PRIMARY KEY ("respuesta_id"),
    CONSTRAINT "respuesta_uni" UNIQUE ("respuesta")
);

ALTER TABLE "articulos" ADD CONSTRAINT "articulos_fk_ca1b49"
    FOREIGN KEY ("correo")
    REFERENCES "usuarios" ("correo")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "articulos" ADD CONSTRAINT "articulos_fk_4f2e96"
    FOREIGN KEY ("actividad_id")
    REFERENCES "actividades" ("actividad_id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "actividades" ADD CONSTRAINT "actividades_fk_2f308b"
    FOREIGN KEY ("categoria_actividad_id")
    REFERENCES "categoria_actividad" ("categoria_actividad_id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "usuario_categoria_actividad" ADD CONSTRAINT "usuario_categoria_actividad_fk_ca1b49"
    FOREIGN KEY ("correo")
    REFERENCES "usuarios" ("correo")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "usuario_categoria_actividad" ADD CONSTRAINT "usuario_categoria_actividad_fk_2f308b"
    FOREIGN KEY ("categoria_actividad_id")
    REFERENCES "categoria_actividad" ("categoria_actividad_id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "preguntas" ADD CONSTRAINT "preguntas_fk_2f308b"
    FOREIGN KEY ("categoria_actividad_id")
    REFERENCES "categoria_actividad" ("categoria_actividad_id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

ALTER TABLE "respuestas" ADD CONSTRAINT "respuestas_fk_5fd0f8"
    FOREIGN KEY ("pregunta_id")
    REFERENCES "preguntas" ("pregunta_id")
    ON UPDATE CASCADE
    ON DELETE CASCADE;

COMMIT;
