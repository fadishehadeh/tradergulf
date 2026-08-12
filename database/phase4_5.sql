-- Phase 4+5: Arabic, Engagement tools, Legal pages, Islamic hub, MENA GEO
SET NAMES utf8mb4;

-- Newsletter subscribers
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(255) NOT NULL,
    name       VARCHAR(150) DEFAULT NULL,
    is_active  TINYINT(1) NOT NULL DEFAULT 1,
    source     VARCHAR(80) DEFAULT 'footer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact form submissions
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(150) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    subject    VARCHAR(255) DEFAULT '',
    message    TEXT NOT NULL,
    ip         VARCHAR(45) DEFAULT NULL,
    is_read    TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- New settings keys
INSERT IGNORE INTO settings (key_name, value) VALUES
('whatsapp_number', ''),
('newsletter_enabled', '1'),
('team_bio_1', '{"name":"Fadi Shehadeh","role":"Founder & Chief Editor","bio":"10+ years in forex trading and financial analysis. Previously traded prop at a Dubai-based fund.","img":""}'),
('team_bio_2', '{"name":"Sara Al-Mansouri","role":"Senior Broker Analyst","bio":"Certified Financial Analyst (CFA) with deep expertise in Gulf-region broker regulation and DFSA compliance.","img":""}'),
('team_bio_3', '{"name":"James Khoury","role":"US Markets Analyst","bio":"Specialist in NFA/CFTC-regulated brokers and US trading legislation. Based in New York.","img":""}');

-- Publish & enrich MENA SEO pages (seed if missing)
INSERT IGNORE INTO seo_pages
    (slug, page_type, h1, intro_html, body_html, broker_ids, faq_json, meta_title, meta_description, is_published)
VALUES

('best-forex-brokers-in-uae',
 'geo',
 'Best Forex Brokers in UAE 2025',
 '<p>Finding the right forex broker in the UAE requires careful consideration of regulation, trading costs, and platform quality. The Dubai Financial Services Authority (DFSA) and the Financial Services Regulatory Authority (FSRA) are the primary regulators overseeing brokers operating in the UAE. Our team has tested and ranked the best forex brokers available to UAE traders in 2025.</p>',
 '<h2>Forex Trading Regulations in the UAE</h2><p>The UAE has one of the most progressive financial regulatory environments in the Middle East. Brokers operating in the DIFC are regulated by the DFSA, while those in Abu Dhabi are overseen by the FSRA. UAE traders may also use internationally regulated brokers from Australia (ASIC), the UK (FCA), and Cyprus (CySEC).</p><h2>What UAE Traders Should Look For</h2><ul><li><strong>Leverage:</strong> International brokers offer up to 1:500 leverage for UAE retail traders</li><li><strong>Islamic Accounts:</strong> Swap-free halal accounts are widely available and important for Muslim traders</li><li><strong>Deposit Methods:</strong> Look for brokers accepting UAE bank transfers, credit cards, and e-wallets</li><li><strong>AED Base Currency:</strong> Reduces currency conversion costs</li><li><strong>Arabic Support:</strong> Customer support in Arabic is a significant advantage</li></ul><h2>Top Considerations for Dubai Traders</h2><p>Dubai is the financial capital of the UAE and home to thousands of active forex traders. The city''s cosmopolitan nature means most brokers offer English and Arabic support. Gold (XAU/USD) is extremely popular among UAE-based traders given the region''s cultural affinity with precious metals.</p>',
 '[1,2,3,4,5,6]',
 '[{"q":"Is forex trading legal in UAE?","a":"Yes, forex trading is legal in the UAE. It is regulated by the DFSA (Dubai Financial Services Authority) for brokers in DIFC, and FSRA for those in Abu Dhabi Global Market. UAE residents may also use international brokers regulated in other jurisdictions."},{"q":"What is the best forex broker for UAE traders?","a":"The best forex brokers for UAE traders include Exness, IC Markets, Pepperstone, and XM. These brokers offer Islamic accounts, low spreads, and Arabic customer support. Look for brokers with DFSA or FCA regulation."},{"q":"Do forex brokers in UAE offer Islamic accounts?","a":"Yes, most major forex brokers offer Islamic (swap-free) accounts specifically designed for Muslim traders who cannot earn or pay swap/rollover interest as per Sharia law."},{"q":"What leverage is available for UAE forex traders?","a":"UAE traders using international brokers can access leverage up to 1:500 or higher. Brokers regulated under DFSA or FSRA typically offer lower leverage in line with regulatory requirements."},{"q":"Can I trade gold (XAU/USD) with UAE forex brokers?","a":"Yes, gold (XAU/USD) is one of the most popular trading instruments in the UAE and all major forex brokers offer it. Spreads on gold typically range from 0.1 to 0.5 pips on ECN accounts."}]',
 'Best Forex Brokers in UAE 2025 | DFSA Regulated | Trader Gulf',
 'Compare the best forex brokers available to UAE traders in 2025. Islamic accounts, low spreads, AED support. DFSA regulated options included.',
 1),

