CREATE DATABASE IF NOT EXISTS madhav;

USE madhav;

DROP TABLE IF EXISTS cities;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` varchar(100) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO cities VALUES("1","1","Udaipur");
INSERT INTO cities VALUES("2","1","Jaipur");
INSERT INTO cities VALUES("3","2","South Delhi");
INSERT INTO cities VALUES("4","2","North Delhi");
INSERT INTO cities VALUES("5","2","Janakpuri");
INSERT INTO cities VALUES("6","2","Uttam Nagar");
INSERT INTO cities VALUES("7","3","South Florida");
INSERT INTO cities VALUES("8","3","North Florida");
INSERT INTO cities VALUES("9","4","South Huwai");
INSERT INTO cities VALUES("10","4","North Huwai");



DROP TABLE IF EXISTS comments;

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `user` varchar(256) NOT NULL DEFAULT 'Guest',
  `page_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` bigint(20) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO comments VALUES("1","huuaduiuahhasui","7","34","0","2022-06-04 09:29:57","0");
INSERT INTO comments VALUES("2","hjhiuhuiuduauisuiuiuiysuiauydosdssssassuas
odsadouaoia
udado\\","7","34","0","2022-06-04 09:29:57","0");
INSERT INTO comments VALUES("3","hjhiuhuiuduauisuiuiuiysuiauydosdssssassuas
odsadouaoia
udado\\","7","34","0","2022-06-04 09:29:57","0");
INSERT INTO comments VALUES("4","hjshjsjhjsh","7","34","0","2022-06-04 09:29:57","0");
INSERT INTO comments VALUES("5","ghh

","7","34","0","2022-06-04 09:29:57","0");
INSERT INTO comments VALUES("6","ghh

","7","34","0","2022-06-04 09:34:48","2");
INSERT INTO comments VALUES("7","tyuio","7","34","0","2022-06-04 09:35:33","6");
INSERT INTO comments VALUES("8","ghh

","7","34","0","2022-06-04 09:36:02","0");
INSERT INTO comments VALUES("9","hiiii
","7","38","0","2022-06-07 10:32:51","6");
INSERT INTO comments VALUES("10","strdtfyguhj","7","37","0","2022-06-10 15:43:31","3");
INSERT INTO comments VALUES("11","dfsfdsdfsdf","7","37","10","2022-06-10 15:43:45","2");
INSERT INTO comments VALUES("12","qeery","7","54","0","2022-06-17 16:21:38","0");



DROP TABLE IF EXISTS countries;

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cc` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4;

