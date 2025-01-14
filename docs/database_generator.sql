CREATE TABLE `player`(
    `playerid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` TEXT NOT NULL,
    `password` TEXT NOT NULL,
    `signupdate` BIGINT NOT NULL,
    `active` BIGINT NOT NULL
);
ALTER TABLE
    `player` ADD UNIQUE `player_username_unique`(`username`);
CREATE TABLE `maker`(
    `makerid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `website` TEXT NOT NULL
);
CREATE TABLE `console`(
    `console_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `maker_id` BIGINT NOT NULL,
    `region` TEXT NOT NULL,
    `name` TEXT NOT NULL,
    `release_date` BIGINT NOT NULL
);
CREATE TABLE `game`(
    `game_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `region` TEXT NOT NULL,
    `title` TEXT NOT NULL,
    `age_rating` TEXT NOT NULL,
    `format_id` BIGINT NOT NULL
);
CREATE TABLE `format`(
    `format_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `format` TEXT NOT NULL
);
CREATE TABLE `playsons`(
    `playson_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `game_id` BIGINT NOT NULL,
    `console_id` BIGINT NOT NULL,
    `release_date` BIGINT NOT NULL
);
CREATE TABLE `owns`(
    `owns_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `console_id` BIGINT NOT NULL,
    `purchase_date` BIGINT NOT NULL,
    `player_id` BIGINT NOT NULL
);
CREATE TABLE `plays`(
    `plays_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `player_id` BIGINT NOT NULL,
    `playson_id` BIGINT NOT NULL,
    `purchase_date` BIGINT NOT NULL
);
ALTER TABLE
    `owns` ADD CONSTRAINT `owns_console_id_foreign` FOREIGN KEY(`console_id`) REFERENCES `console`(`console_id`);
ALTER TABLE
    `playsons` ADD CONSTRAINT `playsons_game_id_foreign` FOREIGN KEY(`game_id`) REFERENCES `game`(`game_id`);
ALTER TABLE
    `game` ADD CONSTRAINT `game_format_id_foreign` FOREIGN KEY(`format_id`) REFERENCES `format`(`format_id`);
ALTER TABLE
    `plays` ADD CONSTRAINT `plays_player_id_foreign` FOREIGN KEY(`player_id`) REFERENCES `player`(`playerid`);
ALTER TABLE
    `plays` ADD CONSTRAINT `plays_playson_id_foreign` FOREIGN KEY(`playson_id`) REFERENCES `playsons`(`playson_id`);
ALTER TABLE
    `playsons` ADD CONSTRAINT `playsons_console_id_foreign` FOREIGN KEY(`console_id`) REFERENCES `console`(`console_id`);
ALTER TABLE
    `console` ADD CONSTRAINT `console_maker_id_foreign` FOREIGN KEY(`maker_id`) REFERENCES `maker`(`makerid`);
ALTER TABLE
    `owns` ADD CONSTRAINT `owns_player_id_foreign` FOREIGN KEY(`player_id`) REFERENCES `player`(`playerid`);