CREATE TABLE `User` (
  `type` varchar(8) NOT NULL,
  `login` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NULL,
  `phone` varchar(20) NULL,
  `class` varchar(10) NOT NULL,
  `description` varchar(512) NULL,
  `nivbloc` varchar(3) NULL,
  `nivdif` varchar(3) NULL,
  `show` tinyint(1) NOT NULL,
  CONSTRAINT PK_User PRIMARY KEY (login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Bloc` (
  `name` varchar(32) NOT NULL,
  `difficulty` varchar(3) NOT NULL,
  `creator` varchar(32) NOT NULL,
  `date` DATE NOT NULL,
  `types` varchar(256) NOT NULL,
  `zones` varchar(128) NOT NULL,
  `description` varchar(1024),
  `images` varchar(256) NOT NULL,
  CONSTRAINT PK_Bloc PRIMARY KEY (name),
  CONSTRAINT FK_Bloc_User FOREIGN KEY (creator) REFERENCES User(login)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- User: admin, mdp: admin
INSERT INTO User (
  `type`,
  `login`,
  `nickname`,
  `password`,
  `email`,
  `phone`,
  `class`,
  `description`,
  `nivbloc`,
  `nivdif`,
  `show`
)
VALUES(
  "ADMIN",
  "admin",
  "Administrateur",
  "$2y$10$LxqroyFI2y1zgCrATdLZluN2y1oBwCWANeaMTPVY/U7CHM0Dbzvbe",
  "***",
  "***",
  "***",
  "***",
  "***",
  "***",
  0
);