INSERT INTO countries VALUES("1","AF","Afghanistan");
INSERT INTO countries VALUES("2","AL","Albania");
INSERT INTO countries VALUES("3","DZ","Algeria");
INSERT INTO countries VALUES("4","DS","American Samoa");
INSERT INTO countries VALUES("5","AD","Andorra");
INSERT INTO countries VALUES("6","AO","Angola");
INSERT INTO countries VALUES("7","AI","Anguilla");
INSERT INTO countries VALUES("8","AQ","Antarctica");
INSERT INTO countries VALUES("9","AG","Antigua and Barbuda");
INSERT INTO countries VALUES("10","AR","Argentina");
INSERT INTO countries VALUES("11","AM","Armenia");
INSERT INTO countries VALUES("12","AW","Aruba");
INSERT INTO countries VALUES("13","AU","Australia");
INSERT INTO countries VALUES("14","AT","Austria");
INSERT INTO countries VALUES("15","AZ","Azerbaijan");
INSERT INTO countries VALUES("16","BS","Bahamas");
INSERT INTO countries VALUES("17","BH","Bahrain");
INSERT INTO countries VALUES("18","BD","Bangladesh");
INSERT INTO countries VALUES("19","BB","Barbados");
INSERT INTO countries VALUES("20","BY","Belarus");
INSERT INTO countries VALUES("21","BE","Belgium");
INSERT INTO countries VALUES("22","BZ","Belize");
INSERT INTO countries VALUES("23","BJ","Benin");
INSERT INTO countries VALUES("24","BM","Bermuda");
INSERT INTO countries VALUES("25","BT","Bhutan");
INSERT INTO countries VALUES("26","BO","Bolivia");
INSERT INTO countries VALUES("27","BA","Bosnia and Herzegovina");
INSERT INTO countries VALUES("28","BW","Botswana");
INSERT INTO countries VALUES("29","BV","Bouvet Island");
INSERT INTO countries VALUES("30","BR","Brazil");
INSERT INTO countries VALUES("31","IO","British Indian Ocean Territory");
INSERT INTO countries VALUES("32","BN","Brunei Darussalam");
INSERT INTO countries VALUES("33","BG","Bulgaria");
INSERT INTO countries VALUES("34","BF","Burkina Faso");
INSERT INTO countries VALUES("35","BI","Burundi");
INSERT INTO countries VALUES("36","KH","Cambodia");
INSERT INTO countries VALUES("37","CM","Cameroon");
INSERT INTO countries VALUES("38","CA","Canada");
INSERT INTO countries VALUES("39","CV","Cape Verde");
INSERT INTO countries VALUES("40","KY","Cayman Islands");
INSERT INTO countries VALUES("41","CF","Central African Republic");
INSERT INTO countries VALUES("42","TD","Chad");
INSERT INTO countries VALUES("43","CL","Chile");
INSERT INTO countries VALUES("44","CN","China");
INSERT INTO countries VALUES("45","CX","Christmas Island");
INSERT INTO countries VALUES("46","CC","Cocos (Keeling) Islands");
INSERT INTO countries VALUES("47","CO","Colombia");
INSERT INTO countries VALUES("48","KM","Comoros");
INSERT INTO countries VALUES("49","CD","Democratic Republic of the Congo");
INSERT INTO countries VALUES("50","CG","Republic of the Congo");
INSERT INTO countries VALUES("51","CK","Cook Islands");
INSERT INTO countries VALUES("52","CR","Costa Rica");
INSERT INTO countries VALUES("53","HR","Croatia (Hrvatska)");
INSERT INTO countries VALUES("54","CU","Cuba");
INSERT INTO countries VALUES("55","CY","Cyprus");
INSERT INTO countries VALUES("56","CZ","Czech Republic");
INSERT INTO countries VALUES("57","DK","Denmark");
INSERT INTO countries VALUES("58","DJ","Djibouti");
INSERT INTO countries VALUES("59","DM","Dominica");
INSERT INTO countries VALUES("60","DO","Dominican Republic");
INSERT INTO countries VALUES("61","TP","East Timor");
INSERT INTO countries VALUES("62","EC","Ecuador");
INSERT INTO countries VALUES("63","EG","Egypt");
INSERT INTO countries VALUES("64","SV","El Salvador");
INSERT INTO countries VALUES("65","GQ","Equatorial Guinea");
INSERT INTO countries VALUES("66","ER","Eritrea");
INSERT INTO countries VALUES("67","EE","Estonia");
INSERT INTO countries VALUES("68","ET","Ethiopia");
INSERT INTO countries VALUES("69","FK","Falkland Islands (Malvinas)");
INSERT INTO countries VALUES("70","FO","Faroe Islands");
INSERT INTO countries VALUES("71","FJ","Fiji");
INSERT INTO countries VALUES("72","FI","Finland");
INSERT INTO countries VALUES("73","FR","France");
INSERT INTO countries VALUES("74","FX","France, Metropolitan");
INSERT INTO countries VALUES("75","GF","French Guiana");
INSERT INTO countries VALUES("76","PF","French Polynesia");
INSERT INTO countries VALUES("77","TF","French Southern Territories");
INSERT INTO countries VALUES("78","GA","Gabon");
INSERT INTO countries VALUES("79","GM","Gambia");
INSERT INTO countries VALUES("80","GE","Georgia");
INSERT INTO countries VALUES("81","DE","Germany");
INSERT INTO countries VALUES("82","GH","Ghana");
INSERT INTO countries VALUES("83","GI","Gibraltar");
INSERT INTO countries VALUES("84","GK","Guernsey");
INSERT INTO countries VALUES("85","GR","Greece");
INSERT INTO countries VALUES("86","GL","Greenland");
INSERT INTO countries VALUES("87","GD","Grenada");
INSERT INTO countries VALUES("88","GP","Guadeloupe");
INSERT INTO countries VALUES("89","GU","Guam");
INSERT INTO countries VALUES("90","GT","Guatemala");
INSERT INTO countries VALUES("91","GN","Guinea");
INSERT INTO countries VALUES("92","GW","Guinea-Bissau");
INSERT INTO countries VALUES("93","GY","Guyana");
INSERT INTO countries VALUES("94","HT","Haiti");
INSERT INTO countries VALUES("95","HM","Heard and Mc Donald Islands");
INSERT INTO countries VALUES("96","HN","Honduras");
INSERT INTO countries VALUES("97","HK","Hong Kong");
INSERT INTO countries VALUES("98","HU","Hungary");
INSERT INTO countries VALUES("99","IS","Iceland");
INSERT INTO countries VALUES("100","IN","India");
INSERT INTO countries VALUES("101","IM","Isle of Man");
INSERT INTO countries VALUES("102","ID","Indonesia");
INSERT INTO countries VALUES("103","IR","Iran (Islamic Republic of)");
INSERT INTO countries VALUES("104","IQ","Iraq");
INSERT INTO countries VALUES("105","IE","Ireland");
INSERT INTO countries VALUES("106","IL","Israel");
INSERT INTO countries VALUES("107","IT","Italy");
INSERT INTO countries VALUES("108","CI","Ivory Coast");
INSERT INTO countries VALUES("109","JE","Jersey");
INSERT INTO countries VALUES("110","JM","Jamaica");
INSERT INTO countries VALUES("111","JP","Japan");
INSERT INTO countries VALUES("112","JO","Jordan");
INSERT INTO countries VALUES("113","KZ","Kazakhstan");
INSERT INTO countries VALUES("114","KE","Kenya");
INSERT INTO countries VALUES("115","KI","Kiribati");
INSERT INTO countries VALUES("116","KP","Korea, Democratic People\'s Republic of");
INSERT INTO countries VALUES("117","KR","Korea, Republic of");
INSERT INTO countries VALUES("118","XK","Kosovo");
INSERT INTO countries VALUES("119","KW","Kuwait");
INSERT INTO countries VALUES("120","KG","Kyrgyzstan");
INSERT INTO countries VALUES("121","LA","Lao People\'s Democratic Republic");
INSERT INTO countries VALUES("122","LV","Latvia");
INSERT INTO countries VALUES("123","LB","Lebanon");
INSERT INTO countries VALUES("124","LS","Lesotho");
INSERT INTO countries VALUES("125","LR","Liberia");
INSERT INTO countries VALUES("126","LY","Libyan Arab Jamahiriya");
INSERT INTO countries VALUES("127","LI","Liechtenstein");
INSERT INTO countries VALUES("128","LT","Lithuania");
INSERT INTO countries VALUES("129","LU","Luxembourg");
INSERT INTO countries VALUES("130","MO","Macau");
INSERT INTO countries VALUES("131","MK","North Macedonia");
INSERT INTO countries VALUES("132","MG","Madagascar");
INSERT INTO countries VALUES("133","MW","Malawi");
INSERT INTO countries VALUES("134","MY","Malaysia");
INSERT INTO countries VALUES("135","MV","Maldives");
INSERT INTO countries VALUES("136","ML","Mali");
INSERT INTO countries VALUES("137","MT","Malta");
INSERT INTO countries VALUES("138","MH","Marshall Islands");
INSERT INTO countries VALUES("139","MQ","Martinique");
INSERT INTO countries VALUES("140","MR","Mauritania");
INSERT INTO countries VALUES("141","MU","Mauritius");
INSERT INTO countries VALUES("142","TY","Mayotte");
INSERT INTO countries VALUES("143","MX","Mexico");
INSERT INTO countries VALUES("144","FM","Micronesia, Federated States of");
INSERT INTO countries VALUES("145","MD","Moldova, Republic of");
INSERT INTO countries VALUES("146","MC","Monaco");
INSERT INTO countries VALUES("147","MN","Mongolia");
INSERT INTO countries VALUES("148","ME","Montenegro");
INSERT INTO countries VALUES("149","MS","Montserrat");
INSERT INTO countries VALUES("150","MA","Morocco");
INSERT INTO countries VALUES("151","MZ","Mozambique");
INSERT INTO countries VALUES("152","MM","Myanmar");
INSERT INTO countries VALUES("153","NA","Namibia");
INSERT INTO countries VALUES("154","NR","Nauru");
INSERT INTO countries VALUES("155","NP","Nepal");
INSERT INTO countries VALUES("156","NL","Netherlands");
INSERT INTO countries VALUES("157","AN","Netherlands Antilles");
INSERT INTO countries VALUES("158","NC","New Caledonia");
INSERT INTO countries VALUES("159","NZ","New Zealand");
INSERT INTO countries VALUES("160","NI","Nicaragua");
INSERT INTO countries VALUES("161","NE","Niger");
INSERT INTO countries VALUES("162","NG","Nigeria");
INSERT INTO countries VALUES("163","NU","Niue");
INSERT INTO countries VALUES("164","NF","Norfolk Island");
INSERT INTO countries VALUES("165","MP","Northern Mariana Islands");
INSERT INTO countries VALUES("166","NO","Norway");
INSERT INTO countries VALUES("167","OM","Oman");
INSERT INTO countries VALUES("168","PK","Pakistan");
INSERT INTO countries VALUES("169","PW","Palau");
INSERT INTO countries VALUES("170","PS","Palestine");
INSERT INTO countries VALUES("171","PA","Panama");
INSERT INTO countries VALUES("172","PG","Papua New Guinea");
INSERT INTO countries VALUES("173","PY","Paraguay");
INSERT INTO countries VALUES("174","PE","Peru");
INSERT INTO countries VALUES("175","PH","Philippines");
INSERT INTO countries VALUES("176","PN","Pitcairn");
INSERT INTO countries VALUES("177","PL","Poland");
INSERT INTO countries VALUES("178","PT","Portugal");
INSERT INTO countries VALUES("179","PR","Puerto Rico");
INSERT INTO countries VALUES("180","QA","Qatar");
INSERT INTO countries VALUES("181","RE","Reunion");
INSERT INTO countries VALUES("182","RO","Romania");
INSERT INTO countries VALUES("183","RU","Russian Federation");
INSERT INTO countries VALUES("184","RW","Rwanda");
INSERT INTO countries VALUES("185","KN","Saint Kitts and Nevis");
INSERT INTO countries VALUES("186","LC","Saint Lucia");
INSERT INTO countries VALUES("187","VC","Saint Vincent and the Grenadines");
INSERT INTO countries VALUES("188","WS","Samoa");
INSERT INTO countries VALUES("189","SM","San Marino");
INSERT INTO countries VALUES("190","ST","Sao Tome and Principe");
INSERT INTO countries VALUES("191","SA","Saudi Arabia");
INSERT INTO countries VALUES("192","SN","Senegal");
INSERT INTO countries VALUES("193","RS","Serbia");
INSERT INTO countries VALUES("194","SC","Seychelles");
INSERT INTO countries VALUES("195","SL","Sierra Leone");
INSERT INTO countries VALUES("196","SG","Singapore");
INSERT INTO countries VALUES("197","SK","Slovakia");
INSERT INTO countries VALUES("198","SI","Slovenia");
INSERT INTO countries VALUES("199","SB","Solomon Islands");
INSERT INTO countries VALUES("200","SO","Somalia");
INSERT INTO countries VALUES("201","ZA","South Africa");
INSERT INTO countries VALUES("202","GS","South Georgia South Sandwich Islands");
INSERT INTO countries VALUES("203","SS","South Sudan");
INSERT INTO countries VALUES("204","ES","Spain");
INSERT INTO countries VALUES("205","LK","Sri Lanka");
INSERT INTO countries VALUES("206","SH","St. Helena");
INSERT INTO countries VALUES("207","PM","St. Pierre and Miquelon");
INSERT INTO countries VALUES("208","SD","Sudan");
INSERT INTO countries VALUES("209","SR","Suriname");
INSERT INTO countries VALUES("210","SJ","Svalbard and Jan Mayen Islands");
INSERT INTO countries VALUES("211","SZ","Eswatini");
INSERT INTO countries VALUES("212","SE","Sweden");
INSERT INTO countries VALUES("213","CH","Switzerland");
INSERT INTO countries VALUES("214","SY","Syrian Arab Republic");
INSERT INTO countries VALUES("215","TW","Taiwan");
INSERT INTO countries VALUES("216","TJ","Tajikistan");
INSERT INTO countries VALUES("217","TZ","Tanzania, United Republic of");
INSERT INTO countries VALUES("218","TH","Thailand");
INSERT INTO countries VALUES("219","TG","Togo");
INSERT INTO countries VALUES("220","TK","Tokelau");
INSERT INTO countries VALUES("221","TO","Tonga");
INSERT INTO countries VALUES("222","TT","Trinidad and Tobago");
INSERT INTO countries VALUES("223","TN","Tunisia");
INSERT INTO countries VALUES("224","TR","Turkey");
INSERT INTO countries VALUES("225","TM","Turkmenistan");
INSERT INTO countries VALUES("226","TC","Turks and Caicos Islands");
INSERT INTO countries VALUES("227","TV","Tuvalu");
INSERT INTO countries VALUES("228","UG","Uganda");
INSERT INTO countries VALUES("229","UA","Ukraine");
INSERT INTO countries VALUES("230","AE","United Arab Emirates");
INSERT INTO countries VALUES("231","GB","United Kingdom");
INSERT INTO countries VALUES("232","US","United States");
INSERT INTO countries VALUES("233","UM","United States minor outlying islands");
INSERT INTO countries VALUES("234","UY","Uruguay");
INSERT INTO countries VALUES("235","UZ","Uzbekistan");
INSERT INTO countries VALUES("236","VU","Vanuatu");
INSERT INTO countries VALUES("237","VA","Vatican City State");
INSERT INTO countries VALUES("238","VE","Venezuela");
INSERT INTO countries VALUES("239","VN","Vietnam");
INSERT INTO countries VALUES("240","VG","Virgin Islands (British)");
INSERT INTO countries VALUES("241","VI","Virgin Islands (U.S.)");
INSERT INTO countries VALUES("242","WF","Wallis and Futuna Islands");
INSERT INTO countries VALUES("243","EH","Western Sahara");
INSERT INTO countries VALUES("244","YE","Yemen");
INSERT INTO countries VALUES("245","ZM","Zambia");
INSERT INTO countries VALUES("246","ZW","Zimbabwe");