('best-forex-brokers-in-saudi-arabia',
 'geo',
 'Best Forex Brokers in Saudi Arabia 2025',
 '<p>Forex trading in Saudi Arabia has grown rapidly, with millions of Saudi traders actively participating in global financial markets. The Capital Market Authority (CMA) of Saudi Arabia oversees financial services, though most Saudi traders use internationally regulated brokers. We''ve reviewed the best forex brokers for Saudi traders in 2025.</p>',
 '<h2>Forex Regulation in Saudi Arabia</h2><p>The CMA (Capital Market Authority) regulates financial services in Saudi Arabia. While the CMA does not currently license forex brokers directly, Saudi traders can legally use internationally regulated brokers. The most trusted regulators for Saudi traders are the FCA (UK), ASIC (Australia), and CySEC (Cyprus).</p><h2>Key Features Saudi Traders Need</h2><ul><li><strong>Islamic Accounts:</strong> Essential for Saudi traders — swap-free accounts with no interest charges</li><li><strong>SAR Deposits:</strong> Ability to deposit in Saudi Riyals (SAR) reduces conversion fees</li><li><strong>Arabic Platform:</strong> Full Arabic-language trading platform and support</li><li><strong>High Leverage:</strong> Saudi traders prefer high leverage options up to 1:500</li><li><strong>Local Payment Methods:</strong> Saudi bank transfers, mada card, STC Pay</li></ul><h2>Popular Trading Instruments in Saudi Arabia</h2><p>Saudi traders are particularly active in gold (XAU/USD), crude oil (Brent and WTI), and major forex pairs including USD/SAR, EUR/USD, and GBP/USD. Many Saudi traders also trade in stocks of Aramco and other regional companies.</p>',
 '[1,2,3,4,5,6]',
 '[{"q":"Is forex trading halal in Saudi Arabia?","a":"Conventional forex trading with swap/interest is considered haram in Islam. However, Islamic (swap-free) forex trading accounts are specifically designed to be Sharia-compliant by eliminating rollover interest. Most major brokers offer Islamic accounts for Saudi traders."},{"q":"What is the best forex broker for Saudi traders?","a":"The best forex brokers for Saudi Arabian traders include Exness, XM, Pepperstone, and IC Markets — all offering Islamic accounts, Arabic support, and SAR deposits. Look for FCA or ASIC regulated brokers for maximum security."},{"q":"Is forex trading legal in Saudi Arabia?","a":"Forex trading is not explicitly banned in Saudi Arabia, and thousands of Saudi nationals actively trade forex using internationally regulated brokers. The CMA oversees financial markets but does not currently regulate retail forex brokers directly."},{"q":"Can Saudi traders get an Islamic forex account?","a":"Yes. All major international forex brokers offer Islamic (swap-free) accounts. These accounts do not charge or pay overnight swap rates, making them Sharia-compliant and suitable for Muslim Saudi traders."},{"q":"What leverage is available for Saudi forex traders?","a":"Saudi traders using international brokers typically have access to leverage of 1:200 to 1:500. Brokers regulated by the FCA offer a maximum of 1:30 for retail clients, while brokers regulated in other jurisdictions can offer higher leverage."}]',
 'Best Forex Brokers in Saudi Arabia 2025 | Islamic Accounts | Trader Gulf',
 'Compare the best forex brokers for Saudi Arabian traders. Islamic swap-free accounts, Arabic support, SAR deposits. Reviewed by experts.',
 1),

('best-forex-brokers-in-kuwait',
 'geo',
 'Best Forex Brokers in Kuwait 2025',
 '<p>Kuwait is home to a growing community of active forex traders. With one of the highest GDP per capita in the world, Kuwaiti traders often trade with larger capital bases. The Capital Markets Authority (CMA) of Kuwait oversees financial services. Our experts have identified the best forex brokers for Kuwaiti traders in 2025.</p>',
 '<h2>Forex Regulation in Kuwait</h2><p>Kuwait''s Capital Markets Authority (CMA-Kuwait) regulates financial services domestically. Most Kuwaiti forex traders use internationally regulated brokers — particularly those regulated by the FCA (UK), ASIC (Australia), or CySEC (Cyprus). The Kuwaiti Dinar (KWD) is one of the world''s most valuable currencies.</p><h2>What Kuwaiti Traders Need</h2><ul><li><strong>Islamic Accounts:</strong> Swap-free accounts are essential for Kuwaiti traders</li><li><strong>KWD Currency:</strong> Accounts denominated in Kuwaiti Dinar</li><li><strong>Gold Trading:</strong> Gold is extremely popular in Kuwait</li><li><strong>Arabic Support:</strong> Full Arabic customer service and platform</li><li><strong>High Leverage:</strong> Access to leverage up to 1:500</li></ul>',
 '[1,2,3,4,5,6]',
 '[{"q":"Is forex trading legal in Kuwait?","a":"Forex trading is legal in Kuwait. Kuwaiti traders can use internationally regulated brokers. The Kuwait Capital Markets Authority (CMA-Kuwait) oversees financial markets domestically."},{"q":"What is the best forex broker for Kuwaiti traders?","a":"Top forex brokers for Kuwaiti traders include Exness, IC Markets, Pepperstone, and XM. Look for brokers with Islamic accounts, Arabic support, and FCA or ASIC regulation."},{"q":"Do forex brokers accept KWD deposits?","a":"Most major forex brokers accept USD, EUR, and GBP as base currencies. Some may accept KWD directly. Otherwise, Kuwaiti traders can deposit in USD using bank transfer or international cards."},{"q":"Can Kuwaiti traders get Islamic forex accounts?","a":"Yes. All major forex brokers offer Islamic (swap-free) accounts suitable for Muslim Kuwaiti traders who require Sharia-compliant trading without overnight interest."}]',
 'Best Forex Brokers in Kuwait 2025 | Islamic Accounts | Trader Gulf',
 'Compare the top forex brokers for Kuwaiti traders. Islamic swap-free accounts, Arabic support, KWD-friendly. Expert reviewed.',
 1),

