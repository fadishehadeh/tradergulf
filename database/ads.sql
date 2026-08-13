-- Ad zones & ads tables (separate from IB banners)
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `ad_zones` (
    `id`            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `slug`          VARCHAR(80)   NOT NULL,
    `name`          VARCHAR(100)  NOT NULL,
    `description`   VARCHAR(255)  NOT NULL DEFAULT '',
    `width`         SMALLINT      NOT NULL DEFAULT 728,
    `height`        SMALLINT      NOT NULL DEFAULT 90,
    `price_monthly` DECIMAL(8,2)  NOT NULL DEFAULT 0.00,
    `sort_order`    TINYINT       NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ads` (
    `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `zone_id`     INT UNSIGNED  NOT NULL,
    `advertiser`  VARCHAR(150)  NOT NULL DEFAULT '',
    `image_url`   VARCHAR(512)  NOT NULL,
    `click_url`   VARCHAR(512)  NOT NULL,
    `alt_text`    VARCHAR(255)  NOT NULL DEFAULT '',
    `starts_at`   DATE          NULL,
    `ends_at`     DATE          NULL,
    `is_active`   TINYINT(1)    NOT NULL DEFAULT 1,
    `impressions` INT UNSIGNED  NOT NULL DEFAULT 0,
    `clicks`      INT UNSIGNED  NOT NULL DEFAULT 0,
    `created_at`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_zone_active` (`zone_id`, `is_active`),
    FOREIGN KEY (`zone_id`) REFERENCES `ad_zones`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `ad_zones` (`slug`, `name`, `description`, `width`, `height`, `price_monthly`, `sort_order`) VALUES
('homepage_leaderboard',  'Homepage Leaderboard',      'Full-width banner below hero on homepage',                    728, 90,  299.00, 1),
('broker_listing_top',    'Broker Listings Top',       'Banner at top of /brokers page above all broker rows',        728, 90,  249.00, 2),
('between_listings',      'Between Broker Listings',   'Banner injected after every 4th broker row on /brokers',      728, 90,  199.00, 3),
('broker_review_sidebar', 'Broker Review Sidebar',     '300x250 rectangle in sidebar of individual broker review pages', 300, 250, 199.00, 4),
('guide_sidebar',         'Guide / Article Sidebar',   '300x250 rectangle in sidebar on guides and news pages',       300, 250, 149.00, 5),
('broker_review_top',     'Broker Review Page Top',    'Wide banner below header on individual broker review pages',  970, 90,  349.00, 6);
