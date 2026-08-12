USE tradergulf;

-- -------------------------------------------------------
-- Brokers seed data
-- -------------------------------------------------------
INSERT INTO brokers (slug, name, tagline, overall_rating, regulation, founded_year, headquarters, min_deposit, max_leverage, spread_eurusd, spread_type, commission_per_lot, platforms, has_islamic, has_copy_trading, has_demo, base_currencies, deposit_methods, is_featured, sort_order) VALUES

('exness', 'Exness',
 'Ultra-low spreads, instant withdrawals',
 4.8, 'FCA, CySEC, FSCA, FSA', 2008, 'Cyprus',
 1.00, '1:2000', 0.10, 'variable', 0.00,
 'MT4, MT5, Exness Terminal', 1, 0, 1,
 'USD, EUR, GBP, BTC', 'Card, Wire, Skrill, Neteller, Crypto',
 1, 1),

('xm', 'XM',
 'Trusted broker, no requotes',
 4.5, 'ASIC, CySEC, IFSC', 2009, 'Cyprus',
 5.00, '1:888', 0.80, 'variable', 0.00,
 'MT4, MT5', 1, 0, 1,
 'USD, EUR, GBP, AUD', 'Card, Wire, Skrill, Neteller',
 1, 2),

('ic-markets', 'IC Markets',
 'Raw spreads from 0.0 pips',
 4.7, 'ASIC, CySEC, FSA', 2007, 'Australia',
 200.00, '1:500', 0.02, 'variable', 3.50,
 'MT4, MT5, cTrader', 0, 1, 1,
 'USD, EUR, GBP, AUD', 'Card, Wire, Skrill, Neteller, PayPal',
 1, 3),

('pepperstone', 'Pepperstone',
 'Fast execution for active traders',
 4.7, 'ASIC, FCA, DFSA, CySEC', 2010, 'Australia',
 200.00, '1:500', 0.09, 'variable', 3.50,
 'MT4, MT5, cTrader, TradingView', 1, 1, 1,
 'USD, EUR, GBP, AUD', 'Card, Wire, Skrill, Neteller, PayPal',
 1, 4),

('avatrade', 'AvaTrade',
 'Regulated worldwide, great education',
 4.4, 'Central Bank of Ireland, ASIC, FSA, FSCA', 2006, 'Ireland',
 100.00, '1:400', 0.90, 'fixed', 0.00,
 'MT4, MT5, AvaTradeGO, DupliTrade', 1, 1, 1,
 'USD, EUR, GBP', 'Card, Wire, Skrill, Neteller',
 0, 5),

('fp-markets', 'FP Markets',
 'ECN broker with raw spreads',
 4.5, 'ASIC, CySEC', 2005, 'Australia',
 100.00, '1:500', 0.04, 'variable', 3.00,
 'MT4, MT5, cTrader, IRESS', 0, 0, 1,
 'USD, EUR, GBP, AUD', 'Card, Wire, Skrill, Neteller',
 0, 6);

-- -------------------------------------------------------
-- Broker reviews (basic intro + verdict for now)
-- -------------------------------------------------------
INSERT INTO broker_reviews (broker_id, intro_html, pros, cons, verdict_html, meta_title, meta_description, last_updated) VALUES

(1,
 '<p>Exness is one of the world\'s largest retail forex brokers by trading volume, known for ultra-tight spreads, instant withdrawals, and flexible leverage options. Founded in 2008, it serves millions of traders globally under multiple tier-1 and offshore licences.</p>',
 '["Ultra-low spreads from 0.1 pips","Instant withdrawals 24/7","No minimum deposit on Standard","Regulated by FCA and CySEC","Islamic swap-free accounts available","MT4 and MT5 supported"]',
 '["No US clients","Limited product range outside forex and metals","Customer support quality varies"]',
 '<p>Exness stands out for its transparent trading conditions and lightning-fast withdrawals. It is an excellent choice for cost-conscious traders who prioritise tight spreads and reliable execution.</p>',
 'Exness Review 2025 | Spreads, Fees & Regulation',
 'Comprehensive Exness review covering spreads, fees, regulation, account types, platforms and our verdict. Updated 2025.',
 CURDATE()),

