CREATE TABLE `users`
(
    `id`          bigint       NOT NULL,
    `name`        varchar(256)                                                  DEFAULT NULL,
    `email`       varchar(256) NOT NULL,
    `password`    varchar(256) NOT NULL,
    `status`      tinyint(1) NOT NULL DEFAULT '0',
    `reset_token` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT;


CREATE TABLE `pages`
(
    `ID`         BIGINT       NOT NULL AUTO_INCREMENT,
    `title`      TEXT         NOT NULL,
    `content`    LONGTEXT NULL,
    `status`     VARCHAR(250) NOT NULL DEFAULT 'draft',
    `author`     BIGINT       NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

ALTER TABLE `pages`
    ADD `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `pages`
    ADD `slug` VARCHAR(256) NOT NULL, ADD UNIQUE `slug` (`slug`);

ALTER TABLE `pages`
    ADD `published_at` TIMESTAMP NULL;

ALTER TABLE `users`
    ADD `role` VARCHAR(256) NULL AFTER `reset_token`;

-- CREATE TABLE `roles` (
--                          `id` BIGINT NOT NULL AUTO_INCREMENT ,
--                          `name` VARCHAR(256) NOT NULL ,
--                          PRIMARY KEY (`id`)
-- );


ALTER TABLE `pages`
    ADD `image_path` VARCHAR(256) NULL;



CREATE TABLE `settings`
(
    `id`    bigint       NOT NULL,
    `name`  varchar(256) NOT NULL,
    `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--
INSERT INTO `settings` (`id`, `name`, `value`)
VALUES (1, 'site_logo', 'assets/logos/logo_default.png'),
       (2, 'site_title', 'Sky e-Solutions '),
       (3, 'copywrite_text', NULL);

ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name` (`name`);

ALTER TABLE `settings`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


CREATE TABLE `comments`
(
    `id`        BIGINT       NOT NULL AUTO_INCREMENT,
    `content`   LONGTEXT     NOT NULL,
    `user`      VARCHAR(256) NOT NULL DEFAULT 'Guest',
    `page_id`   BIGINT       NOT NULL,
    `parent_id` BIGINT NULL,
    PRIMARY KEY (`id`)
);


ALTER TABLE `comments`
    ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `comments`
    ADD `likes` BIGINT NULL;


CREATE TABLE `products`
(
    `id`    BIGINT       NOT NULL AUTO_INCREMENT,
    `name`  VARCHAR(256) NOT NULL,
    `price` DOUBLE(10, 2
) NOT NULL,
     `description` LONGTEXT NULL ,
      `slug` VARCHAR(256) NOT NULL ,
      `created_at` TIMESTAMP NOT NULL ,
      `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      `deleted_at` TIMESTAMP NULL ,
      PRIMARY KEY (`id`),
      UNIQUE `product_slug` (`slug`)
      );

ALTER TABLE `products`
    ADD `primary_image` VARCHAR(256) NULL;
ALTER TABLE `products`
    ADD `status` VARCHAR(256) NOT NULL DEFAULT 'draft';


CREATE TABLE `orders`
(
    `id`         BIGINT       NOT NULL AUTO_INCREMENT,
    `product_id` BIGINT       NOT NULL,
    `qty`        INT(11) NOT NULL,
    `user_id`    BIGINT       NOT NULL,
    `status`     VARCHAR(100) NOT NULL DEFAULT 'checkout',
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

ALTER TABLE `orders`
    ADD `session_id` VARCHAR(256) NULL;


CREATE TABLE `plans`
(
    `id`          BIGINT       NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(256) NOT NULL,
    `description` LONGTEXT     NOT NULL,
    `status`      VARCHAR(100) NOT NULL DEFAULT 'draft',
    `price_id`    VARCHAR(256) NOT NULL,
    PRIMARY KEY (`id`)
);

ALTER TABLE `plans`
    ADD `primary_image` VARCHAR(256) NOT NULL AFTER `description`;


CREATE TABLE `plans_orders`
(
    `id`         BIGINT       NOT NULL AUTO_INCREMENT,
    `plan_id`    BIGINT       NOT NULL,
    `qty`        INT          NOT NULL,
    `user_id`    BIGINT       NOT NULL,
    `status`     VARCHAR(256) NOT NULL DEFAULT 'checkout',
    `created_at` TIMESTAMP    NOT NULL,
    PRIMARY KEY (`id`)
);


ALTER TABLE `users` ADD `subscription_id` VARCHAR(100) NULL AFTER `role`;

ALTER TABLE `plans` ADD `role_name` VARCHAR(256) NOT NULL AFTER `price_id`;

ALTER TABLE `plans` ADD UNIQUE(`role_name`);

ALTER TABLE `users` ADD `customer_id` VARCHAR(256) NOT NULL AFTER `subscription_id`;


CREATE TABLE `posts` (
                         `id` bigint NOT NULL,
                         `title` varchar(256) NOT NULL,
                         `userId` bigint NOT NULL,
                         `body` longtext NOT NULL
);

ALTER TABLE `posts`
    ADD UNIQUE KEY `post_id` (`id`);


--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
                          `id` int NOT NULL,
                          `state_id` varchar(100) NOT NULL,
                          `name` varchar(256) NOT NULL
);

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`) VALUES
                                                    (1, '1', 'Udaipur'),
                                                    (2, '1', 'Jaipur'),
                                                    (3, '2', 'South Delhi'),
                                                    (4, '2', 'North Delhi'),
                                                    (5, '2', 'Janakpuri'),
                                                    (6, '2', 'Uttam Nagar'),
                                                    (7, '3', 'South Florida'),
                                                    (8, '3', 'North Florida'),
                                                    (9, '4', 'South Huwai'),
                                                    (10, '4', 'North Huwai');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
                             `id` int UNSIGNED NOT NULL,
                             `country_code` varchar(2) NOT NULL DEFAULT (NULL),
                             `country_name` varchar(100) NOT NULL DEFAULT (NULL)
);

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
                                                                   (1, 'AF', 'Afghanistan'),
                                                                   (2, 'AL', 'Albania'),
                                                                   (3, 'DZ', 'Algeria'),
                                                                   (4, 'DS', 'American Samoa'),
                                                                   (5, 'AD', 'Andorra'),
                                                                   (6, 'AO', 'Angola'),
                                                                   (7, 'AI', 'Anguilla'),
                                                                   (8, 'AQ', 'Antarctica'),
                                                                   (9, 'AG', 'Antigua and Barbuda'),
                                                                   (10, 'AR', 'Argentina'),
                                                                   (11, 'AM', 'Armenia'),
                                                                   (12, 'AW', 'Aruba'),
                                                                   (13, 'AU', 'Australia'),
                                                                   (14, 'AT', 'Austria'),
                                                                   (15, 'AZ', 'Azerbaijan'),
                                                                   (16, 'BS', 'Bahamas'),
                                                                   (17, 'BH', 'Bahrain'),
                                                                   (18, 'BD', 'Bangladesh'),
                                                                   (19, 'BB', 'Barbados'),
                                                                   (20, 'BY', 'Belarus'),
                                                                   (21, 'BE', 'Belgium'),
                                                                   (22, 'BZ', 'Belize'),
                                                                   (23, 'BJ', 'Benin'),
                                                                   (24, 'BM', 'Bermuda'),
                                                                   (25, 'BT', 'Bhutan'),
                                                                   (26, 'BO', 'Bolivia'),
                                                                   (27, 'BA', 'Bosnia and Herzegovina'),
                                                                   (28, 'BW', 'Botswana'),
                                                                   (29, 'BV', 'Bouvet Island'),
                                                                   (30, 'BR', 'Brazil'),
                                                                   (31, 'IO', 'British Indian Ocean Territory'),
                                                                   (32, 'BN', 'Brunei Darussalam'),
                                                                   (33, 'BG', 'Bulgaria'),
                                                                   (34, 'BF', 'Burkina Faso'),
                                                                   (35, 'BI', 'Burundi'),
                                                                   (36, 'KH', 'Cambodia'),
                                                                   (37, 'CM', 'Cameroon'),
                                                                   (38, 'CA', 'Canada'),
                                                                   (39, 'CV', 'Cape Verde'),
                                                                   (40, 'KY', 'Cayman Islands'),
                                                                   (41, 'CF', 'Central African Republic'),
                                                                   (42, 'TD', 'Chad'),
                                                                   (43, 'CL', 'Chile'),
                                                                   (44, 'CN', 'China'),
                                                                   (45, 'CX', 'Christmas Island'),
                                                                   (46, 'CC', 'Cocos (Keeling) Islands'),
                                                                   (47, 'CO', 'Colombia'),
                                                                   (48, 'KM', 'Comoros'),
                                                                   (49, 'CD', 'Democratic Republic of the Congo'),
                                                                   (50, 'CG', 'Republic of the Congo'),
                                                                   (51, 'CK', 'Cook Islands'),
                                                                   (52, 'CR', 'Costa Rica'),
                                                                   (53, 'HR', 'Croatia (Hrvatska)'),
                                                                   (54, 'CU', 'Cuba'),
                                                                   (55, 'CY', 'Cyprus'),
                                                                   (56, 'CZ', 'Czech Republic'),
                                                                   (57, 'DK', 'Denmark'),
                                                                   (58, 'DJ', 'Djibouti'),
                                                                   (59, 'DM', 'Dominica'),
                                                                   (60, 'DO', 'Dominican Republic'),
                                                                   (61, 'TP', 'East Timor'),
                                                                   (62, 'EC', 'Ecuador'),
                                                                   (63, 'EG', 'Egypt'),
                                                                   (64, 'SV', 'El Salvador'),
                                                                   (65, 'GQ', 'Equatorial Guinea'),
                                                                   (66, 'ER', 'Eritrea'),
                                                                   (67, 'EE', 'Estonia'),
                                                                   (68, 'ET', 'Ethiopia'),
                                                                   (69, 'FK', 'Falkland Islands (Malvinas)'),
                                                                   (70, 'FO', 'Faroe Islands'),
                                                                   (71, 'FJ', 'Fiji'),
                                                                   (72, 'FI', 'Finland'),
                                                                   (73, 'FR', 'France'),
                                                                   (74, 'FX', 'France, Metropolitan'),
                                                                   (75, 'GF', 'French Guiana'),
                                                                   (76, 'PF', 'French Polynesia'),
                                                                   (77, 'TF', 'French Southern Territories'),
                                                                   (78, 'GA', 'Gabon'),
                                                                   (79, 'GM', 'Gambia'),
                                                                   (80, 'GE', 'Georgia'),
                                                                   (81, 'DE', 'Germany'),
                                                                   (82, 'GH', 'Ghana'),
                                                                   (83, 'GI', 'Gibraltar'),
                                                                   (84, 'GK', 'Guernsey'),
                                                                   (85, 'GR', 'Greece'),
                                                                   (86, 'GL', 'Greenland'),
                                                                   (87, 'GD', 'Grenada'),
                                                                   (88, 'GP', 'Guadeloupe'),
                                                                   (89, 'GU', 'Guam'),
                                                                   (90, 'GT', 'Guatemala'),
                                                                   (91, 'GN', 'Guinea'),
                                                                   (92, 'GW', 'Guinea-Bissau'),
                                                                   (93, 'GY', 'Guyana'),
                                                                   (94, 'HT', 'Haiti'),
                                                                   (95, 'HM', 'Heard and Mc Donald Islands'),
                                                                   (96, 'HN', 'Honduras'),
                                                                   (97, 'HK', 'Hong Kong'),
                                                                   (98, 'HU', 'Hungary'),
                                                                   (99, 'IS', 'Iceland'),
                                                                   (100, 'IN', 'India'),
                                                                   (101, 'IM', 'Isle of Man'),
                                                                   (102, 'ID', 'Indonesia'),
                                                                   (103, 'IR', 'Iran (Islamic Republic of)'),
                                                                   (104, 'IQ', 'Iraq'),
                                                                   (105, 'IE', 'Ireland'),
                                                                   (106, 'IL', 'Israel'),
                                                                   (107, 'IT', 'Italy'),
                                                                   (108, 'CI', 'Ivory Coast'),
                                                                   (109, 'JE', 'Jersey'),
                                                                   (110, 'JM', 'Jamaica'),
                                                                   (111, 'JP', 'Japan'),
                                                                   (112, 'JO', 'Jordan'),
                                                                   (113, 'KZ', 'Kazakhstan'),
                                                                   (114, 'KE', 'Kenya'),
                                                                   (115, 'KI', 'Kiribati'),
                                                                   (116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
                                                                   (122, 'LV', 'Latvia'),
                                                                   (123, 'LB', 'Lebanon'),
                                                                   (124, 'LS', 'Lesotho'),
                                                                   (125, 'LR', 'Liberia'),
                                                                   (126, 'LY', 'Libyan Arab Jamahiriya'),
                                                                   (127, 'LI', 'Liechtenstein'),
                                                                   (128, 'LT', 'Lithuania'),
                                                                   (129, 'LU', 'Luxembourg'),
                                                                   (130, 'MO', 'Macau'),
                                                                   (131, 'MK', 'North Macedonia'),
                                                                   (132, 'MG', 'Madagascar'),
                                                                   (133, 'MW', 'Malawi'),
                                                                   (134, 'MY', 'Malaysia'),
                                                                   (135, 'MV', 'Maldives'),
                                                                   (136, 'ML', 'Mali'),
                                                                   (137, 'MT', 'Malta'),
                                                                   (138, 'MH', 'Marshall Islands'),
                                                                   (139, 'MQ', 'Martinique'),
                                                                   (140, 'MR', 'Mauritania'),
                                                                   (141, 'MU', 'Mauritius'),
                                                                   (142, 'TY', 'Mayotte'),
                                                                   (143, 'MX', 'Mexico'),
                                                                   (144, 'FM', 'Micronesia, Federated States of'),
                                                                   (145, 'MD', 'Moldova, Republic of'),
                                                                   (146, 'MC', 'Monaco'),
                                                                   (147, 'MN', 'Mongolia'),
                                                                   (148, 'ME', 'Montenegro'),
                                                                   (149, 'MS', 'Montserrat'),
                                                                   (150, 'MA', 'Morocco'),
                                                                   (151, 'MZ', 'Mozambique'),
                                                                   (152, 'MM', 'Myanmar'),
                                                                   (153, 'NA', 'Namibia'),
                                                                   (154, 'NR', 'Nauru'),
                                                                   (155, 'NP', 'Nepal'),
                                                                   (156, 'NL', 'Netherlands'),
                                                                   (157, 'AN', 'Netherlands Antilles'),
                                                                   (158, 'NC', 'New Caledonia'),
                                                                   (159, 'NZ', 'New Zealand'),
                                                                   (160, 'NI', 'Nicaragua'),
                                                                   (161, 'NE', 'Niger'),
                                                                   (162, 'NG', 'Nigeria'),
                                                                   (163, 'NU', 'Niue'),
                                                                   (164, 'NF', 'Norfolk Island'),
                                                                   (165, 'MP', 'Northern Mariana Islands'),
                                                                   (166, 'NO', 'Norway'),
                                                                   (167, 'OM', 'Oman'),
                                                                   (168, 'PK', 'Pakistan'),
                                                                   (169, 'PW', 'Palau'),
                                                                   (170, 'PS', 'Palestine'),
                                                                   (171, 'PA', 'Panama'),
                                                                   (172, 'PG', 'Papua New Guinea'),
                                                                   (173, 'PY', 'Paraguay'),
                                                                   (174, 'PE', 'Peru'),
                                                                   (175, 'PH', 'Philippines'),
                                                                   (176, 'PN', 'Pitcairn'),
                                                                   (177, 'PL', 'Poland'),
                                                                   (178, 'PT', 'Portugal'),
                                                                   (179, 'PR', 'Puerto Rico'),
                                                                   (180, 'QA', 'Qatar'),
                                                                   (181, 'RE', 'Reunion'),
                                                                   (182, 'RO', 'Romania'),
                                                                   (183, 'RU', 'Russian Federation'),
                                                                   (184, 'RW', 'Rwanda'),
                                                                   (185, 'KN', 'Saint Kitts and Nevis'),
                                                                   (186, 'LC', 'Saint Lucia'),
                                                                   (187, 'VC', 'Saint Vincent and the Grenadines'),
                                                                   (188, 'WS', 'Samoa'),
                                                                   (189, 'SM', 'San Marino'),
                                                                   (190, 'ST', 'Sao Tome and Principe'),
                                                                   (191, 'SA', 'Saudi Arabia'),
                                                                   (192, 'SN', 'Senegal'),
                                                                   (193, 'RS', 'Serbia'),
                                                                   (194, 'SC', 'Seychelles'),
                                                                   (195, 'SL', 'Sierra Leone'),
                                                                   (196, 'SG', 'Singapore'),
                                                                   (197, 'SK', 'Slovakia'),
                                                                   (198, 'SI', 'Slovenia'),
                                                                   (199, 'SB', 'Solomon Islands'),
                                                                   (200, 'SO', 'Somalia'),
                                                                   (201, 'ZA', 'South Africa'),
                                                                   (202, 'GS', 'South Georgia South Sandwich Islands'),
                                                                   (203, 'SS', 'South Sudan'),
                                                                   (204, 'ES', 'Spain'),
                                                                   (205, 'LK', 'Sri Lanka'),
                                                                   (206, 'SH', 'St. Helena'),
                                                                   (207, 'PM', 'St. Pierre and Miquelon'),
                                                                   (208, 'SD', 'Sudan'),
                                                                   (209, 'SR', 'Suriname'),
                                                                   (210, 'SJ', 'Svalbard and Jan Mayen Islands'),
                                                                   (211, 'SZ', 'Eswatini'),
                                                                   (212, 'SE', 'Sweden'),
                                                                   (213, 'CH', 'Switzerland'),
                                                                   (214, 'SY', 'Syrian Arab Republic'),
                                                                   (215, 'TW', 'Taiwan'),
                                                                   (216, 'TJ', 'Tajikistan'),
                                                                   (217, 'TZ', 'Tanzania, United Republic of'),
                                                                   (218, 'TH', 'Thailand'),
                                                                   (219, 'TG', 'Togo'),
                                                                   (220, 'TK', 'Tokelau'),
                                                                   (221, 'TO', 'Tonga'),
                                                                   (222, 'TT', 'Trinidad and Tobago'),
                                                                   (223, 'TN', 'Tunisia'),
                                                                   (224, 'TR', 'Turkey'),
                                                                   (225, 'TM', 'Turkmenistan'),
                                                                   (226, 'TC', 'Turks and Caicos Islands'),
                                                                   (227, 'TV', 'Tuvalu'),
                                                                   (228, 'UG', 'Uganda'),
                                                                   (229, 'UA', 'Ukraine'),
                                                                   (230, 'AE', 'United Arab Emirates'),
                                                                   (231, 'GB', 'United Kingdom'),
                                                                   (232, 'US', 'United States'),
                                                                   (233, 'UM', 'United States minor outlying islands'),
                                                                   (234, 'UY', 'Uruguay'),
                                                                   (235, 'UZ', 'Uzbekistan'),
                                                                   (236, 'VU', 'Vanuatu'),
                                                                   (237, 'VA', 'Vatican City State'),
                                                                   (238, 'VE', 'Venezuela'),
                                                                   (239, 'VN', 'Vietnam'),
                                                                   (240, 'VG', 'Virgin Islands (British)'),
                                                                   (241, 'VI', 'Virgin Islands (U.S.)'),
                                                                   (242, 'WF', 'Wallis and Futuna Islands'),
                                                                   (243, 'EH', 'Western Sahara'),
                                                                   (244, 'YE', 'Yemen'),
                                                                   (245, 'ZM', 'Zambia'),
                                                                   (246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
                          `id` int NOT NULL,
                          `country_code` varchar(10) NOT NULL,
                          `name` varchar(256) NOT NULL
);

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_code`, `name`) VALUES
                                                        (1, 'IN', 'Rajasthan'),
                                                        (2, 'IN', 'Delhi'),
                                                        (3, 'US', 'Florida'),
                                                        (4, 'US', 'Hawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
    ADD PRIMARY KEY (`id`),
  ADD KEY `cc` (`country_code`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;