('islamic-forex-brokers',
 'category',
 'Best Islamic Forex Brokers 2025 — Halal Swap-Free Accounts',
 '<p>Islamic forex accounts (also called swap-free accounts) are specifically designed for Muslim traders who follow Sharia law. These accounts eliminate overnight swap/rollover interest charges, making forex trading halal and permissible under Islamic finance principles. Our team has reviewed and ranked the best Islamic forex brokers for 2025.</p>',
 '<h2>What is an Islamic Forex Account?</h2><p>An Islamic forex account is a trading account that does not charge or pay overnight swap/rollover interest (known as riba in Arabic). Instead, brokers may charge an administration fee for positions held overnight. These accounts are designed to comply with Islamic finance principles that prohibit earning or paying interest.</p><h2>Is Forex Trading Halal?</h2><p>Forex trading can be considered halal under specific conditions: (1) The trade must be settled immediately (spot trading), (2) No interest (riba) is involved — this is addressed by Islamic swap-free accounts, (3) The trade must not be based on speculation alone (gharar). Many Islamic scholars have permitted forex trading on the condition that it is done through a swap-free account.</p><h2>Key Features of Islamic Forex Accounts</h2><ul><li><strong>No Swap/Rollover Fees:</strong> No overnight interest charges</li><li><strong>Immediate Settlement:</strong> Trades are settled on a spot basis</li><li><strong>No Hidden Riba:</strong> All interest-based charges are removed</li><li><strong>Full Platform Access:</strong> Same MT4/MT5 access as standard accounts</li><li><strong>Transparent Fees:</strong> Some brokers charge a fixed administration fee instead of swap</li></ul><h2>How to Open an Islamic Forex Account</h2><p>Most major forex brokers offer Islamic accounts as a simple account option during registration, or you can request the conversion of an existing account. You may need to provide documentation confirming your Muslim faith. The process is usually completed within 24-48 hours.</p>',
 '[1,2,3,4,5,6]',
 '[{"q":"What is an Islamic forex account?","a":"An Islamic forex account, also called a swap-free account, is a trading account that does not charge or pay overnight swap/rollover interest. It is designed for Muslim traders who follow Sharia law, which prohibits earning or paying interest (riba)."},{"q":"Is forex trading halal or haram?","a":"Forex trading can be halal if done through a swap-free Islamic account that eliminates interest charges. Many Islamic scholars permit spot forex trading when it is free from riba (interest) and excessive gharar (uncertainty). Using a standard account with overnight swap fees is generally considered haram."},{"q":"Which forex brokers offer the best Islamic accounts?","a":"The best Islamic forex accounts are offered by Exness, IC Markets, Pepperstone, XM, AvaTrade, and FP Markets. All of these brokers offer genuine swap-free Islamic accounts with no hidden interest charges and competitive spreads."},{"q":"Do Islamic accounts have higher spreads?","a":"Some brokers charge wider spreads or a fixed administration fee on Islamic accounts to compensate for the removal of swap fees. However, the best Islamic account brokers like Exness and IC Markets offer competitive spreads comparable to their standard accounts."},{"q":"How do I open an Islamic forex account?","a":"To open an Islamic forex account, choose a broker that offers swap-free accounts (most major brokers do), select the Islamic account option during registration, and provide any required documentation. You can also convert an existing account to Islamic status by contacting your broker."},{"q":"Are Islamic forex accounts available in UAE, Saudi Arabia, and Kuwait?","a":"Yes. All major international forex brokers offer Islamic accounts for traders in the UAE, Saudi Arabia, Kuwait, Qatar, Bahrain, and all other Gulf and MENA countries. These accounts are specifically popular in the Gulf region."}]',
 'Best Islamic Forex Brokers 2025 | Halal Swap-Free Accounts | Trader Gulf',
 'Compare the best Islamic forex brokers offering halal swap-free accounts. No riba, no interest. Suitable for UAE, Saudi Arabia, Kuwait traders.',
 1);