(2,
 '<p>XM Group is a globally recognised forex and CFD broker established in 2009, serving clients in over 190 countries. It is well known for its consistent execution, loyalty programme, and extensive educational resources.</p>',
 '["Regulated by ASIC and CySEC","No requotes policy","Generous bonus programme","Strong educational content","Micro accounts from $5","Islamic accounts available"]',
 '["Spreads slightly wider than ECN alternatives","Higher swap rates on some instruments","No cTrader platform"]',
 '<p>XM is a reliable all-around broker well suited to beginner and intermediate traders. Its no-requotes guarantee and accessible minimum deposit make it easy to get started.</p>',
 'XM Review 2025 | Fees, Platforms & Regulation',
 'In-depth XM review covering trading fees, platforms, account types, regulation and our honest verdict. Updated 2025.',
 CURDATE()),

(3,
 '<p>IC Markets is an Australian ECN broker founded in 2007, widely regarded as one of the best options for traders who want raw spreads and ultra-fast execution. It consistently tops rankings for low-latency trading environments.</p>',
 '["Raw spreads from 0.0 pips","True ECN execution","Low latency servers in NY4 and LD4","Supports MT4, MT5 and cTrader","Copy trading via ZuluTrade and Myfxbook"]',
 '["$200 minimum deposit","Commission on raw spread accounts","Limited educational resources"]',
 '<p>IC Markets is the go-to broker for scalpers, high-frequency traders, and algorithmic traders who need the tightest spreads and fastest execution available in the retail market.</p>',
 'IC Markets Review 2025 | Raw Spreads & ECN Trading',
 'Full IC Markets review: raw spreads, ECN execution, MT4/MT5/cTrader platforms, fees and regulation. Updated 2025.',
 CURDATE()),

(4,
 '<p>Pepperstone is an award-winning Australian broker founded in 2010, offering raw-spread ECN trading across forex, indices, commodities, and shares. It supports more platforms than almost any other broker in the industry.</p>',
 '["Raw Razor spreads from 0.09 pips","MT4, MT5, cTrader and TradingView","Regulated by FCA, ASIC and DFSA","Smart Trader Tools included free","Excellent customer support","Islamic accounts available"]',
 '["$200 minimum deposit","No proprietary mobile app","Limited crypto selection"]',
 '<p>Pepperstone is an outstanding choice for traders of all levels. Its combination of tight spreads, multi-platform support, and strong regulation makes it one of the most well-rounded brokers available globally.</p>',
 'Pepperstone Review 2025 | Spreads, Platforms & Regulation',
 'Detailed Pepperstone review covering Razor spreads, cTrader, MT5, FCA regulation and our rating. Updated 2025.',
 CURDATE()),

(5,
 '<p>AvaTrade is an Irish-regulated forex and CFD broker founded in 2006, licensed in multiple jurisdictions worldwide. It is particularly popular for its fixed spreads, comprehensive platform offering, and strong educational content.</p>',
 '["Regulated in 6+ jurisdictions","Fixed spreads available","AvaTradeGO mobile app","DupliTrade copy trading","Strong educational academy","Islamic accounts available"]',
 '["Inactivity fee after 3 months","Fixed spreads are wider than variable ECN","Limited crypto pairs"]',
 '<p>AvaTrade is a trusted and well-regulated broker particularly suited to traders who prefer the predictability of fixed spreads and want access to a wide range of platforms and educational tools.</p>',
 'AvaTrade Review 2025 | Fixed Spreads, Regulation & Platforms',
 'Complete AvaTrade review: fixed spreads, DupliTrade, AvaTradeGO app, regulation and our verdict. Updated 2025.',
 CURDATE()),