DROP TABLE IF EXISTS orders;

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'checkout',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_id` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO orders VALUES("1","1","2","7","paid","2022-05-14 12:18:52","cs_test_a1VVpYOFPXUJD0FFrpVZG17As64fcBGXP9lOC5cGife2uoCHF92TswaEKb");
INSERT INTO orders VALUES("2","1","4","7","paid","2022-06-13 13:37:46","cs_test_a1ZzfYIGEzudhWAhiyDC6orvHIdg0EGM6UiLwg5WGXdy7xBt0DyYEf6mTg");
INSERT INTO orders VALUES("3","1","5","7","paid","2022-06-12 16:09:20","cs_test_a1hrfumKnxiMLilAeuN0heTYru9VRu2sRQdgjr2rBMQSuyrHiFgkVlGPhq");
INSERT INTO orders VALUES("4","2","2","7","paid","2022-06-11 16:11:22","cs_test_a1JZkbXZShE3oXN7Or6emcguZwVZE0VkBt6wh4HPnHG6deVu2aHuYvaf8n");
INSERT INTO orders VALUES("5","2","3","7","paid","2022-06-14 16:11:22","cs_test_a1JZkbXZShE3oXN7Or6emcguZwVZE0VkBt6wh4HPnHG6deVu2aHuYvaf8n");
INSERT INTO orders VALUES("6","4","7","7","paid","2022-06-14 16:09:20","cs_test_a1hrfumKnxiMLilAeuN0heTYru9VRu2sRQdgjr2rBMQSuyrHiFgkVlGPhq");



DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'draft',
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `slug` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `published_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

