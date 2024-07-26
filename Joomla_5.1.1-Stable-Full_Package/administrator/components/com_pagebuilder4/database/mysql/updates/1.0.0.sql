CREATE TABLE IF NOT EXISTS `#__jsn_pagebuilder4_pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hash` varchar(150) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `data` longtext,
  `created` datetime,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime,
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__jsn_pagebuilder4_revisions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hash` varchar(150) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext,
  `html` longtext,
  `created` datetime,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime,
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__jsn_pagebuilder4_sections` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `data` longtext,
  `created` datetime,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `modified` datetime,
  `modified_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
