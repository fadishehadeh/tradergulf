<?php
declare(strict_types=1);

namespace App\Modules\Country;

use App\Core\Controller;
use App\Core\Request;

class CountryController extends Controller
{
    private const COUNTRIES = [
        'uae' => [
            'slug'        => 'uae',
            'name'        => 'UAE',
            'full_name'   => 'United Arab Emirates',
            'currency'    => 'AED (UAE Dirham)',
            'regulators'  => 'DFSA (Dubai), SCA (Securities & Commodities Authority)',
            'flag'        => '🇦🇪',
            'population'  => '9.9 million',
            'intro'       => 'The UAE is the premier forex trading hub of the Middle East, with Dubai firmly established as the region\'s financial capital. The Dubai Financial Services Authority (DFSA) regulates firms within the Dubai International Financial Centre (DIFC), while the Securities and Commodities Authority (SCA) covers mainland UAE operations. Traders in Dubai, Abu Dhabi, Sharjah, and across the Emirates enjoy access to all major internationally regulated brokers including Exness, XM, IC Markets, Pepperstone, and AvaTrade. The UAE\'s zero personal income tax environment, world-class financial infrastructure, and high financial literacy make it one of the fastest-growing retail forex markets globally. Islamic swap-free accounts are universally available, and Arabic-language customer support is standard across all leading platforms. Whether you are a resident expatriate or Emirati national, you can open a trading account with a globally regulated broker within minutes.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in the UAE?', 'a' => 'Yes, forex trading is fully legal in the UAE. It is regulated by the DFSA within the Dubai International Financial Centre (DIFC) and by the Securities and Commodities Authority (SCA) for mainland UAE. Traders are required to use regulated brokers to ensure legal and financial protection.'],
                ['q' => 'Which regulator oversees forex brokers in Dubai?', 'a' => 'The Dubai Financial Services Authority (DFSA) regulates all financial firms operating within the DIFC. The DFSA holds a Category 3C licence framework for OTC derivative brokers. For brokers operating outside the DIFC on the UAE mainland, the Securities and Commodities Authority (SCA) has jurisdiction.'],
                ['q' => 'What is the best forex broker in Dubai?', 'a' => 'The best forex brokers for Dubai traders in 2026 include Exness (zero commission accounts, instant withdrawals), XM (low minimum deposit, Arabic support), IC Markets (ultra-low raw spreads from 0.0 pips), Pepperstone (MT4/MT5/cTrader, FCA regulated), and AvaTrade (regulated across 6 jurisdictions). All are independently reviewed on Trader Gulf.'],
                ['q' => 'Can UAE residents trade with offshore brokers?', 'a' => 'Yes, UAE residents commonly trade with offshore brokers regulated by the FCA (UK), ASIC (Australia), or CySEC (EU). This is widely practised and not prohibited. However, using a DFSA-regulated broker entity provides the strongest local legal protection if a dispute arises.'],
                ['q' => 'What is the minimum deposit to start forex trading in the UAE?', 'a' => 'Minimum deposits vary by broker. Exness allows you to start with as little as $1, XM from $5, and IC Markets from $200. For serious trading, a starting account of $500 to $2,000 is recommended to allow proper position sizing and risk management.'],
                ['q' => 'Is Islamic (swap-free) forex trading available in the UAE?', 'a' => 'Yes. All major brokers offer Islamic swap-free accounts designed for Muslim traders in the UAE and GCC. These accounts eliminate overnight interest (swap) charges in compliance with Sharia principles. Exness, XM, and IC Markets all offer Islamic account options at no extra cost.'],
                ['q' => 'Do I pay tax on forex profits in the UAE?', 'a' => 'The UAE currently imposes no personal income tax on forex trading profits for individual retail traders. This makes the UAE one of the most tax-efficient environments in the world for forex trading. Corporate entities may be subject to the UAE\'s corporate tax introduced in 2023; individual retail traders are not affected.'],
                ['q' => 'Which local payment methods can UAE traders use?', 'a' => 'UAE traders can fund broker accounts via Visa, Mastercard, local UAE bank wire (Emirates NBD, ADCB, FAB), and e-wallets such as Skrill and Neteller. Some brokers also support Apple Pay and Google Pay. AED to USD conversion is typically at competitive interbank rates.'],
            ],
        ],
        'saudi-arabia' => [
            'slug'        => 'saudi-arabia',
            'name'        => 'Saudi Arabia',
            'full_name'   => 'Kingdom of Saudi Arabia',
            'currency'    => 'SAR (Saudi Riyal)',
            'regulators'  => 'CMA (Capital Market Authority)',
            'flag'        => '🇸🇦',
            'population'  => '35 million',
            'intro'       => 'Saudi Arabia is the largest economy in the Arab world and one of the most rapidly growing forex markets in the MENA region. As Vision 2030 transforms the Kingdom\'s financial sector, retail forex trading has expanded significantly, with millions of Saudi traders accessing global currency markets. The Capital Market Authority (CMA) regulates financial services in the Kingdom. Saudi traders have full access to all major internationally regulated brokers - Exness, XM, IC Markets, Pepperstone, and AvaTrade are among the most popular. Islamic swap-free accounts are universally available and essential for the Saudi market, eliminating overnight interest charges in compliance with Sharia law. Arabic-language customer support, SAR-friendly funding methods, and low minimum deposits make forex accessible to traders across Riyadh, Jeddah, Dammam, and the Eastern Province.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Saudi Arabia?', 'a' => 'Forex trading is permitted in Saudi Arabia and regulated by the Capital Market Authority (CMA). Traders are advised to use CMA-regulated or internationally regulated brokers (FCA, ASIC, CySEC) for maximum legal protection. The CMA has issued warnings against unlicensed brokers, so choosing a regulated platform is essential.'],
                ['q' => 'Which is the best forex broker for Saudi traders?', 'a' => 'The top forex brokers for Saudi Arabia in 2026 are Exness (ultra-low spreads, instant SAR withdrawals), XM (low $5 minimum deposit, dedicated Arabic support), IC Markets (raw ECN spreads), Pepperstone (multi-regulated, cTrader available), and AvaTrade (regulated in 6 jurisdictions). All offer Islamic swap-free accounts.'],
                ['q' => 'What is the minimum deposit for forex trading in Saudi Arabia?', 'a' => 'Exness and XM allow you to start trading from as little as $1–$5. IC Markets and Pepperstone require a $200 minimum. For practical trading with proper position sizing and risk management, starting with $500–$1,000 is recommended.'],
                ['q' => 'Do Saudi brokers offer halal trading accounts?', 'a' => 'Yes. Islamic swap-free accounts are standard across all leading international brokers. These accounts eliminate overnight interest (swap) charges, replacing them with no hidden fees in most cases, making them fully compliant with Saudi Islamic finance principles.'],
                ['q' => 'How do Saudi traders deposit money into a forex account?', 'a' => 'Saudi traders can fund accounts via Visa, Mastercard, Saudi bank wire (Al Rajhi Bank, SNB, Riyad Bank), and e-wallets such as Skrill and Neteller. Exness and XM also offer direct SAR deposits with instant processing. Most brokers support Arabic-language payment interfaces.'],
                ['q' => 'Is there a tax on forex profits in Saudi Arabia?', 'a' => 'Individual retail traders in Saudi Arabia are generally not subject to income tax on forex trading profits, as the Kingdom does not impose personal income tax. Zakat obligations may apply to overall wealth; consult a local Islamic finance advisor for guidance relevant to your specific situation.'],
            ],
        ],
        'kuwait' => [
            'slug'        => 'kuwait',
            'name'        => 'Kuwait',
            'full_name'   => 'State of Kuwait',
            'currency'    => 'KWD (Kuwaiti Dinar)',
            'regulators'  => 'CMA Kuwait (Capital Markets Authority)',
            'flag'        => '🇰🇼',
            'population'  => '4.7 million',
            'intro'       => 'Kuwait holds one of the highest per-capita incomes in the world, and its affluent population is increasingly active in global forex markets. The Capital Markets Authority (CMA) of Kuwait provides regulatory oversight for financial services. Kuwaiti traders have access to the full range of internationally regulated brokers, with Exness, XM, IC Markets, and Pepperstone being the most widely used. The Kuwaiti Dinar (KWD) is the world\'s highest-valued currency, so most traders maintain USD-denominated accounts for trading. Islamic swap-free accounts are standard, Arabic support is universally available, and local payment methods including Kuwait Finance House wire transfers are accepted by leading brokers.',
            'faqs'        => [
                ['q' => 'Can I trade forex in Kuwait?', 'a' => 'Yes, forex trading is permitted in Kuwait. The Capital Markets Authority (CMA) regulates the financial sector. Most Kuwaiti traders access global forex markets through internationally regulated brokers - particularly those licensed by the FCA (UK), ASIC (Australia), or CySEC (EU).'],
                ['q' => 'What is the best forex broker for Kuwait?', 'a' => 'The top forex brokers for Kuwaiti traders in 2026 are Exness (instant withdrawals, Islamic accounts), XM (low minimum deposit, Arabic-language support), IC Markets (ECN raw spreads), Pepperstone (multi-regulated), and AvaTrade (regulated in 6 jurisdictions). All are reviewed and compared on Trader Gulf.'],
                ['q' => 'What payment methods can Kuwait traders use?', 'a' => 'Visa, Mastercard, international bank wire (Kuwait Finance House, NBK, Burgan Bank), and e-wallets such as Skrill and Neteller are widely accepted. KNET is supported by some brokers directly. Most traders use USD-denominated accounts given the KWD\'s high value.'],
                ['q' => 'Are there Islamic forex accounts in Kuwait?', 'a' => 'Yes. All major brokers on Trader Gulf offer Islamic swap-free accounts with no overnight interest charges. These are the standard account type for Kuwaiti Muslim traders and come at no additional cost from brokers like Exness, XM, and IC Markets.'],
                ['q' => 'What leverage can I get as a Kuwaiti trader?', 'a' => 'Leverage depends on which broker entity serves your account. Offshore entities (Exness Global, XM Global) typically offer up to 1:500 or higher. FCA or CySEC-regulated entities cap retail leverage at 1:30 for major forex pairs. Choose leverage appropriate to your experience and risk tolerance.'],
                ['q' => 'Is there a minimum amount to start forex trading in Kuwait?', 'a' => 'XM and Exness allow starting with as little as $5–$10. For meaningful position sizing on KWD/USD accounts, a starting balance of $500–$1,000 is more practical. Always calculate your position size relative to your account balance, not just the broker\'s minimum deposit.'],
            ],
        ],
        'qatar' => [
            'slug'        => 'qatar',
            'name'        => 'Qatar',
            'full_name'   => 'State of Qatar',
            'currency'    => 'QAR (Qatari Riyal)',
            'regulators'  => 'QFCRA (Qatar Financial Centre Regulatory Authority)',
            'flag'        => '🇶🇦',
            'population'  => '2.9 million',
            'intro'       => 'Qatar is one of the wealthiest countries in the world by per-capita income, and its rapidly growing financial sector has created a thriving retail forex trading community. The Qatar Financial Centre Regulatory Authority (QFCRA) regulates financial firms operating within the Qatar Financial Centre (QFC). Qatari traders have full access to all major internationally regulated brokers including Exness, XM, IC Markets, Pepperstone, and AvaTrade. Islamic swap-free accounts are universally available, Arabic-language support is standard, and Visa, Mastercard, and bank wire are the primary funding methods. Qatar\'s stable QAR peg to the USD makes currency conversion straightforward for most trading accounts.',
            'faqs'        => [
                ['q' => 'Is forex trading allowed in Qatar?', 'a' => 'Forex trading is permitted in Qatar. The QFCRA regulates financial firms within the Qatar Financial Centre. Most Qatari traders access markets via internationally regulated brokers (FCA, ASIC, CySEC) rather than locally licensed entities, as the selection of QFC-regulated forex brokers is limited.'],
                ['q' => 'What is the best forex broker for Qatar?', 'a' => 'The top forex brokers for Qatari traders in 2026 are Exness (instant withdrawals, Islamic accounts), XM (low $5 minimum deposit, Arabic support), IC Markets (ECN raw spreads from 0.0 pips), Pepperstone (multi-regulated, cTrader), and AvaTrade (regulated in 6 jurisdictions). All are reviewed on Trader Gulf.'],
                ['q' => 'Which brokers accept Qatari traders?', 'a' => 'Most major international brokers accept traders from Qatar, including Exness, XM, IC Markets, Pepperstone, and AvaTrade. Verify account eligibility and check which broker entity will serve your account, as some entities have geographic restrictions.'],
                ['q' => 'Are swap-free accounts available for Qatari Muslims?', 'a' => 'Yes. All major brokers offer Islamic swap-free accounts compliant with Sharia law. These eliminate overnight interest charges and are widely used by Qatari Muslim traders. Exness, XM, and IC Markets all provide Islamic account options at no extra cost.'],
                ['q' => 'Can I fund my forex account from Qatar?', 'a' => 'Yes. Visa, Mastercard, international bank wire (Qatar National Bank, Commercial Bank of Qatar), and e-wallets (Skrill, Neteller) are widely accepted. The QAR is pegged to the USD at 3.64, making USD-denominated accounts simple to fund without significant currency conversion costs.'],
                ['q' => 'Is there tax on forex profits in Qatar?', 'a' => 'Qatar does not impose personal income tax on individual retail forex traders. This makes Qatar one of the most tax-efficient trading environments globally. Corporate entities may be subject to Qatar\'s corporate tax framework; individual retail traders are generally not affected.'],
            ],
        ],
        'bahrain' => [
            'slug'        => 'bahrain',
            'name'        => 'Bahrain',
            'full_name'   => 'Kingdom of Bahrain',
            'currency'    => 'BHD (Bahraini Dinar)',
            'regulators'  => 'CBB (Central Bank of Bahrain)',
            'flag'        => '🇧🇭',
            'population'  => '1.7 million',
            'intro'       => 'Bahrain is one of the Gulf\'s oldest and most established financial centres, with a regulatory framework overseen by the Central Bank of Bahrain (CBB). Its long history of openness to international financial services makes it a welcoming environment for retail forex traders. Bahraini traders have access to all leading internationally regulated brokers including Exness, XM, IC Markets, Pepperstone, and AvaTrade. The Bahraini Dinar (BHD) is the second-highest valued currency in the world, and most traders maintain USD-denominated accounts. Islamic swap-free accounts are standard, reflecting Bahrain\'s status as a global hub for Islamic banking and finance.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Bahrain?', 'a' => 'Yes. Forex trading is legal and regulated in Bahrain. The Central Bank of Bahrain (CBB) oversees financial services and licenses investment firms. Bahraini traders may use CBB-licensed or internationally regulated brokers (FCA, ASIC, CySEC) for full legal protection.'],
                ['q' => 'What is the best forex broker for Bahrain traders?', 'a' => 'The top forex brokers for Bahraini traders in 2026 are Exness (instant BHD-to-USD withdrawals), XM (low minimum deposit, Arabic support), IC Markets (ultra-low ECN spreads), Pepperstone (multi-regulated), and AvaTrade (6 regulatory jurisdictions). All are independently reviewed on Trader Gulf.'],
                ['q' => 'What is the minimum deposit to trade forex in Bahrain?', 'a' => 'Exness and XM allow starting with as little as $1–$5. IC Markets and Pepperstone require $200. For practical trading with proper risk management, a starting balance of $500–$1,000 is recommended. Most brokers accept BHD-to-USD bank wire from Bahraini banks.'],
                ['q' => 'Do Bahrain brokers offer Islamic accounts?', 'a' => 'Yes. All top-tier international brokers offer Islamic swap-free accounts compliant with Islamic finance principles. Given Bahrain\'s prominence as an Islamic banking hub, these accounts are in high demand and universally supported by Exness, XM, IC Markets, and Pepperstone.'],
                ['q' => 'How do I deposit funds from Bahrain?', 'a' => 'Visa, Mastercard, bank wire (BBK, Ahli United Bank, Bank of Bahrain and Kuwait), Skrill, and Neteller are widely accepted. USD-denominated accounts are standard. Processing times are typically instant for cards and e-wallets, and 1–3 business days for bank transfers.'],
                ['q' => 'Is there tax on forex profits in Bahrain?', 'a' => 'Bahrain imposes no personal income tax, making forex profits for individual retail traders tax-free. There is no capital gains tax either. This makes Bahrain one of the most tax-friendly trading environments in the GCC, alongside Qatar and the UAE.'],
            ],
        ],
        'oman' => [
            'slug'        => 'oman',
            'name'        => 'Oman',
            'full_name'   => 'Sultanate of Oman',
            'currency'    => 'OMR (Omani Rial)',
            'regulators'  => 'CMA Oman (Capital Market Authority)',
            'flag'        => '🇴🇲',
            'population'  => '4.7 million',
            'intro'       => 'Oman\'s Capital Market Authority (CMA) provides regulatory oversight for financial services across the Sultanate, and interest in forex trading has grown steadily as digital banking and financial literacy have improved. Omani traders have full access to all leading internationally regulated brokers including Exness, XM, IC Markets, Pepperstone, and AvaTrade. The Omani Rial (OMR) is pegged to the USD, making currency conversion to trading accounts simple and cost-effective. Islamic swap-free accounts are universally available, and Arabic-language customer support is standard across all major platforms serving the MENA region.',
            'faqs'        => [
                ['q' => 'Can I trade forex in Oman?', 'a' => 'Yes. Forex trading is permitted in Oman under the oversight of the Capital Market Authority (CMA). Most Omani traders use internationally regulated brokers (FCA, ASIC, CySEC) rather than locally licensed entities, as the local forex broker market is limited.'],
                ['q' => 'What is the best forex broker for Oman?', 'a' => 'The top forex brokers for Omani traders in 2026 are Exness (instant OMR-to-USD withdrawals), XM (low $5 minimum, Arabic support), IC Markets (ECN raw spreads), Pepperstone (multi-regulated), and AvaTrade. All offer Islamic swap-free accounts and are reviewed on Trader Gulf.'],
                ['q' => 'Which payment methods work for Omani traders?', 'a' => 'Visa, Mastercard, international bank wire (Bank Muscat, National Bank of Oman, BankDhofar), and e-wallets (Skrill, Neteller) are the most widely accepted. The OMR is pegged to the USD at 0.385, so USD-denominated trading accounts are simple and cost-efficient for Omani traders.'],
                ['q' => 'Are Islamic forex accounts available in Oman?', 'a' => 'Yes. All leading brokers offer Islamic swap-free accounts. These accounts eliminate overnight interest charges, making them compliant with Islamic finance principles. They are standard practice for Muslim traders throughout Oman and the wider Gulf region.'],
                ['q' => 'What leverage can Omani traders access?', 'a' => 'Leverage depends on the broker entity. Offshore-regulated entities (Exness Global, XM Global) offer up to 1:500 or higher. FCA or CySEC-regulated entities cap retail leverage at 1:30 for major pairs. Choose leverage appropriate to your experience and account size.'],
                ['q' => 'Is there a minimum amount to start forex trading in Oman?', 'a' => 'Exness and XM allow starting from $1–$5. For meaningful position sizing with proper risk management, $500–$1,000 is a more practical starting point. Always calculate lot sizes relative to your account balance and never risk more than 1–2% per trade.'],
            ],
        ],
        'egypt' => [
            'slug'        => 'egypt',
            'name'        => 'Egypt',
            'full_name'   => 'Arab Republic of Egypt',
            'currency'    => 'EGP (Egyptian Pound)',
            'regulators'  => 'FRA (Financial Regulatory Authority)',
            'flag'        => '🇪🇬',
            'population'  => '104 million',
            'intro'       => 'Egypt is the most populous country in the Arab world, and its large, young, financially active population has driven rapid growth in retail forex trading. The Financial Regulatory Authority (FRA) oversees non-banking financial services in Egypt. Egyptian traders primarily use internationally regulated brokers including Exness, XM, IC Markets, Pepperstone, and AvaTrade, maintaining USD-denominated accounts to hedge against Egyptian Pound volatility. Low minimum deposits, Arabic-language support, and e-wallet funding are the most important criteria for Egyptian traders, who represent one of the largest retail forex audiences in the MENA region.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Egypt?', 'a' => 'Forex trading exists in a regulated environment in Egypt overseen by the Financial Regulatory Authority (FRA). Most Egyptian traders use internationally regulated brokers. The legal landscape for retail forex is complex locally, so using a well-regulated international broker (FCA, ASIC) provides the strongest protection. Consult local legal advice for specific compliance questions.'],
                ['q' => 'What is the best forex broker for Egypt?', 'a' => 'The top forex brokers for Egyptian traders in 2026 are Exness (very low minimum deposit, e-wallet withdrawals), XM (from $5 minimum, Arabic interface), IC Markets (ECN spreads), AvaTrade (regulated in 6 jurisdictions), and Pepperstone. All offer Islamic accounts and Arabic support.'],
                ['q' => 'What currency should I use for my trading account in Egypt?', 'a' => 'USD-denominated accounts are strongly recommended for Egyptian traders. This avoids EGP volatility and conversion costs. Most brokers allow funding via international Visa/Mastercard or e-wallets (Skrill, Neteller) from Egypt, bypassing local banking complexity.'],
                ['q' => 'Are there forex brokers that specifically support Egyptian traders?', 'a' => 'Yes. Exness, XM, and AvaTrade actively serve Egyptian clients with Arabic-language interfaces, regional payment options, and low minimum deposits accessible at Egyptian income levels. All three have dedicated Arabic customer support and localized account management.'],
                ['q' => 'Do Egyptian forex brokers offer Islamic accounts?', 'a' => 'Yes. All major international brokers reviewed on Trader Gulf offer Islamic swap-free accounts. These accounts comply with Sharia principles by eliminating overnight interest charges, and are the most commonly used account type by Muslim traders across Egypt.'],
                ['q' => 'How do Egyptian traders fund forex accounts?', 'a' => 'International Visa/Mastercard, Skrill, Neteller, and Perfect Money are the most accessible funding methods. Direct EGP bank wire to brokers is limited - most Egyptian traders convert locally then fund via card or e-wallet. USD accounts avoid double-conversion fees.'],
            ],
        ],
        'jordan' => [
            'slug'        => 'jordan',
            'name'        => 'Jordan',
            'full_name'   => 'Hashemite Kingdom of Jordan',
            'currency'    => 'JOD (Jordanian Dinar)',
            'regulators'  => 'JSC (Jordan Securities Commission)',
            'flag'        => '🇯🇴',
            'population'  => '10.8 million',
            'intro'       => 'Jordan has a well-educated, financially literate population with strong interest in global forex markets. The Jordan Securities Commission (JSC) regulates financial services across the Kingdom, though most retail traders access forex through internationally regulated brokers due to the limited local forex broker market. Popular choices among Jordanian traders include Exness, XM, IC Markets, Pepperstone, and AvaTrade - all offering Arabic-language support, Islamic swap-free accounts, and Visa/Mastercard funding. Amman\'s growing fintech sector and high smartphone penetration make mobile trading particularly popular, with MT4 and MT5 apps being the dominant platforms.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Jordan?', 'a' => 'Forex trading is permitted in Jordan under the oversight of the Jordan Securities Commission (JSC). Most Jordanian traders use internationally regulated brokers (FCA, ASIC, CySEC), as locally JSC-licensed forex brokers are limited. Using a well-regulated international broker provides strong legal and financial protection.'],
                ['q' => 'Which forex brokers accept Jordanian traders?', 'a' => 'Most leading international brokers accept Jordanian clients, including Exness, XM, IC Markets, Pepperstone, and AvaTrade. All offer Arabic-language support, Islamic swap-free accounts, and international payment methods. Verify account eligibility and check which broker entity will serve your account before depositing.'],
                ['q' => 'What is the minimum deposit for forex trading in Jordan?', 'a' => 'Exness allows starting from $1 and XM from $5, making them the most accessible for Jordan-based traders. IC Markets and Pepperstone require $200. For meaningful risk management with standard lot sizes, $500–$1,000 is a more practical starting amount.'],
                ['q' => 'Are Islamic swap-free accounts available in Jordan?', 'a' => 'Yes. All leading brokers offer Islamic swap-free accounts eliminating overnight interest charges in compliance with Sharia principles. These accounts are in high demand among Jordanian Muslim traders and are offered by Exness, XM, IC Markets, and Pepperstone at no additional cost.'],
                ['q' => 'How can Jordanian traders fund their accounts?', 'a' => 'Visa, Mastercard, international bank wire (Arab Bank, Jordan Ahli Bank, Housing Bank), and e-wallets (Skrill, Neteller) are widely accepted. Some brokers accept JOD-denominated deposits, though USD-denominated accounts are more common and avoid conversion costs.'],
                ['q' => 'What leverage is available for Jordanian traders?', 'a' => 'Leverage varies by broker entity. Offshore-regulated entities offer up to 1:500 or higher. FCA or CySEC-regulated entities cap retail leverage at 1:30 for major pairs. Choose leverage that reflects your experience level - high leverage amplifies both profits and losses equally.'],
            ],
        ],
        'iraq' => [
            'slug'        => 'iraq',
            'name'        => 'Iraq',
            'full_name'   => 'Republic of Iraq',
            'currency'    => 'IQD (Iraqi Dinar)',
            'regulators'  => 'ISC (Iraq Securities Commission), CBI (Central Bank of Iraq)',
            'flag'        => '🇮🇶',
            'population'  => '42 million',
            'intro'       => 'Iraq is one of the largest Arab countries by population, and retail forex trading has grown significantly as internet infrastructure has expanded and financial awareness has increased. The Iraq Securities Commission (ISC) and Central Bank of Iraq (CBI) oversee financial services. Iraqi traders access global forex markets through internationally regulated brokers - Exness, XM, and AvaTrade are among the most widely used, offering Arabic-language platforms, Islamic swap-free accounts, and USD-denominated trading. USD accounts are strongly recommended for Iraqi traders, avoiding IQD conversion complexity and providing stability in an economy where the dollar is effectively a parallel currency.',
            'faqs'        => [
                ['q' => 'Can I trade forex in Iraq?', 'a' => 'Forex trading is practised by many Iraqi residents through internationally regulated brokers. The ISC and Central Bank of Iraq (CBI) oversee financial services. Using a reputable internationally regulated broker (FCA, ASIC) is strongly recommended for security and reliability. Local forex regulation is developing but internationally regulated brokers offer proven protection.'],
                ['q' => 'Which brokers work best for Iraqi traders?', 'a' => 'Brokers with low minimum deposits, Arabic-language support, and reliable USD-denominated accounts are best suited for Iraqi traders. Exness, XM, and AvaTrade are among the most widely used. IC Markets and Pepperstone are also available. Verify deposit and withdrawal options before opening an account.'],
                ['q' => 'What is the best way to deposit to a forex account from Iraq?', 'a' => 'International bank wire, Visa/Mastercard, and e-wallets (Skrill, Neteller) are the most accessible options. USD-denominated accounts are strongly recommended to avoid IQD conversion complexity. Perfect Money and other alternative payment methods are accepted by some brokers serving Iraqi clients.'],
                ['q' => 'Are Islamic forex accounts available in Iraq?', 'a' => 'Yes. Islamic swap-free accounts are offered by all major brokers reviewed on Trader Gulf. These accounts are essential for Muslim Iraqi traders as they eliminate overnight interest (swap) charges in compliance with Sharia principles. Available from Exness, XM, IC Markets, and AvaTrade.'],
                ['q' => 'Should I use a USD or IQD account for forex trading in Iraq?', 'a' => 'USD-denominated accounts are strongly recommended for Iraqi traders. The US Dollar is effectively a parallel currency in Iraq and most international brokers operate in USD. This avoids IQD conversion costs, simplifies margin calculations, and provides a more stable account currency.'],
                ['q' => 'What is the minimum deposit for forex trading in Iraq?', 'a' => 'Exness and XM allow starting from $1–$5, making them the most accessible for Iraqi traders. For practical trading with proper position sizing and stop-loss management, a starting balance of $200–$500 is more realistic for meaningful trading activity.'],
            ],
        ],
        'morocco' => [
            'slug'        => 'morocco',
            'name'        => 'Morocco',
            'full_name'   => 'Kingdom of Morocco',
            'currency'    => 'MAD (Moroccan Dirham)',
            'regulators'  => 'AMMC (Autorite Marocaine du Marche des Capitaux)',
            'flag'        => '🇲🇦',
            'population'  => '37 million',
            'intro'       => 'Morocco is one of Africa\'s most financially developed nations, with a sophisticated regulatory framework overseen by the AMMC (Autorite Marocaine du Marche des Capitaux). Moroccan traders have increasingly turned to international forex and CFD markets, attracted by the opportunity to diversify away from MAD-denominated assets. Exness, XM, and AvaTrade are the most popular brokers among Moroccan traders, offering both Arabic and French-language support - critical for Morocco\'s bilingual financial community. Foreign exchange controls apply to the Moroccan Dirham, so most traders fund accounts via international Visa/Mastercard, Skrill, or Neteller rather than direct bank wire.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Morocco?', 'a' => 'Forex trading exists in a regulated environment in Morocco overseen by the AMMC. Direct retail forex trading with foreign brokers is subject to foreign exchange controls on the MAD. Most traders access markets via internationally regulated platforms. It is advisable to use a reputable internationally regulated broker and be aware of Morocco\'s foreign exchange regulations.'],
                ['q' => 'What brokers are best for Moroccan traders?', 'a' => 'Brokers offering French-language or Arabic support, low minimum deposits, and e-wallet funding perform best in Morocco. Exness, XM, and AvaTrade are the most popular among Moroccan traders. IC Markets and Pepperstone are also available. USD-denominated accounts are standard.'],
                ['q' => 'How do Moroccan traders fund forex accounts?', 'a' => 'Visa, Mastercard, Skrill, and Neteller are the primary funding methods. Direct MAD bank wire to international brokers is limited due to foreign exchange controls. Most Moroccan traders use international cards or e-wallets funded from CIH Bank, Attijariwafa, or Banque Populaire accounts.'],
                ['q' => 'Can Moroccan Muslims use Islamic accounts?', 'a' => 'Yes. All leading international brokers offer Islamic swap-free accounts. These accounts comply with Sharia law by eliminating overnight interest charges. They are popular among Morocco\'s Muslim majority and are offered at no extra cost by Exness, XM, and AvaTrade.'],
                ['q' => 'Do brokers offer French-language support for Moroccan traders?', 'a' => 'Yes. AvaTrade, XM, and Exness all offer French-language customer support and trading platforms. This is important for Morocco\'s francophone trading community. Arabic support is also available from all major brokers serving the MENA region.'],
                ['q' => 'What is the minimum deposit for forex trading in Morocco?', 'a' => 'Exness and XM allow starting from $1–$5, making them highly accessible for Moroccan traders. AvaTrade requires $100. For effective risk management and proper position sizing, a starting balance of $200–$500 is recommended. Fund via international Visa/Mastercard to avoid MAD conversion issues.'],
            ],
        ],
        'turkey' => [
            'slug'        => 'turkey',
            'name'        => 'Turkey',
            'full_name'   => 'Republic of Turkey',
            'currency'    => 'TRY (Turkish Lira)',
            'regulators'  => 'SPK/CMB (Capital Markets Board of Turkey)',
            'flag'        => '🇹🇷',
            'population'  => '85 million',
            'intro'       => 'Turkey sits at the crossroads of Europe and the Middle East, with one of the region\'s most active and sophisticated retail forex markets. The Capital Markets Board (SPK/CMB) regulates the Turkish financial sector. Turkish traders are highly experienced, with strong demand for low spreads, multiple asset classes, and both Turkish and Arabic-language support. Exness, XM, Pepperstone, AvaTrade, and IC Markets are widely used. CMB-regulated Turkish brokers cap retail leverage at 1:10 for major pairs, leading many traders to use internationally regulated offshore entities for higher leverage up to 1:500.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Turkey?', 'a' => 'Yes, forex trading is legal and regulated in Turkey by the Capital Markets Board (SPK/CMB). Licensed Turkish entities operate under strict leverage and margin rules. Many Turkish traders also use internationally regulated offshore brokers (FCA, ASIC) for higher leverage and a wider range of instruments.'],
                ['q' => 'What leverage can Turkish traders access?', 'a' => 'CMB-regulated Turkish entities cap leverage at 1:10 for major currency pairs - one of the strictest in the world. However, many Turkish traders access international brokers offering up to 1:500 leverage via offshore entities. Always understand that higher leverage amplifies losses as well as gains.'],
                ['q' => 'Which are the best forex brokers for Turkey?', 'a' => 'XM, Exness, Pepperstone, and AvaTrade are among the most popular internationally regulated brokers for Turkish traders. For CMB-licensed local brokers, GCM Forex and Integral Forex are established names. International brokers offer more instruments, higher leverage, and often better spreads than locally-regulated entities.'],
                ['q' => 'Is MetaTrader 4 available for Turkish traders?', 'a' => 'Yes. MetaTrader 4 and MetaTrader 5 are widely available in Turkey. XM, Exness, IC Markets, and Pepperstone all offer MT4 and MT5 with full Turkish-language interfaces. cTrader is also popular among Turkish algorithmic traders for its advanced order types.'],
                ['q' => 'Can Turkish traders use Lira (TRY) accounts?', 'a' => 'Some brokers offer TRY-denominated accounts, but USD-denominated accounts are more common and avoid TRY volatility risk on your account balance. Given the Turkish Lira\'s historical volatility, many traders prefer to hold account balances in USD or EUR as a natural hedge.'],
                ['q' => 'How do Turkish traders fund forex accounts?', 'a' => 'Visa, Mastercard, Papara, local Turkish bank wire (Garanti BBVA, Is Bankasi, Ziraat), and e-wallets (Skrill, Neteller) are widely accepted. Papara and local bank transfers are particularly popular for TRY-to-USD conversion. Processing is typically instant for cards and same-day for Papara.'],
            ],
        ],
        'lebanon' => [
            'slug'        => 'lebanon',
            'name'        => 'Lebanon',
            'full_name'   => 'Lebanese Republic',
            'currency'    => 'USD (primarily) / LBP (Lebanese Pound)',
            'regulators'  => 'CMA (Capital Markets Authority Lebanon)',
            'flag'        => '🇱🇧',
            'population'  => '5 million (plus ~14 million diaspora)',
            'intro'       => 'Lebanon has a long tradition of financial sophistication, and despite significant economic challenges since 2019, forex trading remains highly popular among Lebanese residents and diaspora worldwide. The Capital Markets Authority (CMA) oversees Lebanon\'s financial sector. Lebanese traders operate almost exclusively in USD - the de facto currency for most transactions - making international forex brokers a natural fit. Exness, XM, and AvaTrade are the most widely used platforms, valued for their e-wallet funding options, low minimum deposits, and Arabic-language support. Given local banking restrictions, Skrill, Neteller, and international prepaid cards are the primary account funding methods.',
            'faqs'        => [
                ['q' => 'Can Lebanese residents trade forex?', 'a' => 'Yes. Lebanese residents can access international forex brokers through online platforms. The Capital Markets Authority (CMA) Lebanon oversees the financial sector. Given local banking restrictions since 2019, most traders use international e-wallets and prepaid cards rather than Lebanese bank accounts to fund brokers.'],
                ['q' => 'What is the best forex broker for Lebanese traders?', 'a' => 'The best forex brokers for Lebanese traders are Exness (instant e-wallet withdrawals, no minimum withdrawal), XM (low $5 minimum, Arabic support), and AvaTrade (6 regulatory jurisdictions, WebTrader available). All accept Skrill and Neteller deposits, which are essential for Lebanese traders given local banking constraints.'],
                ['q' => 'What is the best way to fund a forex account from Lebanon?', 'a' => 'Skrill, Neteller, and international Visa/Mastercard prepaid cards are the most accessible funding methods for Lebanese traders. USD-denominated accounts are essential. Some brokers also accept cryptocurrency (USDT, Bitcoin) deposits - check broker-specific options. Local LBP bank wire to international brokers is not practical.'],
                ['q' => 'Are there Islamic forex accounts for Lebanese Muslims?', 'a' => 'Yes. All major international brokers offer Islamic swap-free accounts eliminating overnight interest charges. These are available to Lebanese traders regardless of their funding method or location, and comply with Sharia principles.'],
                ['q' => 'Which brokers are most accessible for Lebanese traders?', 'a' => 'Brokers with e-wallet funding (Skrill, Neteller), low minimum deposits, and Arabic-language support are best for Lebanese traders. Exness and XM are the most accessible. Both accept multiple e-wallet options and process withdrawals quickly - critical given Lebanese banking constraints.'],
                ['q' => 'Should Lebanese traders use USD accounts?', 'a' => 'Yes, USD accounts are essential for Lebanese traders. The Lebanese Pound (LBP) has lost over 95% of its value since 2019. Holding account balances in USD protects trading capital from LBP devaluation. All major brokers offer USD-denominated accounts as the standard option.'],
            ],
        ],
    ];

    public function show(Request $request, string $country): void
    {
        $countrySlug = $country;
        $country = self::COUNTRIES[$countrySlug] ?? null;
        if (!$country) $this->notFound();

        $brokers = $this->db()->fetchAll(
            'SELECT * FROM brokers WHERE is_active = 1 ORDER BY is_featured DESC, overall_rating DESC, sort_order ASC'
        );

        $pageUrl   = url('forex-brokers-in/' . $country['slug']);
        $year      = date('Y');
        $pageTitle = 'Best Forex Brokers in ' . $country['full_name'] . ' ' . $year . ' | Trader Gulf';
        $metaDesc  = 'Compare the top regulated forex brokers for ' . $country['name'] . ' traders in ' . $year . '. '
            . 'Regulated brokers, Islamic swap-free accounts, Arabic support. Independent reviews updated ' . $year . '.';

        $faqSchema = null;
        if (!empty($country['faqs'])) {
            $faqSchema = json_encode([
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => array_map(fn($f) => [
                    '@type'          => 'Question',
                    'name'           => $f['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
                ], $country['faqs']),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        $bSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url()],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Brokers by Country', 'item' => url('brokers')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $country['name'], 'item' => $pageUrl],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $itemListSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => 'Best Forex Brokers in ' . $country['full_name'] . ' ' . date('Y'),
            'description'     => $country['intro'],
            'url'             => $pageUrl,
            'numberOfItems'   => count($brokers),
            'itemListElement' => array_values(array_map(fn($b, $i) => [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $b['name'],
                'url'      => url('brokers/' . $b['slug']),
            ], $brokers, array_keys($brokers))),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $schemas = "<script type=\"application/ld+json\">$bSchema</script>";
        if ($faqSchema) {
            $schemas .= "<script type=\"application/ld+json\">$faqSchema</script>";
        }
        $schemas .= "<script type=\"application/ld+json\">$itemListSchema</script>";

        $this->render('country/show', [
            'title'       => $pageTitle,
            'metaDesc'    => $metaDesc,
            'canonical'   => $pageUrl,
            'headSchemas' => $schemas,
            'country'     => $country,
            'brokers'     => $brokers,
        ]);
    }
}
