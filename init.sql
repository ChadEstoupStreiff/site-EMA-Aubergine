CREATE TABLE `Params` (
  `key_id` varchar(32) NOT NULL,
  `value` varchar(5120) NOT NULL,
  CONSTRAINT PK_Param PRIMARY KEY (key_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `holds` varchar(2048),
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

--Default params
INSERT INTO `Params` (`key_id`, `value`) VALUES
('CAPI1', "Elouan<br/>Lahellec"),
('CAPI2', "Chad<br/>Estoup--Streiff"),
('URL_FACEBOOK', "https://www.facebook.com/groups/1700851880151381"),
('URL_MESSENGER', "https://www.facebook.com/messages/t/2207624789268700"),
('URL_INSTA', "https://www.instagram.com/les_aubergines_escalade/"),
('WELCOME_TEXT', "
Bienvenue sur le site officiel des Aubergines, l'association d'escalade des Mines d'Alès !
Nous sommes une communauté passionnée par l'escalade et nous accueillons chaleureusement les étudiants, le personnel et tous les amoureux de ce sport captivant.
<br/>
<br/>
Que vous soyez débutant ou expérimenté, nous offrons un environnement propice à l'apprentissage, à l'entraînement et à l'épanouissement de chacun.
Notre association organise régulièrement des sorties en falaise, des séances d'entraînement et des compétitions amicales pour vous permettre de pratiquer l'escalade dans des cadres variés.
<br/>
<br/>
L'équipe des Aubergines vous souhaite une expérience d'escalade enrichissante et divertissante.
Nous sommes impatients de vous rencontrer et de partager des moments mémorables sur les parois.
<br/>
<br/>
À bientôt !
<br/>
<br/>
L'équipe des Aubergines.
");