INSERT INTO pages VALUES("16","ttttttt2","&lt;p&gt;tttttttttttt&lt;/p&gt;","published","18","2022-05-19 18:35:03","8","2022-05-21 12:45:01","2022-05-29 09:33:40","uploads/images (3).png");
INSERT INTO pages VALUES("27","yuvraj","&lt;p&gt;yuvraj dhakar&lt;/p&gt;","published","18","2022-05-23 06:05:27","yuvraj-2","2022-05-23 09:35:27","2022-05-27 07:38:30","uploads/download (5).jpg");
INSERT INTO pages VALUES("28","idjoiajoiajsoi","&lt;p&gt;wwiwu0dw09d9w90w&lt;/p&gt;","published","7","2022-05-27 08:23:00","idjoiajoiajsoi","2022-05-27 11:53:01","2022-05-27 08:32:22","uploads/download (1).png");
INSERT INTO pages VALUES("29","test3","<p>dfghjkl;lkjfdszdffgjkll;</p>","published","7","2022-05-30 18:29:33","test3","2022-05-30 21:59:33","2022-05-30 18:29:33","");
INSERT INTO pages VALUES("30","rtytrt","<p>trrtrt</p>","published","7","2022-06-01 08:07:39","rtytrt","2022-06-01 11:37:39","2022-06-01 08:07:39","");
INSERT INTO pages VALUES("31","ytydtuystuy","<p>ayutauytduytduyadst</p>","draft","7","2022-06-01 15:54:33","ytydtuystuy","2022-06-01 19:24:33","0000-00-00 00:00:00","");
INSERT INTO pages VALUES("32","uatyaytytfstSR","<p>ytyttyaSRastrtaSY</p>","draft","7","2022-06-01 15:54:55","uatyaytytfstSR","2022-06-01 19:24:55","0000-00-00 00:00:00","");
INSERT INTO pages VALUES("33","agfaSTYFAstys","<p>affdTTtyAR6As</p>","draft","7","2022-06-01 15:55:07","agfaSTYFAstys","2022-06-01 19:25:07","0000-00-00 00:00:00","");
INSERT INTO pages VALUES("34","tyrytrtyrtty","<p>frtrtdtrre5ewewwe</p>","published","7","2022-06-01 16:08:59","asdf","2022-06-01 19:38:59","2022-06-01 16:08:59","");
INSERT INTO pages VALUES("35","yuvrajrrty","<p>eewreryuy6uuiuytreeeaesrtyui</p>","published","7","2022-06-01 16:40:10","yuvrajrrty","2022-06-01 20:10:10","2022-06-01 16:40:10","");
INSERT INTO pages VALUES("36","werrtyui","<p>warestyuio</p>","draft","7","2022-06-01 16:40:49","werrtyui","2022-06-01 20:10:49","0000-00-00 00:00:00","");
INSERT INTO pages VALUES("37","aSDTFUUHIOIP","<p>QWER6TY89IOPOIUYTREEDFGHJKHGFDSsdfghjk</p>","published","7","2022-06-01 16:41:41","aSDTFUUHIOIP","2022-06-01 20:11:41","2022-06-01 16:41:41","");
INSERT INTO pages VALUES("38","aerstdyuio","<p>wearstdyuoipp</p>","published","7","2022-06-01 16:42:18","aerstdyuio","2022-06-01 20:12:18","2022-06-01 16:42:18","");
INSERT INTO pages VALUES("41","","","","0","0000-00-00 00:00:00","6","2022-06-01 23:56:45","0000-00-00 00:00:00","uploads/1_VHzewFnOhBzdksxYS0XRDw.png");
INSERT INTO pages VALUES("48","","","draft","0","2022-06-02 00:34:59","5","2022-06-02 00:34:59","0000-00-00 00:00:00","uploads/1_VHzewFnOhBzdksxYS0XRDw.png");
INSERT INTO pages VALUES("49","","","draft","0","2022-06-02 00:35:24","4","2022-06-02 00:35:24","0000-00-00 00:00:00","uploads/2560px-Anchor_by_Panasonic_logo.svg.png");
INSERT INTO pages VALUES("50","","","draft","0","2022-06-02 00:37:05","3","2022-06-02 00:37:05","0000-00-00 00:00:00","uploads/1_VHzewFnOhBzdksxYS0XRDw.png");
INSERT INTO pages VALUES("51","","","draft","0","2022-06-02 00:38:34","2","2022-06-02 00:38:34","0000-00-00 00:00:00","uploads/2560px-Anchor_by_Panasonic_logo.svg.png");
INSERT INTO pages VALUES("52","","","draft","0","2022-06-02 00:41:08","1","2022-06-02 00:41:08","0000-00-00 00:00:00","uploads/bajaj-electricals-logo.jpg");
INSERT INTO pages VALUES("53","","","draft","0","2022-06-02 00:44:58","asdfgh","2022-06-02 00:44:58","0000-00-00 00:00:00","uploads/images (1).jpg");
INSERT INTO pages VALUES("54","yuvraj2","<p>second pages</p>","published","7","2022-06-17 07:37:43","yuvraj2","2022-06-17 11:07:43","2022-06-17 07:37:43","");



DROP TABLE IF EXISTS plans;

CREATE TABLE `plans` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` longtext NOT NULL,
  `primary_image` varchar(256) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'draft',
  `price_id` varchar(256) NOT NULL,
  `role_name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO plans VALUES("1","first","silver plan","https://i.imgur.com/EHyR2nP.png","published","3","gold");
INSERT INTO plans VALUES("4","second","golden plan","https://i.imgur.com/EHyR2nP.png","published","1","");
INSERT INTO plans VALUES("10","yuvraj","silver","https://i.imgur.com/EHyR2nP.png","draft","3","");
INSERT INTO plans VALUES("11","yuvraj","silver","https://i.imgur.com/EHyR2nP.png","published","3","silver");



DROP TABLE IF EXISTS plans_orders;