(6,
 '<p>FP Markets is an ASIC and CySEC regulated ECN broker based in Australia, founded in 2005. It offers competitive raw spreads across forex, shares, indices, and commodities, with support for MT4, MT5, cTrader, and the professional IRESS platform.</p>',
 '["Raw spreads from 0.04 pips","ASIC and CySEC regulated","Supports MT4, MT5, cTrader and IRESS","Access to 10,000+ instruments via IRESS","Good execution speeds"]',
 '["No copy trading platform","Limited educational content","IRESS requires a separate account"]',
 '<p>FP Markets is a strong ECN broker for traders who want low-cost access to a wide range of markets. Its IRESS integration makes it particularly appealing for serious share and index traders.</p>',
 'FP Markets Review 2025 | Raw Spreads, ECN & Platforms',
 'FP Markets review covering raw ECN spreads, ASIC regulation, MT4/MT5/cTrader/IRESS platforms and our rating. Updated 2025.',
 CURDATE());

-- -------------------------------------------------------
-- Glossary seed (20 core terms)
-- -------------------------------------------------------
INSERT INTO glossary (term, slug, letter, definition_html) VALUES
('Ask Price', 'ask-price', 'A', '<p>The <strong>ask price</strong> (or offer price) is the lowest price at which a seller is willing to sell an asset. When you buy a currency pair, you pay the ask price. It is always slightly higher than the bid price, with the difference being the spread.</p>'),
('Bid Price', 'bid-price', 'B', '<p>The <strong>bid price</strong> is the highest price a buyer is willing to pay for an asset. When you sell a currency pair, you receive the bid price. It is always slightly lower than the ask price.</p>'),
('CFD', 'cfd', 'C', '<p>A <strong>Contract for Difference (CFD)</strong> is a financial derivative that allows traders to speculate on the price movement of an asset without owning it. You profit (or lose) based on the difference between the entry and exit price, multiplied by your position size.</p>'),
('Demo Account', 'demo-account', 'D', '<p>A <strong>demo account</strong> is a practice trading account funded with virtual money. It allows traders to test strategies, learn platforms, and gain experience without risking real capital. Conditions typically mirror live trading.</p>'),
('ECN', 'ecn', 'E', '<p><strong>Electronic Communications Network (ECN)</strong> is a type of trading model where orders are matched directly with other market participants — banks, institutions, and other traders — rather than being handled internally by the broker. ECN brokers typically offer tighter spreads but charge a commission.</p>'),
('Forex', 'forex', 'F', '<p><strong>Forex</strong> (foreign exchange) is the global decentralised market for trading currencies. It is the largest financial market in the world by volume, operating 24 hours a day, five days a week. Currencies are traded in pairs, such as EUR/USD or GBP/JPY.</p>'),
('Going Long', 'going-long', 'G', '<p><strong>Going long</strong> means buying an asset with the expectation that its price will rise. In forex, if you go long on EUR/USD, you are buying euros and selling dollars, expecting the euro to appreciate against the dollar.</p>'),
('Hedging', 'hedging', 'H', '<p><strong>Hedging</strong> is a risk management strategy that involves opening a position to offset potential losses in another position. For example, a trader might hold a long position on EUR/USD and simultaneously open a short position to limit downside risk.</p>'),
('Islamic Account', 'islamic-account', 'I', '<p>An <strong>Islamic account</strong> (also called a swap-free account) is a trading account that complies with Islamic finance principles (Sharia law), which prohibit the earning or paying of interest (riba). Overnight swap fees are replaced with fixed administration charges or waived entirely.</p>'),
('Leverage', 'leverage', 'L', '<p><strong>Leverage</strong> allows traders to control a larger position with a smaller amount of capital. For example, with 1:100 leverage, a $1,000 deposit can control $100,000 worth of currency. While leverage amplifies profits, it equally amplifies losses.</p>'),
('Lot', 'lot', 'L', '<p>A <strong>lot</strong> is the standard unit of measurement for a trade in forex. A standard lot equals 100,000 units of the base currency. Mini lots are 10,000 units and micro lots are 1,000 units. Lot size directly affects the pip value of a trade.</p>'),
('Margin', 'margin', 'M', '<p><strong>Margin</strong> is the amount of capital required to open and maintain a leveraged position. It acts as a good-faith deposit held by the broker. Margin is expressed as a percentage of the full position size — for example, a 1% margin requirement on a $100,000 position requires $1,000.</p>'),
('MetaTrader 4', 'metatrader-4', 'M', '<p><strong>MetaTrader 4 (MT4)</strong> is the world\'s most popular forex trading platform, developed by MetaQuotes. It offers advanced charting tools, automated trading via Expert Advisors (EAs), and a large community of indicators and scripts. Despite being released in 2005, it remains widely used.</p>'),
('MetaTrader 5', 'metatrader-5', 'M', '<p><strong>MetaTrader 5 (MT5)</strong> is the successor to MT4, offering additional timeframes, more order types, a built-in economic calendar, and support for stock and futures trading in addition to forex. MT5 uses a different MQL5 programming language to MT4.</p>'),
('Pip', 'pip', 'P', '<p>A <strong>pip</strong> (Percentage in Point) is the smallest standard price movement in a currency pair. For most pairs, a pip is 0.0001. For JPY pairs, it is 0.01. Pip value determines how much you earn or lose per pip of movement based on your lot size.</p>'),
('Scalping', 'scalping', 'S', '<p><strong>Scalping</strong> is a short-term trading strategy where traders aim to profit from very small price movements, holding positions for seconds to minutes. Scalpers require low spreads, fast execution, and high leverage. Not all brokers allow scalping.</p>'),
('Spread', 'spread', 'S', '<p>The <strong>spread</strong> is the difference between the bid price and the ask price of a currency pair. It represents the broker\'s primary cost of trading. Spreads can be fixed (constant) or variable (fluctuate with market conditions). Measured in pips.</p>'),
('Stop Loss', 'stop-loss', 'S', '<p>A <strong>stop loss</strong> is a risk management order that automatically closes a position when the price reaches a specified level, limiting your maximum loss on a trade. Setting a stop loss is considered a fundamental part of responsible trading.</p>'),
('Swap', 'swap', 'S', '<p>A <strong>swap</strong> (also called a rollover) is the interest paid or earned for holding a forex position overnight. The rate is based on the interest rate differential between the two currencies in the pair. Swaps can be positive (credited to your account) or negative (deducted).</p>'),
('Take Profit', 'take-profit', 'T', '<p>A <strong>take profit</strong> is an order that automatically closes a position when the price reaches a predetermined profit target. It locks in gains without requiring the trader to monitor the market continuously.</p>');

-- -------------------------------------------------------
-- Basic static pages
-- -------------------------------------------------------
INSERT INTO pages (slug, title, meta_title, meta_description) VALUES
('about', 'About Trader Gulf',
 'About Trader Gulf | Forex Broker Reviews & Comparisons',
 'Trader Gulf provides independent forex broker reviews, comparisons, and educational content for traders globally.'),
('risk-disclaimer', 'Risk Disclaimer',
 'Risk Disclaimer | Trader Gulf',
 'Important risk information for forex and CFD trading. Please read before using Trader Gulf.'),
('privacy-policy', 'Privacy Policy',
 'Privacy Policy | Trader Gulf',
 'How Trader Gulf collects, uses, and protects your personal data.');

-- -------------------------------------------------------
-- Settings
-- -------------------------------------------------------
INSERT INTO settings (key_name, value) VALUES
('site_name', 'Trader Gulf'),
('site_tagline', 'Independent Forex Broker Reviews & Comparisons'),
('meta_description', 'Trader Gulf helps traders globally compare forex brokers, platforms, and trading tools with transparent, independent reviews.'),
('contact_email', 'info@tradergulf.com');
