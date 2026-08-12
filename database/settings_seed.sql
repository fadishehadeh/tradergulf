-- Run this to seed default settings keys in the database
-- Safe to run multiple times (INSERT IGNORE)
SET NAMES utf8mb4;

INSERT IGNORE INTO settings (key_name, value) VALUES
('site_name',        'Trader Gulf'),
('site_tagline',     'Independent Forex Broker Reviews & Comparisons'),
('contact_email',    'info@tradergulf.com'),
('twitter_url',      ''),
('twitter_handle',   ''),
('facebook_url',     ''),
('linkedin_url',     ''),
('youtube_url',      ''),
('footer_risk_text', 'Trading forex and CFDs carries a high level of risk and may not be suitable for all investors. You could lose some or all of your invested capital. Past performance is not indicative of future results. Trader Gulf does not provide financial advice.'),
('google_analytics', ''),
('gsc_verification', ''),
('og_image',         ''),
('indexnow_key',     ''),
('robots_txt',       'User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /admin/*');
