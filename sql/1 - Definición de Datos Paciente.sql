DROP SEQUENCE SEC_PACIENTE_OID;
DROP SEQUENCE SEC_USUARIO_OID;

DROP TABLE PACIENTE;
DROP TABLE USUARIO;

CREATE TABLE PACIENTE (
	NOMBRE VARCHAR2(25) NOT NULL,
	APELLIDOS VARCHAR2(75),
    DNI VARCHAR2(10) NOT NULL UNIQUE,
    FECHA_NACIMIENTO DATE NOT NULL,
	CORREO VARCHAR2(75) NOT NULL UNIQUE,
	POBLACION VARCHAR2(75) NOT NULL,
	DIRECCION VARCHAR2(75) NOT NULL,
    FECHAALTA DATE NOT NULL,
	SEGURO VARCHAR2(10) NOT NULL,
	NOMBRE_TUTOR VARCHAR2(75),
	TELEFONO_TUTOR VARCHAR2(75),
	OID_PACIENTE INTEGER NOT NULL,
	PRIMARY KEY (OID_PACIENTE) );
    
CREATE TABLE USUARIO (
	CORREO VARCHAR2(75) NOT NULL UNIQUE,
	PASS VARCHAR2(25) NOT NULL,
	OID_USUARIO INTEGER NOT NULL,
	PRIMARY KEY (OID_USUARIO));
	

CREATE SEQUENCE SEC_PACIENTE_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;


CREATE OR REPLACE TRIGGER INSERTAR_PACIENTE_OID
BEFORE INSERT ON PACIENTE
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_PACIENTE_OID.NEXTVAL INTO :NEW.OID_PACIENTE FROM DUAL;
END;
/

CREATE SEQUENCE SEC_USUARIO_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;


CREATE OR REPLACE TRIGGER INSERTAR_USUARIO_OID
BEFORE INSERT ON USUARIO
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_USUARIO_OID.NEXTVAL INTO :NEW.OID_USUARIO FROM DUAL;
END;
/

CREATE OR REPLACE PROCEDURE INSERTAR_PACIENTE 
  (P_NOM IN PACIENTE.NOMBRE%TYPE,
   P_APE IN PACIENTE.APELLIDOS%TYPE,
   P_DNI IN PACIENTE.DNI%TYPE,
   P_FECHA_NAC IN PACIENTE.FECHA_NACIMIENTO%TYPE,
   P_CORREO IN PACIENTE.CORREO%TYPE,
   P_POBLACION IN PACIENTE.POBLACION%TYPE,
   P_DIRECCION IN PACIENTE.DIRECCION%TYPE,
   P_FECHAALTA IN PACIENTE.FECHAALTA%TYPE,
   P_SEGURO IN PACIENTE.SEGURO%TYPE,
   P_NTUTOR IN PACIENTE.NOMBRE_TUTOR%TYPE,
   P_TTUTOR IN PACIENTE.TELEFONO_TUTOR%TYPE
   ) IS
BEGIN
  INSERT INTO PACIENTE(NOMBRE, APELLIDOS, DNI, FECHA_NACIMIENTO,CORREO,POBLACION,DIRECCION,FECHAALTA,SEGURO,NOMBRE_TUTOR,TELEFONO_TUTOR)
  VALUES (P_NOM ,P_APE,P_DNI,P_FECHA_NAC,P_CORREO,P_POBLACION,P_DIRECCION,P_FECHAALTA,P_SEGURO,P_NTUTOR,P_TTUTOR);
END;
/

CREATE OR REPLACE PROCEDURE INSERTAR_USUARIO 
  (P_CORREO IN USUARIO.CORREO%TYPE,
   P_PASS IN USUARIO.PASS%TYPE
   ) IS
BEGIN
  INSERT INTO USUARIO(CORREO, PASS)
  VALUES (P_CORREO,P_PASS);
END;
/

CREATE OR REPLACE PROCEDURE ACTUALIZAR_PACIENTE(P_NOM IN PACIENTE.NOMBRE%TYPE,
   P_APE IN PACIENTE.APELLIDOS%TYPE,
   P_DNI IN PACIENTE.DNI%TYPE,
   P_FECHA_NAC IN PACIENTE.FECHA_NACIMIENTO%TYPE,
   P_CORREO IN PACIENTE.CORREO%TYPE,
   P_POBLACION IN PACIENTE.POBLACION%TYPE,
   P_DIRECCION IN PACIENTE.DIRECCION%TYPE,
   P_FECHAALTA IN PACIENTE.FECHAALTA%TYPE,
   P_SEGURO IN PACIENTE.SEGURO%TYPE,
   P_NTUTOR IN PACIENTE.NOMBRE_TUTOR%TYPE,
   P_TTUTOR IN PACIENTE.TELEFONO_TUTOR%TYPE
   )IS
BEGIN
    UPDATE Paciente
    SET NOMBRE=P_NOM, APELLIDOS=P_APE, DNI=P_DNI, FECHA_NACIMIENTO=P_FECHA_NAC,CORREO=P_CORREO,POBLACION=P_POBLACION,DIRECCION=P_DIRECCION,FECHAALTA=FECHAALTA,SEGURO=P_SEGURO,NOMBRE_TUTOR=P_NTUTOR,TELEFONO_TUTOR=P_TTUTOR
    WHERE DNI = P_DNI;
END;
/

