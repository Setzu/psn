DROP TABLE trophies;

CREATE TABLE IF NOT EXISTS trophies (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_psn INT NOT NULL,
  game VARCHAR(255) NOT NULL,
  bronze INT NOT NULL DEFAULT 0,
  silver INT NOT NULL DEFAULT 0,
  gold INT NOT NULL DEFAULT 0,
  platinum INT NOT NULL DEFAULT 0,
  date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
