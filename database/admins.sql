CREATE TABLE IF NOT EXISTS `admins` (
    `id`            INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `email`         VARCHAR(191)    NOT NULL,
    `name`          VARCHAR(100)    NOT NULL DEFAULT '',
    `password_hash` VARCHAR(255)    NOT NULL,
    `is_active`     TINYINT(1)      NOT NULL DEFAULT 1,
    `created_at`    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `admins` (`email`, `name`, `password_hash`) VALUES
('fshehadeh@gmail.com', 'Fadi',   '$2y$10$ZwDjZp5f/QbMiQW6gSkkkOUDdTjy1G6ooqMyqpnMTfbmlP3cgfPGW'),
('wissamc@gmail.com',   'Wissam', '$2y$10$gI2ABuwT7BOJtaarDt8dE.AlTpnKvA2b9eUyRRVwpf4V61lRkQJKe');
