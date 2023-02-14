CREATE DATABASE ticketsdb;

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` text NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: abierto; 2:cerrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
