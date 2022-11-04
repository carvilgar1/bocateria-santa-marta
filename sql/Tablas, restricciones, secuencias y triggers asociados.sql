EXECUTE LIMPIADOR;

/*CREACIÓN DE TABLAS */

------------------------------------------
--TABLAS ALERGENOS
------------------------------------------
CREATE TABLE ALERGENOS(
    ID_ALERGENO VARCHAR2(30) NOT NULL,
    GLUTEN    SMALLINT,
    CRUSTACEOS    SMALLINT,
    HUEVO    SMALLINT,
    PESCADO    SMALLINT,
    CACAHUETES    SMALLINT,
    SOJA    SMALLINT,
    LACTEOS    SMALLINT,
    FRUTOS_CASCARA    SMALLINT,
    APIO    SMALLINT,
    MOSTAZA    SMALLINT,
    SESAMO    SMALLINT,
    SULFITOS    SMALLINT,
    ALTRAMUCES    SMALLINT,
    MOLUSCOS    SMALLINT,
    
    PRIMARY KEY (ID_ALERGENO)
);

------------------------------------------
--TABLAS SALSAS
------------------------------------------
CREATE TABLE SALSAS(
    SALSA VARCHAR2(30),
    
    PRIMARY KEY(SALSA)
);

------------------------------------------
--TABLAS BEBIDAS
------------------------------------------
CREATE TABLE BEBIDAS(
    ID_BEBIDA VARCHAR2(30),
    NOMBRE VARCHAR2(30),
    ALCOHOL SMALLINT,
    PRECIO NUMBER (4,2),
    
    PRIMARY KEY (ID_BEBIDA)
);

------------------------------------------
--TABLAS TIPO_PLATO
------------------------------------------
CREATE TABLE TIPO_PLATOS(
--Tipo de plato para elegir Ensaladas, Patatas, Nachos o Pastas
    PLATO VARCHAR2(90),
    
    PRIMARY KEY (PLATO)
    
);

------------------------------------------------------------
--Creación de tabla usuarios
------------------------------------------------------------
CREATE TABLE USUARIOS(
    ID_USUARIO VARCHAR2(20) NOT NULL,
	NICKNAME_USUARIO VARCHAR2(20) NOT NULL,
	CONTRASENYA VARCHAR2(30) NOT NULL,
    DNI VARCHAR2(30) NOT NULL,
	NOMBRE VARCHAR2(50),
	APELLIDOS VARCHAR2(50),
	CORREO_ELECTRONICO VARCHAR2(50),
	TELEFONO VARCHAR2(12),
	WHATSAPP SMALLINT,
	
	CONSTRAINT CK_NUMTLFN CHECK (TELEFONO  > 99999999 AND TELEFONO < 999999999),
    CONSTRAINT CK_WHATSAPP CHECK (WHATSAPP = 0 OR WHATSAPP = 1),

	PRIMARY KEY (ID_USUARIO)
);

------------------------------------------
--TABLAS INGREDIENTES
------------------------------------------
CREATE TABLE INGREDIENTES(
    NOMBRE_INGREDIENTE VARCHAR2(30) NOT NULL,
    
    PRIMARY KEY (NOMBRE_INGREDIENTE)
);

------------------------------------------
--TABLAS PLATO PRINCIPAL
------------------------------------------
CREATE TABLE PLATO_PRINCIPAL(
    ID_PLATO_PRINCIPAL VARCHAR2(20) NOT NULL,
    NOMBRE VARCHAR2(50),
    NOMBRE_INGREDIENTE VARCHAR2(30),
    ID_ALERGENO VARCHAR2(30),
    
    VEGETARIANO SMALLINT,
    VEGANO SMALLINT,
    PRECIO NUMBER(4,2),
    
    CONSTRAINT CK_PREC_PL_P CHECK (PRECIO >= 0),
    
    PRIMARY KEY (ID_PLATO_PRINCIPAL),
    FOREIGN KEY (NOMBRE_INGREDIENTE) REFERENCES INGREDIENTES
    /*,FOREIGN KEY (ID_ALERGENO) REFERENCES ALERGENOS*/
);


------------------------------------------
--TABLAS PLATO SECUNDARIO
------------------------------------------
CREATE TABLE PLATO_SECUNDARIO(
    ID_PLATO_SECUNDARIO VARCHAR2(20) NOT NULL,
    NOMBRE VARCHAR2(100),
    PLATO VARCHAR2(40),
    NOMBRE_INGREDIENTE VARCHAR2(20),
    ID_ALERGENO VARCHAR2(20),
    VEGETARIANO SMALLINT,
    VEGANO SMALLINT,
    TAMANYO VARCHAR2(20)
    --Solo hay tres tamaños: Pequeño, mediano y grande
        CHECK ( TAMANYO IN ('S','M','L')),
    PRECIO NUMBER(4,2),
    
    CONSTRAINT CK_PREC_SC_P CHECK (PRECIO >= 0),
    
    PRIMARY KEY(ID_PLATO_SECUNDARIO),
    FOREIGN KEY (PLATO) REFERENCES TIPO_PLATOS,
    FOREIGN KEY (NOMBRE_INGREDIENTE) REFERENCES INGREDIENTES
    /*,FOREIGN KEY (ID_ALERGENO) REFERENCES ALERGENOS*/
);

