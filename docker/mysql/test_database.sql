CREATE TABLE types (
  id SERIAL NOT NULL AUTO_INCREMENT PRIMARY KEY,
  f_bit BIT,
  f_bit11 BIT(11),
  f_smallint smallint,
  f_smallint10 smallint(10),
  f_mediumint MEDIUMINT,
  f_mediumint10 MEDIUMINT(10),
  f_INT INT,
  f_INT11 INT(11),
  f_integer INTEGER,
  f_integer10 INTEGER(10),
  f_bigint BIGINT,
  f_bigint20 BIGINT(20),
  f_decimal10 DECIMAL(10),
  f_decimal DECIMAL,
  f_dec DEC,
  f_dec10 DEC(10),
  f_dec10_1 DEC(10,1),
  f_decimal10_1 DECIMAL(10,1),
  f_decimal10_11 DECIMAL(10,11),
  f_float10 FLOAT(10),
  f_float FLOAT,
  f_float10_1 FLOAT(10,1),
  f_float10_11 FLOAT(10,11),
  f_double10 DOUBLE(10),
  f_double DOUBLE,
  f_double10_1 DOUBLE(10,1),
  f_double10_11 DOUBLE(10,11),
  f_datetime DATETIME,
  f_datetime6 DATETIME(6),
  f_datetime7 DATETIME(7),
  f_date DATE,
  f_date6 DATE(6),
  f_time TIME,
  f_time6 TIME(6),
  f_timestamp TIMESTAMP,
  f_timestamp6 TIMESTAMP(6),
  f_enum ENUM('a','b','c')
);

CREATE TABLE multi_primary (
  id_one INT PRIMARY KEY ,
  id_two TEXT PRIMARY KEY ,
  data TEXT
);

CREATE TABLE one_to_one1 (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  id_2 INT ,
  data1 TEXT,
  INDEX idx_2 (id_2),
  FOREIGN KEY (id_2)
    REFERENCES one_to_one2(id)
    ON DELETE CASCADE
)ENGINE = InnoDB;

CREATE TABLE one_to_one2 (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  id_1 INT,
  data2 TEXT,
  INDEX idx_1 (id_1),
  FOREIGN KEY (id_1)
  REFERENCES one_to_one1(id)
    ON DELETE CASCADE
)ENGINE = InnoDB;

CREATE TABLE one_to_many_one (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  data1 TEXT
)ENGINE = InnoDB;

CREATE TABLE one_to_many_many (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  id_one INT ,
  data1 TEXT,
  INDEX idx_one (id_one),
  FOREIGN KEY (id_one)
  REFERENCES one_to_many_one(id)
    ON DELETE CASCADE
)ENGINE = InnoDB;


CREATE TABLE many_to_many_one (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  data1 TEXT
)ENGINE = InnoDB;

CREATE TABLE many_to_many_two (
  id SERIAL AUTO_INCREMENT PRIMARY KEY,
  data2 TEXT
)ENGINE = InnoDB;

CREATE TABLE many_to_many_ref (
  id_one int PRIMARY KEY,
  id_two int PRIMARY KEY,
  FOREIGN KEY (id_one)
  REFERENCES many_to_many_one(id)
    ON DELETE CASCADE,
  FOREIGN KEY (id_two)
  REFERENCES many_to_many_two(id)
    ON DELETE CASCADE
)ENGINE = InnoDB;

