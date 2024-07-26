ALTER TABLE `#__jsn_pagebuilder4_pages` CHANGE `hash` `hash` VARCHAR(150) NOT NULL;

ALTER TABLE `#__jsn_pagebuilder4_pages` ENGINE = InnoDB;
ALTER TABLE `#__jsn_pagebuilder4_pages` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE `#__jsn_pagebuilder4_revisions` ENGINE = InnoDB;
ALTER TABLE `#__jsn_pagebuilder4_revisions` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE `#__jsn_pagebuilder4_sections` ENGINE = InnoDB;
ALTER TABLE `#__jsn_pagebuilder4_sections` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