CREATE TABLE `plans_orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'checkout',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS posts;

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  UNIQUE KEY `post_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO posts VALUES("1","sunt aut facere repellat provident occaecati excepturi optio reprehenderit","1","quia et suscipit
suscipit recusandae consequuntur expedita et cum
reprehenderit molestiae ut ut quas totam
nostrum rerum est autem sunt rem eveniet architecto");
INSERT INTO posts VALUES("2","qui est esse","1","est rerum tempore vitae
sequi sint nihil reprehenderit dolor beatae ea dolores neque
fugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis
qui aperiam non debitis possimus qui neque nisi nulla");
INSERT INTO posts VALUES("3","ea molestias quasi exercitationem repellat qui ipsa sit aut","1","et iusto sed quo iure
voluptatem occaecati omnis eligendi aut ad
voluptatem doloribus vel accusantium quis pariatur
molestiae porro eius odio et labore et velit aut");
INSERT INTO posts VALUES("4","eum et est occaecati","1","ullam et saepe reiciendis voluptatem adipisci
sit amet autem assumenda provident rerum culpa
quis hic commodi nesciunt rem tenetur doloremque ipsam iure
quis sunt voluptatem rerum illo velit");
INSERT INTO posts VALUES("5","nesciunt quas odio","1","repudiandae veniam quaerat sunt sed
alias aut fugiat sit autem sed est
voluptatem omnis possimus esse voluptatibus quis
est aut tenetur dolor neque");
INSERT INTO posts VALUES("6","dolorem eum magni eos aperiam quia","1","ut aspernatur corporis harum nihil quis provident sequi
mollitia nobis aliquid molestiae
perspiciatis et ea nemo ab reprehenderit accusantium quas
voluptate dolores velit et doloremque molestiae");
INSERT INTO posts VALUES("7","magnam facilis autem","1","dolore placeat quibusdam ea quo vitae
magni quis enim qui quis quo nemo aut saepe
quidem repellat excepturi ut quia
sunt ut sequi eos ea sed quas");
INSERT INTO posts VALUES("8","dolorem dolore est ipsam","1","dignissimos aperiam dolorem qui eum
facilis quibusdam animi sint suscipit qui sint possimus cum
quaerat magni maiores excepturi
ipsam ut commodi dolor voluptatum modi aut vitae");
INSERT INTO posts VALUES("9","nesciunt iure omnis dolorem tempora et accusantium","1","consectetur animi nesciunt iure dolore
enim quia ad
veniam autem ut quam aut nobis
et est aut quod aut provident voluptas autem voluptas");
INSERT INTO posts VALUES("10","optio molestias id quia eum","1","quo et expedita modi cum officia vel magni
doloribus qui repudiandae
vero nisi sit
quos veniam quod sed accusamus veritatis error");
INSERT INTO posts VALUES("11","et ea vero quia laudantium autem","2","delectus reiciendis molestiae occaecati non minima eveniet qui voluptatibus
accusamus in eum beatae sit
vel qui neque voluptates ut commodi qui incidunt
ut animi commodi");
INSERT INTO posts VALUES("12","in quibusdam tempore odit est dolorem","2","itaque id aut magnam
praesentium quia et ea odit et ea voluptas et
sapiente quia nihil amet occaecati quia id voluptatem
incidunt ea est distinctio odio");
INSERT INTO posts VALUES("13","dolorum ut in voluptas mollitia et saepe quo animi","2","aut dicta possimus sint mollitia voluptas commodi quo doloremque
iste corrupti reiciendis voluptatem eius rerum
sit cumque quod eligendi laborum minima
perferendis recusandae assumenda consectetur porro architecto ipsum ipsam");
INSERT INTO posts VALUES("14","voluptatem eligendi optio","2","fuga et accusamus dolorum perferendis illo voluptas
non doloremque neque facere
ad qui dolorum molestiae beatae
sed aut voluptas totam sit illum");
INSERT INTO posts VALUES("15","eveniet quod temporibus","2","reprehenderit quos placeat
velit minima officia dolores impedit repudiandae molestiae nam
voluptas recusandae quis delectus
officiis harum fugiat vitae");
INSERT INTO posts VALUES("16","sint suscipit perspiciatis velit dolorum rerum ipsa laboriosam odio","2","suscipit nam nisi quo aperiam aut
asperiores eos fugit maiores voluptatibus quia
voluptatem quis ullam qui in alias quia est
consequatur magni mollitia accusamus ea nisi voluptate dicta");
INSERT INTO posts VALUES("17","fugit voluptas sed molestias voluptatem provident","2","eos voluptas et aut odit natus earum
aspernatur fuga molestiae ullam
deserunt ratione qui eos
qui nihil ratione nemo velit ut aut id quo");
INSERT INTO posts VALUES("18","voluptate et itaque vero tempora molestiae","2","eveniet quo quis
laborum totam consequatur non dolor
ut et est repudiandae
est voluptatem vel debitis et magnam");
INSERT INTO posts VALUES("19","adipisci placeat illum aut reiciendis qui","2","illum quis cupiditate provident sit magnam
ea sed aut omnis
veniam maiores ullam consequatur atque
adipisci quo iste expedita sit quos voluptas");
INSERT INTO posts VALUES("20","doloribus ad provident suscipit at","2","qui consequuntur ducimus possimus quisquam amet similique
suscipit porro ipsam amet
eos veritatis officiis exercitationem vel fugit aut necessitatibus totam
omnis rerum consequatur expedita quidem cumque explicabo");
INSERT INTO posts VALUES("21","asperiores ea ipsam voluptatibus modi minima quia sint","3","repellat aliquid praesentium dolorem quo
sed totam minus non itaque
nihil labore molestiae sunt dolor eveniet hic recusandae veniam
tempora et tenetur expedita sunt");
INSERT INTO posts VALUES("22","dolor sint quo a velit explicabo quia nam","3","eos qui et ipsum ipsam suscipit aut
sed omnis non odio
expedita earum mollitia molestiae aut atque rem suscipit
nam impedit esse");
INSERT INTO posts VALUES("23","maxime id vitae nihil numquam","3","veritatis unde neque eligendi
quae quod architecto quo neque vitae
est illo sit tempora doloremque fugit quod
et et vel beatae sequi ullam sed tenetur perspiciatis");
INSERT INTO posts VALUES("24","autem hic labore sunt dolores incidunt","3","enim et ex nulla
omnis voluptas quia qui
voluptatem consequatur numquam aliquam sunt
totam recusandae id dignissimos aut sed asperiores deserunt");
INSERT INTO posts VALUES("25","rem alias distinctio quo quis","3","ullam consequatur ut
omnis quis sit vel consequuntur
ipsa eligendi ipsum molestiae et omnis error nostrum
molestiae illo tempore quia et distinctio");
INSERT INTO posts VALUES("26","est et quae odit qui non","3","similique esse doloribus nihil accusamus
omnis dolorem fuga consequuntur reprehenderit fugit recusandae temporibus
perspiciatis cum ut laudantium
omnis aut molestiae vel vero");
INSERT INTO posts VALUES("27","quasi id et eos tenetur aut quo autem","3","eum sed dolores ipsam sint possimus debitis occaecati
debitis qui qui et
ut placeat enim earum aut odit facilis
consequatur suscipit necessitatibus rerum sed inventore temporibus consequatur");
INSERT INTO posts VALUES("28","delectus ullam et corporis nulla voluptas sequi","3","non et quaerat ex quae ad maiores
maiores recusandae totam aut blanditiis mollitia quas illo
ut voluptatibus voluptatem
similique nostrum eum");
INSERT INTO posts VALUES("29","iusto eius quod necessitatibus culpa ea","3","odit magnam ut saepe sed non qui
tempora atque nihil
accusamus illum doloribus illo dolor
eligendi repudiandae odit magni similique sed cum maiores");
INSERT INTO posts VALUES("30","a quo magni similique perferendis","3","alias dolor cumque
impedit blanditiis non eveniet odio maxime
blanditiis amet eius quis tempora quia autem rem
a provident perspiciatis quia");
INSERT INTO posts VALUES("31","ullam ut quidem id aut vel consequuntur","4","debitis eius sed quibusdam non quis consectetur vitae
impedit ut qui consequatur sed aut in
quidem sit nostrum et maiores adipisci atque
quaerat voluptatem adipisci repudiandae");
INSERT INTO posts VALUES("32","doloremque illum aliquid sunt","4","deserunt eos nobis asperiores et hic
est debitis repellat molestiae optio
nihil ratione ut eos beatae quibusdam distinctio maiores
earum voluptates et aut adipisci ea maiores voluptas maxime");
INSERT INTO posts VALUES("33","qui explicabo molestiae dolorem","4","rerum ut et numquam laborum odit est sit
id qui sint in
quasi tenetur tempore aperiam et quaerat qui in
rerum officiis sequi cumque quod");
INSERT INTO posts VALUES("34","magnam ut rerum iure","4","ea velit perferendis earum ut voluptatem voluptate itaque iusto
totam pariatur in
nemo voluptatem voluptatem autem magni tempora minima in
est distinctio qui assumenda accusamus dignissimos officia nesciunt nobis");
INSERT INTO posts VALUES("35","id nihil consequatur molestias animi provident","4","nisi error delectus possimus ut eligendi vitae
placeat eos harum cupiditate facilis reprehenderit voluptatem beatae
modi ducimus quo illum voluptas eligendi
et nobis quia fugit");
INSERT INTO posts VALUES("36","fuga nam accusamus voluptas reiciendis itaque","4","ad mollitia et omnis minus architecto odit
voluptas doloremque maxime aut non ipsa qui alias veniam
blanditiis culpa aut quia nihil cumque facere et occaecati
qui aspernatur quia eaque ut aperiam inventore");
INSERT INTO posts VALUES("37","provident vel ut sit ratione est","4","debitis et eaque non officia sed nesciunt pariatur vel
voluptatem iste vero et ea
numquam aut expedita ipsum nulla in
voluptates omnis consequatur aut enim officiis in quam qui");
INSERT INTO posts VALUES("38","explicabo et eos deleniti nostrum ab id repellendus","4","animi esse sit aut sit nesciunt assumenda eum voluptas
quia voluptatibus provident quia necessitatibus ea
rerum repudiandae quia voluptatem delectus fugit aut id quia
ratione optio eos iusto veniam iure");
INSERT INTO posts VALUES("39","eos dolorem iste accusantium est eaque quam","4","corporis rerum ducimus vel eum accusantium
maxime aspernatur a porro possimus iste omnis
est in deleniti asperiores fuga aut
voluptas sapiente vel dolore minus voluptatem incidunt ex");
INSERT INTO posts VALUES("40","enim quo cumque","4","ut voluptatum aliquid illo tenetur nemo sequi quo facilis
ipsum rem optio mollitia quas
voluptatem eum voluptas qui
unde omnis voluptatem iure quasi maxime voluptas nam");
INSERT INTO posts VALUES("41","non est facere","5","molestias id nostrum
excepturi molestiae dolore omnis repellendus quaerat saepe
consectetur iste quaerat tenetur asperiores accusamus ex ut
nam quidem est ducimus sunt debitis saepe");
INSERT INTO posts VALUES("42","commodi ullam sint et excepturi error explicabo praesentium voluptas","5","odio fugit voluptatum ducimus earum autem est incidunt voluptatem
odit reiciendis aliquam sunt sequi nulla dolorem
non facere repellendus voluptates quia
ratione harum vitae ut");
INSERT INTO posts VALUES("43","eligendi iste nostrum consequuntur adipisci praesentium sit beatae perferendis","5","similique fugit est
illum et dolorum harum et voluptate eaque quidem
exercitationem quos nam commodi possimus cum odio nihil nulla
dolorum exercitationem magnam ex et a et distinctio debitis");
INSERT INTO posts VALUES("44","optio dolor molestias sit","5","temporibus est consectetur dolore
et libero debitis vel velit laboriosam quia
ipsum quibusdam qui itaque fuga rem aut
ea et iure quam sed maxime ut distinctio quae");
INSERT INTO posts VALUES("45","ut numquam possimus omnis eius suscipit laudantium iure","5","est natus reiciendis nihil possimus aut provident
ex et dolor
repellat pariatur est
nobis rerum repellendus dolorem autem");
INSERT INTO posts VALUES("46","aut quo modi neque nostrum ducimus","5","voluptatem quisquam iste
voluptatibus natus officiis facilis dolorem
quis quas ipsam
vel et voluptatum in aliquid");
INSERT INTO posts VALUES("47","quibusdam cumque rem aut deserunt","5","voluptatem assumenda ut qui ut cupiditate aut impedit veniam
occaecati nemo illum voluptatem laudantium
molestiae beatae rerum ea iure soluta nostrum
eligendi et voluptate");
INSERT INTO posts VALUES("48","ut voluptatem illum ea doloribus itaque eos","5","voluptates quo voluptatem facilis iure occaecati
vel assumenda rerum officia et
illum perspiciatis ab deleniti
laudantium repellat ad ut et autem reprehenderit");
INSERT INTO posts VALUES("49","laborum non sunt aut ut assumenda perspiciatis voluptas","5","inventore ab sint
natus fugit id nulla sequi architecto nihil quaerat
eos tenetur in in eum veritatis non
quibusdam officiis aspernatur cumque aut commodi aut");
INSERT INTO posts VALUES("50","repellendus qui recusandae incidunt voluptates tenetur qui omnis exercitationem","5","error suscipit maxime adipisci consequuntur recusandae
voluptas eligendi et est et voluptates
quia distinctio ab amet quaerat molestiae et vitae
adipisci impedit sequi nesciunt quis consectetur");
INSERT INTO posts VALUES("51","soluta aliquam aperiam consequatur illo quis voluptas","6","sunt dolores aut doloribus
dolore doloribus voluptates tempora et
doloremque et quo
cum asperiores sit consectetur dolorem");
INSERT INTO posts VALUES("52","qui enim et consequuntur quia animi quis voluptate quibusdam","6","iusto est quibusdam fuga quas quaerat molestias
a enim ut sit accusamus enim
temporibus iusto accusantium provident architecto
soluta esse reprehenderit qui laborum");
INSERT INTO posts VALUES("53","ut quo aut ducimus alias","6","minima harum praesentium eum rerum illo dolore
quasi exercitationem rerum nam
porro quis neque quo
consequatur minus dolor quidem veritatis sunt non explicabo similique");
INSERT INTO posts VALUES("54","sit asperiores ipsam eveniet odio non quia","6","totam corporis dignissimos
vitae dolorem ut occaecati accusamus
ex velit deserunt
et exercitationem vero incidunt corrupti mollitia");
INSERT INTO posts VALUES("55","sit vel voluptatem et non libero","6","debitis excepturi ea perferendis harum libero optio
eos accusamus cum fuga ut sapiente repudiandae
et ut incidunt omnis molestiae
nihil ut eum odit");
INSERT INTO posts VALUES("56","qui et at rerum necessitatibus","6","aut est omnis dolores
neque rerum quod ea rerum velit pariatur beatae excepturi
et provident voluptas corrupti
corporis harum reprehenderit dolores eligendi");
INSERT INTO posts VALUES("57","sed ab est est","6","at pariatur consequuntur earum quidem
quo est laudantium soluta voluptatem
qui ullam et est
et cum voluptas voluptatum repellat est");
INSERT INTO posts VALUES("58","voluptatum itaque dolores nisi et quasi","6","veniam voluptatum quae adipisci id
et id quia eos ad et dolorem
aliquam quo nisi sunt eos impedit error
ad similique veniam");
INSERT INTO posts VALUES("59","qui commodi dolor at maiores et quis id accusantium","6","perspiciatis et quam ea autem temporibus non voluptatibus qui
beatae a earum officia nesciunt dolores suscipit voluptas et
animi doloribus cum rerum quas et magni
et hic ut ut commodi expedita sunt");
INSERT INTO posts VALUES("60","consequatur placeat omnis quisquam quia reprehenderit fugit veritatis facere","6","asperiores sunt ab assumenda cumque modi velit
qui esse omnis
voluptate et fuga perferendis voluptas
illo ratione amet aut et omnis");
INSERT INTO posts VALUES("61","voluptatem doloribus consectetur est ut ducimus","7","ab nemo optio odio
delectus tenetur corporis similique nobis repellendus rerum omnis facilis
vero blanditiis debitis in nesciunt doloribus dicta dolores
magnam minus velit");
INSERT INTO posts VALUES("62","beatae enim quia vel","7","enim aspernatur illo distinctio quae praesentium
beatae alias amet delectus qui voluptate distinctio
odit sint accusantium autem omnis
quo molestiae omnis ea eveniet optio");
INSERT INTO posts VALUES("63","voluptas blanditiis repellendus animi ducimus error sapiente et suscipit","7","enim adipisci aspernatur nemo
numquam omnis facere dolorem dolor ex quis temporibus incidunt
ab delectus culpa quo reprehenderit blanditiis asperiores
accusantium ut quam in voluptatibus voluptas ipsam dicta");
INSERT INTO posts VALUES("64","et fugit quas eum in in aperiam quod","7","id velit blanditiis
eum ea voluptatem
molestiae sint occaecati est eos perspiciatis
incidunt a error provident eaque aut aut qui");
INSERT INTO posts VALUES("65","consequatur id enim sunt et et","7","voluptatibus ex esse
sint explicabo est aliquid cumque adipisci fuga repellat labore
molestiae corrupti ex saepe at asperiores et perferendis
natus id esse incidunt pariatur");
INSERT INTO posts VALUES("66","repudiandae ea animi iusto","7","officia veritatis tenetur vero qui itaque
sint non ratione
sed et ut asperiores iusto eos molestiae nostrum
veritatis quibusdam et nemo iusto saepe");
INSERT INTO posts VALUES("67","aliquid eos sed fuga est maxime repellendus","7","reprehenderit id nostrum
voluptas doloremque pariatur sint et accusantium quia quod aspernatur
et fugiat amet
non sapiente et consequatur necessitatibus molestiae");
INSERT INTO posts VALUES("68","odio quis facere architecto reiciendis optio","7","magnam molestiae perferendis quisquam
qui cum reiciendis
quaerat animi amet hic inventore
ea quia deleniti quidem saepe porro velit");
INSERT INTO posts VALUES("69","fugiat quod pariatur odit minima","7","officiis error culpa consequatur modi asperiores et
dolorum assumenda voluptas et vel qui aut vel rerum
voluptatum quisquam perspiciatis quia rerum consequatur totam quas
sequi commodi repudiandae asperiores et saepe a");
INSERT INTO posts VALUES("70","voluptatem laborum magni","7","sunt repellendus quae
est asperiores aut deleniti esse accusamus repellendus quia aut
quia dolorem unde
eum tempora esse dolore");
INSERT INTO posts VALUES("71","et iusto veniam et illum aut fuga","8","occaecati a doloribus
iste saepe consectetur placeat eum voluptate dolorem et
qui quo quia voluptas
rerum ut id enim velit est perferendis");
INSERT INTO posts VALUES("72","sint hic doloribus consequatur eos non id","8","quam occaecati qui deleniti consectetur
consequatur aut facere quas exercitationem aliquam hic voluptas
neque id sunt ut aut accusamus
sunt consectetur expedita inventore velit");
INSERT INTO posts VALUES("73","consequuntur deleniti eos quia temporibus ab aliquid at","8","voluptatem cumque tenetur consequatur expedita ipsum nemo quia explicabo
aut eum minima consequatur
tempore cumque quae est et
et in consequuntur voluptatem voluptates aut");
INSERT INTO posts VALUES("74","enim unde ratione doloribus quas enim ut sit sapiente","8","odit qui et et necessitatibus sint veniam
mollitia amet doloremque molestiae commodi similique magnam et quam
blanditiis est itaque
quo et tenetur ratione occaecati molestiae tempora");
INSERT INTO posts VALUES("75","dignissimos eum dolor ut enim et delectus in","8","commodi non non omnis et voluptas sit
autem aut nobis magnam et sapiente voluptatem
et laborum repellat qui delectus facilis temporibus
rerum amet et nemo voluptate expedita adipisci error dolorem");
INSERT INTO posts VALUES("76","doloremque officiis ad et non perferendis","8","ut animi facere
totam iusto tempore
molestiae eum aut et dolorem aperiam
quaerat recusandae totam odio");
INSERT INTO posts VALUES("77","necessitatibus quasi exercitationem odio","8","modi ut in nulla repudiandae dolorum nostrum eos
aut consequatur omnis
ut incidunt est omnis iste et quam
voluptates sapiente aliquam asperiores nobis amet corrupti repudiandae provident");
INSERT INTO posts VALUES("78","quam voluptatibus rerum veritatis","8","nobis facilis odit tempore cupiditate quia
assumenda doloribus rerum qui ea
illum et qui totam
aut veniam repellendus");
INSERT INTO posts VALUES("79","pariatur consequatur quia magnam autem omnis non amet","8","libero accusantium et et facere incidunt sit dolorem
non excepturi qui quia sed laudantium
quisquam molestiae ducimus est
officiis esse molestiae iste et quos");
INSERT INTO posts VALUES("80","labore in ex et explicabo corporis aut quas","8","ex quod dolorem ea eum iure qui provident amet
quia qui facere excepturi et repudiandae
asperiores molestias provident
minus incidunt vero fugit rerum sint sunt excepturi provident");
INSERT INTO posts VALUES("81","tempora rem veritatis voluptas quo dolores vero","9","facere qui nesciunt est voluptatum voluptatem nisi
sequi eligendi necessitatibus ea at rerum itaque
harum non ratione velit laboriosam quis consequuntur
ex officiis minima doloremque voluptas ut aut");
INSERT INTO posts VALUES("82","laudantium voluptate suscipit sunt enim enim","9","ut libero sit aut totam inventore sunt
porro sint qui sunt molestiae
consequatur cupiditate qui iste ducimus adipisci
dolor enim assumenda soluta laboriosam amet iste delectus hic");
INSERT INTO posts VALUES("83","odit et voluptates doloribus alias odio et","9","est molestiae facilis quis tempora numquam nihil qui
voluptate sapiente consequatur est qui
necessitatibus autem aut ipsa aperiam modi dolore numquam
reprehenderit eius rem quibusdam");
INSERT INTO posts VALUES("84","optio ipsam molestias necessitatibus occaecati facilis veritatis dolores aut","9","sint molestiae magni a et quos
eaque et quasi
ut rerum debitis similique veniam
recusandae dignissimos dolor incidunt consequatur odio");
INSERT INTO posts VALUES("85","dolore veritatis porro provident adipisci blanditiis et sunt","9","similique sed nisi voluptas iusto omnis
mollitia et quo
assumenda suscipit officia magnam sint sed tempora
enim provident pariatur praesentium atque animi amet ratione");
INSERT INTO posts VALUES("86","placeat quia et porro iste","9","quasi excepturi consequatur iste autem temporibus sed molestiae beatae
et quaerat et esse ut
voluptatem occaecati et vel explicabo autem
asperiores pariatur deserunt optio");
INSERT INTO posts VALUES("87","nostrum quis quasi placeat","9","eos et molestiae
nesciunt ut a
dolores perspiciatis repellendus repellat aliquid
magnam sint rem ipsum est");
INSERT INTO posts VALUES("88","sapiente omnis fugit eos","9","consequatur omnis est praesentium
ducimus non iste
neque hic deserunt
voluptatibus veniam cum et rerum sed");
INSERT INTO posts VALUES("89","sint soluta et vel magnam aut ut sed qui","9","repellat aut aperiam totam temporibus autem et
architecto magnam ut
consequatur qui cupiditate rerum quia soluta dignissimos nihil iure
tempore quas est");
INSERT INTO posts VALUES("90","ad iusto omnis odit dolor voluptatibus","9","minus omnis soluta quia
qui sed adipisci voluptates illum ipsam voluptatem
eligendi officia ut in
eos soluta similique molestias praesentium blanditiis");
INSERT INTO posts VALUES("91","aut amet sed","10","libero voluptate eveniet aperiam sed
sunt placeat suscipit molestias
similique fugit nam natus
expedita consequatur consequatur dolores quia eos et placeat");
INSERT INTO posts VALUES("92","ratione ex tenetur perferendis","10","aut et excepturi dicta laudantium sint rerum nihil
laudantium et at
a neque minima officia et similique libero et
commodi voluptate qui");
INSERT INTO posts VALUES("93","beatae soluta recusandae","10","dolorem quibusdam ducimus consequuntur dicta aut quo laboriosam
voluptatem quis enim recusandae ut sed sunt
nostrum est odit totam
sit error sed sunt eveniet provident qui nulla");
INSERT INTO posts VALUES("94","qui qui voluptates illo iste minima","10","aspernatur expedita soluta quo ab ut similique
expedita dolores amet
sed temporibus distinctio magnam saepe deleniti
omnis facilis nam ipsum natus sint similique omnis");
INSERT INTO posts VALUES("95","id minus libero illum nam ad officiis","10","earum voluptatem facere provident blanditiis velit laboriosam
pariatur accusamus odio saepe
cumque dolor qui a dicta ab doloribus consequatur omnis
corporis cupiditate eaque assumenda ad nesciunt");
INSERT INTO posts VALUES("96","quaerat velit veniam amet cupiditate aut numquam ut sequi","10","in non odio excepturi sint eum
labore voluptates vitae quia qui et
inventore itaque rerum
veniam non exercitationem delectus aut");
INSERT INTO posts VALUES("97","quas fugiat ut perspiciatis vero provident","10","eum non blanditiis soluta porro quibusdam voluptas
vel voluptatem qui placeat dolores qui velit aut
vel inventore aut cumque culpa explicabo aliquid at
perspiciatis est et voluptatem dignissimos dolor itaque sit nam");
INSERT INTO posts VALUES("98","laboriosam dolor voluptates","10","doloremque ex facilis sit sint culpa
soluta assumenda eligendi non ut eius
sequi ducimus vel quasi
veritatis est dolores");
INSERT INTO posts VALUES("99","temporibus sit alias delectus eligendi possimus magni","10","quo deleniti praesentium dicta non quod
aut est molestias
molestias et officia quis nihil
itaque dolorem quia");
INSERT INTO posts VALUES("100","at nam consequatur ea labore ea harum","10","cupiditate quo est a modi nesciunt soluta
ipsa voluptas error itaque dicta in
autem qui minus magnam et distinctio eum
accusamus ratione error aut");



DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `primary_image` varchar(256) DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO products VALUES("1","etyutui","345.00","wertuiiokwaerstyuyu","asdfghj","2022-06-14 12:25:08","2022-06-14 11:45:55","0000-00-00 00:00:00","https://ik.imagekit.io/ycjbe3h1r/tr:n-ik_ml_thumbnail/bajaj-fan-500x500_sqN9Rx3RQ.jpg","published");
INSERT INTO products VALUES("2","second products","3.00","second products","second","2022-06-14 17:44:53","2022-06-14 11:55:58","0000-00-00 00:00:00","https://image.shutterstock.com/image-photo/simple-easy-fast-solution-concept-600w-1725113818.jpg","published");
INSERT INTO products VALUES("4","thirdproducts","4.00","thirdproducts","forth-d","2022-06-14 11:57:47","2022-06-14 11:55:58","0000-00-00 00:00:00","https://image.shutterstock.com/image-photo/simple-easy-fast-solution-concept-600w-1725113818.jpg","published");



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `value` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO settings VALUES("1","site_logo","assets/logos/logo_default.png");
INSERT INTO settings VALUES("2","site_title","Sky e-Solutions ");
INSERT INTO settings VALUES("3","copywrite_text","");



DROP TABLE IF EXISTS states;

CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO states VALUES("1","IN","Rajasthan");
INSERT INTO states VALUES("2","IN","Delhi");
INSERT INTO states VALUES("3","US","Florida");
INSERT INTO states VALUES("4","US","Hawai");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(244) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `role` varchar(256) DEFAULT NULL,
  `subscription_id` varchar(100) DEFAULT NULL,
  `customer_id` varchar(256) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `country` varchar(256) DEFAULT NULL,
  `state` varchar(256) DEFAULT NULL,
  `cities` varchar(256) DEFAULT NULL,
  `apikey` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("20","yuvraj","yuvrajdhakaryuvrajdhakar2@gmail.com","$2y$10$ufgUX8FZ7F2aCPdDHVUfoOqVyVazuMZCtecH8p9B18hJQjIHMZB8m"," ","","","","1","","","","ggggg");
INSERT INTO users VALUES("28","yuvraj","yuvrajdhakaryuvrajdhakar@gmail.com","$2y$10$LnqwYVIy7xLRPSqt.XKrcOUHaAp7azPuSug5.xSUt6o8h7WmzlnpC","92e76b082da1afb048087473b46e83e9c54c1082","admin","","","1","US","3","7","");
INSERT INTO users VALUES("31","yuvraj","yuvrajskyesole@gmail.com","$2y$10$AIXqmB7jODpT7wO8Vii0u.Glks9dFgzwz.x.GhOzMY2joba2RgURq","fa195adeffd4bddf1e1fd29e4d7a714e683e35c6","","","","0","","","","");



