CREATE TABLE IF NOT EXISTS `page_views` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `path`       VARCHAR(512)    NOT NULL DEFAULT '',
    `referrer`   VARCHAR(512)    NOT NULL DEFAULT '',
    `ip`         VARCHAR(45)     NOT NULL DEFAULT '',
    `bot`        TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_path`       (`path`(255)),
    INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
