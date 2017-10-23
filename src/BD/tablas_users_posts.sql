CREATE TABLE IF NOT EXISTS users (
  id INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  username VARCHAR(255)  NULL  ,
  date_reg DATE  NULL    ,
PRIMARY KEY(id))
ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS posts (
  id INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  users_id INTEGER UNSIGNED  NOT NULL  ,
  title VARCHAR(255)  NULL  ,
  content VARCHAR(255)  NULL    ,
PRIMARY KEY(id, users_id)  ,
INDEX posts_FKIndex1(users_id),
  FOREIGN KEY(users_id)
    REFERENCES users(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `devs` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `focus` text NOT NULL,
  `hireDate` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


