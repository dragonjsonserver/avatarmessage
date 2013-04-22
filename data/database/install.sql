CREATE TABLE `avatarmessages` (
	`avatarmessage_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`modified` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	`created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`from_avatar_id` BIGINT(20) UNSIGNED NULL,
	`to_avatar_id` BIGINT(20) UNSIGNED NOT NULL,
	`subject` VARCHAR(255) NOT NULL,
	`content` TEXT NOT NULL,
	`from_state` ENUM('read', 'delete') NOT NULL,
	`to_state` ENUM('new', 'read', 'delete') NOT NULL,
	PRIMARY KEY (`avatarmessage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
