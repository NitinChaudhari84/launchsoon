CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` CHAR(100) NOT NULL,
  `lastname` CHAR(100) NOT NULL,
  `username` CHAR(100) DEFAULT NULL,
  `email` CHAR(100) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `ipaddress` CHAR(20) NOT NULL,
  `usertype` CHAR(20) NOT NULL,
  `status` CHAR(1) DEFAULT 'Y',
  `datex` DATE NOT NULL,
  `endeffdt` DATE DEFAULT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;