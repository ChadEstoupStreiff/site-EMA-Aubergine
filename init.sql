CREATE TABLE IF NOT EXISTS `User` (
  `type` varchar(8) NOT NULL,
  `login` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `User`
  ADD PRIMARY KEY (`login`);

