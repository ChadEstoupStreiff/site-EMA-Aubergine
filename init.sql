CREATE TABLE `User` (
  `type` varchar(8) NOT NULL,
  `login` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  CONSTRAINT PK_User PRIMARY KEY (login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Bloc` (
  `name` varchar(32) NOT NULL,
  `dif` varchar(3) NOT NULL,
  `creator` varchar(32) NOT NULL,
  `date` DATE NOT NULL,
  `types` varchar(128) NOT NULL,
  `desc` varchar(256),
  `images` varchar(256) NOT NULL,
  `video` varchar(64),
  CONSTRAINT PK_Bloc PRIMARY KEY (name),
  CONSTRAINT FK_Bloc_User FOREIGN KEY (creator) REFERENCES User(login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- User: admin, mdp: admin
INSERT INTO User (type, login, nickname, password) VALUES ("ADMIN", "admin", "Administrateur", "$2y$10$LxqroyFI2y1zgCrATdLZluN2y1oBwCWANeaMTPVY/U7CHM0Dbzvbe")