------------------------------------------------------------
--Creación de tabla comentarios
------------------------------------------------------------
CREATE TABLE COMENTARIOS(
	ID_COMENTARIO VARCHAR2(30) NOT NULL,
	NICKNAME_USUARIO VARCHAR2(30), 
	PUNTUACION INT DEFAULT 0 NOT NULL,
	COMENTARIO VARCHAR2(250) DEFAULT 'Sin comentarios',

	CONSTRAINT CK_PUNTUACION CHECK (PUNTUACION >= 0 AND PUNTUACION <= 5),

	PRIMARY KEY  (ID_COMENTARIO)
);

------------------------------------------------------------
--Creación de tabla pedidos
------------------------------------------------------------
CREATE TABLE PEDIDOS(
	ID_PEDIDO VARCHAR2(20) NOT NULL,
    ID_USUARIO VARCHAR2(20),
    ID_PLATO_PRINCIPAL VARCHAR2(100),
    SALSA1_PP VARCHAR2(30),
    SALSA2_PP VARCHAR2(30),
    SALSA3_PP VARCHAR2(30),
    ID_PLATO_SECUNDARIO VARCHAR2(100),
    SALSA1_PC VARCHAR2(30),
    SALSA2_PC VARCHAR2(30),
    SALSA3_PC VARCHAR2(30),
    ID_BEBIDA VARCHAR2(100),
	FECHA_RECOGIDA DATE DEFAULT SYSDATE NOT NULL,
	PRECIO NUMBER(4,2),
    
    CONSTRAINT CK_PREC_MEN_POS CHECK (PRECIO >= 0),

	PRIMARY KEY(ID_PEDIDO),
    FOREIGN KEY (ID_USUARIO) REFERENCES USUARIOS,
    FOREIGN KEY (ID_PLATO_PRINCIPAL) REFERENCES PLATO_PRINCIPAL,
    FOREIGN KEY (ID_PLATO_SECUNDARIO) REFERENCES PLATO_SECUNDARIO,
    FOREIGN KEY (ID_BEBIDA) REFERENCES BEBIDAS
    
);


/* CREACIÓN DE SECUENCIAS JUNTO CON LOS TRIGGERS ASOCIADOS A LA GESTIÓN DE SECUENCIAS*/

------------------------------------------------------------
--Creacion de secuencia para generar PK de tabla de COMENTARIO
------------------------------------------------------------

CREATE SEQUENCE SEC_COM MINVALUE -1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH -1 CACHE 20 NOORDER  NOCYCLE
/
-- Creacion de Trigger de secuencias para generar PK de tabla de COMENTARIOS
CREATE OR REPLACE TRIGGER CREA_COMENTARIO
BEFORE INSERT ON COMENTARIOS
FOR EACH ROW
BEGIN
   SELECT SEC_COM.NEXTVAL INTO :NEW.ID_COMENTARIO FROM DUAL;
END;

/

------------------------------------------------------------
-- Creacion de secuencia para generar PK de tabla de PEDIDOS
------------------------------------------------------------

CREATE SEQUENCE SEC_PED
/
-- Creacion de Trigger de secuencias para generar PK de tabla de PEDIDOS
CREATE OR REPLACE TRIGGER CREA_PEDIDO
BEFORE INSERT ON PEDIDOS
FOR EACH ROW
BEGIN
	SELECT SEC_PED.NEXTVAL INTO :NEW.ID_PEDIDO FROM DUAL;
END;

/

------------------------------------------------------------
-- Creacion de secuencia para generar PK de tabla de BEBIDAS
------------------------------------------------------------

CREATE SEQUENCE SEC_BEB
/
-- Creacion de Trigger de secuencias para generar PK de tabla de BEBIDAS
CREATE OR REPLACE TRIGGER CREA_BEBIDA
BEFORE INSERT ON BEBIDAS
FOR EACH ROW
BEGIN
	SELECT SEC_BEB.NEXTVAL INTO :NEW.ID_BEBIDA FROM DUAL;
END;

/
----------------------------------------------------------------------
-- Creacion de secuencia para generar PK de tabla de PLATO_SECUNDARIO
----------------------------------------------------------------------
CREATE SEQUENCE SEC_PLS MINVALUE -1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH -1 CACHE 20 NOORDER  NOCYCLE 
/
-- Creacion de Trigger de secuencias para generar PK de tabla de PLATO_SECUNDARIO
CREATE OR REPLACE TRIGGER CREA_PLATO_SECUNDARIO
BEFORE INSERT ON PLATO_SECUNDARIO
FOR EACH ROW
BEGIN
 SELECT SEC_PLS.NEXTVAL INTO :NEW.ID_PLATO_SECUNDARIO FROM DUAL;
END;
/


------------------------------------------------------------
-- Creacion de secuencia para generar PK de tabla de USUARIOS
------------------------------------------------------------
CREATE SEQUENCE SEC_USER MINVALUE 0 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 0 CACHE 20 NOORDER  NOCYCLE
/
-- Creacion de Trigger de secuencias para generar PK de tabla de MENUS
CREATE OR REPLACE TRIGGER CREA_USUARIO
BEFORE INSERT ON USUARIOS
FOR EACH ROW
BEGIN
	SELECT SEC_USER.NEXTVAL INTO :NEW.ID_USUARIO FROM DUAL;
END;

/
