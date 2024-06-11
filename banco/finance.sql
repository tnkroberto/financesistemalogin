CREATE DATABASE IF NOT EXISTS `finance` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `finance`;

CREATE TABLE `usuario` (
  `user_cod` int(5) NOT NULL AUTO_INCREMENT,
  `user_nome` varchar(255) NOT NULL UNIQUE,
  `user_email` varchar(255) NOT NULL UNIQUE,
  `user_senha` varchar(255) NOT NULL,
  PRIMARY KEY (`user_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE historico (
  hist_cod int(5) NOT NULL AUTO_INCREMENT,
  user_nome varchar(255) NOT NULL,
  hist_nome varchar(255) NOT NULL,
  hist_valor float NOT NULL,
  hist_data date NOT NULL,
  tipo_compra INT NOT NULL,
  PRIMARY KEY (hist_cod),
  FOREIGN KEY (user_nome) REFERENCES usuario(user_nome) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `salario` (
  `sal_cod` int(5) NOT NULL AUTO_INCREMENT,
  `user_nome` varchar(255) NOT NULL,
  `sal_valor` float NOT NULL,
  PRIMARY KEY (`sal_cod`),
  FOREIGN KEY (`user_nome`) REFERENCES `usuario`(`user_nome`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;