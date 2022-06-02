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

ALTER TABLE `pages` ADD `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `pages` ADD `slug` VARCHAR(256) NOT NULL, ADD UNIQUE `slug` (`slug`);

ALTER TABLE `pages` ADD `published_at` TIMESTAMP NULL;

ALTER TABLE `users` ADD `role` VARCHAR(256) NULL AFTER `reset_token`;

-- CREATE TABLE `roles` (
--                          `id` BIGINT NOT NULL AUTO_INCREMENT ,
--                          `name` VARCHAR(256) NOT NULL ,
--                          PRIMARY KEY (`id`)
-- );


ALTER TABLE `pages` ADD `image_path` VARCHAR(256) NULL;



CREATE TABLE `settings` (
                            `id` bigint NOT NULL,
                            `name` varchar(256) NOT NULL,
                            `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--
INSERT INTO `settings` (`id`, `name`, `value`) VALUES
                                                   (1, 'site_logo', 'assets/logos/logo_default.png'),
                                                   (2, 'site_title', 'Sky e-Solutions '),
                                                   (3, 'copywrite_text', NULL);

ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name` (`name`);

ALTER TABLE `settings`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



 
       