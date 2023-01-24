CREATE TABLE IF NOT EXISTS `User` (
  `type` varchar(8) NOT NULL,
  `login` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `User`
  ADD PRIMARY KEY (`login`);

-- User: admin, mdp: admin
INSERT INTO User (type, login, nickname, password) VALUES ("ADMIN", "admin", "Admin", "$2y$10$LxqroyFI2y1zgCrATdLZluN2y1oBwCWANeaMTPVY/U7CHM0Dbzvbe")
