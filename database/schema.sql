-- Trader Gulf Database Schema
-- Run: mysql -u root tradergulf < schema.sql

CREATE DATABASE IF NOT EXISTS tradergulf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tradergulf;

-- -------------------------------------------------------
-- brokers: master broker data (drives listings + compare)
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS brokers (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    slug                VARCHAR(100) NOT NULL UNIQUE,
    name                VARCHAR(100) NOT NULL,
    logo                VARCHAR(255),
    tagline             VARCHAR(255),
    overall_rating      DECIMAL(3,1) NOT NULL DEFAULT 0.0,
    -- Regulation
    regulation          VARCHAR(500),
    founded_year        SMALLINT,
    headquarters        VARCHAR(100),
    -- Trading conditions
    min_deposit         DECIMAL(10,2),
    max_leverage        VARCHAR(20),
    spread_eurusd       DECIMAL(5,2),
    spread_type         ENUM('fixed','variable') DEFAULT 'variable',
    commission_per_lot  DECIMAL(6,2) DEFAULT 0.00,
    -- Platforms
    platforms           VARCHAR(200),
    -- Account features
    has_islamic         TINYINT(1) DEFAULT 0,
    has_copy_trading    TINYINT(1) DEFAULT 0,
    has_demo            TINYINT(1) DEFAULT 1,
    -- Deposits
    base_currencies     VARCHAR(200),
    deposit_methods     VARCHAR(500),
    -- Display / affiliate
    affiliate_url       VARCHAR(500),
    is_featured         TINYINT(1) DEFAULT 0,
    is_active           TINYINT(1) DEFAULT 1,
    sort_order          INT DEFAULT 0,
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- broker_reviews: full review HTML per broker
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS broker_reviews (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    broker_id           INT NOT NULL,
    intro_html          TEXT,
    pros                TEXT,
    cons                TEXT,
    overview_html       TEXT,
    regulation_html     TEXT,
    account_types_html  TEXT,
    platforms_html      TEXT,
    spreads_html        TEXT,
    deposits_html       TEXT,
    support_html        TEXT,
    verdict_html        TEXT,
    meta_title          VARCHAR(255),
    meta_description    VARCHAR(500),
    last_updated        DATE,
    FOREIGN KEY (broker_id) REFERENCES brokers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- articles: guides + news
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS articles (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    slug                VARCHAR(255) NOT NULL UNIQUE,
    title               VARCHAR(255) NOT NULL,
    excerpt             TEXT,
    content_html        LONGTEXT,
    category            ENUM('guide','news') NOT NULL DEFAULT 'guide',
    featured_image      VARCHAR(255),
    meta_title          VARCHAR(255),
    meta_description    VARCHAR(500),
    is_published        TINYINT(1) DEFAULT 1,
    published_at        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category  (category),
    INDEX idx_published (is_published, published_at)
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- glossary
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS glossary (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    term                VARCHAR(255) NOT NULL,
    slug                VARCHAR(255) NOT NULL UNIQUE,
    letter              CHAR(1) NOT NULL,
    definition_html     TEXT NOT NULL,
    related_terms       TEXT,
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_letter    (letter)
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- pages: static content
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS pages (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    slug                VARCHAR(255) NOT NULL UNIQUE,
    title               VARCHAR(255) NOT NULL,
    content_html        LONGTEXT,
    meta_title          VARCHAR(255),
    meta_description    VARCHAR(500),
    updated_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- settings: key-value site config
-- -------------------------------------------------------
CREATE TABLE IF NOT EXISTS settings (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    key_name    VARCHAR(100) NOT NULL UNIQUE,
    value       TEXT,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
