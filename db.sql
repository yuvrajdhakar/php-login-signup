CREATE TABLE `users` (
                         `id` bigint NOT NULL,
                         `name` varchar(256) DEFAULT NULL,
                         `email` varchar(256) NOT NULL,
                         `password` varchar(256) NOT NULL,
                         `status` tinyint(1) NOT NULL DEFAULT '0',
                         `reset_token` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT;


CREATE TABLE `pages` (
    `ID` BIGINT NOT NULL AUTO_INCREMENT ,
     `title` TEXT NOT NULL ,
     `content` LONGTEXT NULL ,
     `status` VARCHAR(250) NOT NULL DEFAULT 'draft' ,
      `author` BIGINT NOT NULL ,
      `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      PRIMARY KEY (`ID`)
) ENGINE = InnoDB;


ALTER TABLE `pages` ADD `slug` VARCHAR(256) NOT NULL, ADD UNIQUE `slug` (`slug`);