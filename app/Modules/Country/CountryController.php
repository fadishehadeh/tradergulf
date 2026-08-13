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
            'intro'       => 'The UAE is the premier forex trading hub of the Middle East. With a well-established regulatory framework overseen by the Dubai Financial Services Authority (DFSA) and the Securities and Commodities Authority (SCA), traders in Dubai and Abu Dhabi enjoy access to a broad range of internationally regulated brokers. The UAE\'s zero-income-tax environment and high financial literacy make it one of the fastest-growing retail forex markets globally.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in the UAE?', 'a' => 'Yes, forex trading is fully legal in the UAE. It is regulated by the DFSA within the DIFC and by the SCA for mainland operations. Traders must use regulated brokers to ensure legal protection.'],
                ['q' => 'Which regulator oversees forex brokers in Dubai?', 'a' => 'The Dubai Financial Services Authority (DFSA) regulates financial firms operating within the Dubai International Financial Centre (DIFC). For brokers outside the DIFC, the Securities and Commodities Authority (SCA) has jurisdiction.'],
                ['q' => 'Can UAE residents trade with offshore brokers?', 'a' => 'Yes, UAE residents commonly trade with offshore brokers regulated by the FCA, ASIC, or CySEC. While this is not explicitly prohibited, using a DFSA-regulated broker provides the strongest local legal protection.'],
                ['q' => 'Is Islamic (swap-free) forex trading available in the UAE?', 'a' => 'Yes. Most major brokers offer Islamic swap-free accounts specifically designed for Muslim traders. These accounts comply with Sharia principles by eliminating overnight interest charges.'],
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
            'intro'       => 'Saudi Arabia is the largest economy in the Arab world, and its forex market is growing rapidly as Vision 2030 drives financial sector development. The Capital Market Authority (CMA) regulates financial services in the Kingdom. Saudi traders have access to all major international brokers, and Islamic swap-free accounts are universally available, in line with the country\'s financial principles.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Saudi Arabia?', 'a' => 'Forex trading is permitted in Saudi Arabia but is regulated by the Capital Market Authority (CMA). Traders are advised to use CMA-regulated or internationally regulated brokers such as those licensed by the FCA or ASIC.'],
                ['q' => 'Which forex broker is best for Saudi traders?', 'a' => 'Brokers with Islamic account options and Arabic-language support, such as Exness, XM, and Pepperstone, are popular among Saudi traders. Look for brokers with multiple regulatory licences and proven MENA track records.'],
                ['q' => 'What is the minimum deposit for forex trading in Saudi Arabia?', 'a' => 'Minimum deposits vary by broker. Exness and XM both offer accounts from as little as $1–$5. Most professional-tier accounts require $200–$500. Payments via Visa, Mastercard, and bank transfer are standard.'],
                ['q' => 'Do Saudi brokers offer halal trading accounts?', 'a' => 'Yes. Islamic swap-free accounts are standard across all leading international brokers. These accounts do not charge overnight interest, making them compliant with Islamic finance principles.'],
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
            'intro'       => 'Kuwait holds one of the highest per-capita incomes in the world, making its residents well-positioned to participate in global forex markets. The Capital Markets Authority (CMA) of Kuwait provides oversight for financial services. Kuwaiti traders have access to leading international brokers offering Islamic accounts, Arabic support, and local payment methods.',
            'faqs'        => [
                ['q' => 'Can I trade forex in Kuwait?', 'a' => 'Yes, forex trading is permitted in Kuwait. The Capital Markets Authority (CMA) regulates the financial sector. Most Kuwaiti traders access markets through internationally regulated brokers rather than locally licensed ones.'],
                ['q' => 'What payment methods can Kuwait traders use?', 'a' => 'Visa, Mastercard, bank wire transfer, and e-wallets such as Skrill and Neteller are widely accepted. KNET and local bank transfers may also be available depending on the broker.'],
                ['q' => 'Are there Islamic forex accounts in Kuwait?', 'a' => 'Yes. All major brokers reviewed on Trader Gulf offer Islamic swap-free accounts with no overnight interest charges. These are commonly used by Kuwaiti traders.'],
                ['q' => 'What leverage can I get as a Kuwaiti trader?', 'a' => 'Leverage depends on the broker entity serving your account. Offshore entities may offer up to 1:500 or 1:2000. Regulated entities under FCA or CySEC cap retail leverage at 1:30.'],
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
            'intro'       => 'Qatar\'s rapid economic expansion and high household wealth have created a growing class of retail forex traders. The Qatar Financial Centre Regulatory Authority (QFCRA) oversees financial services within the QFC. Qatari traders commonly access international brokers regulated by the FCA, ASIC, and CySEC, with Islamic swap-free accounts widely available.',
            'faqs'        => [
                ['q' => 'Is forex trading allowed in Qatar?', 'a' => 'Forex trading is permitted in Qatar. The QFCRA regulates firms within the Qatar Financial Centre. Most Qatari traders use internationally regulated brokers such as those licensed by the FCA (UK) or ASIC (Australia).'],
                ['q' => 'Which brokers accept Qatari traders?', 'a' => 'Most leading international brokers accept traders from Qatar, including Exness, XM, IC Markets, and Pepperstone. Verify account eligibility directly with the broker as some entities have geographic restrictions.'],
                ['q' => 'Are swap-free accounts available for Qatari Muslims?', 'a' => 'Yes. Major brokers offer Islamic swap-free accounts that are compliant with Sharia law. These accounts eliminate overnight interest (swap) charges, replacing them with no additional fees in most cases.'],
                ['q' => 'Can I fund my forex account from Qatar?', 'a' => 'Yes. Funding via Visa, Mastercard, Skrill, Neteller, and international bank wire is available. Processing times and availability may vary slightly by broker and local banking regulations.'],
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
            'intro'       => 'Bahrain is one of the Gulf\'s oldest financial centres, with a regulatory framework overseen by the Central Bank of Bahrain (CBB). Its openness to international financial services makes it a welcoming environment for retail forex traders. Bahraini traders benefit from access to internationally regulated brokers, with Arabic-language support and Islamic account options widely available.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Bahrain?', 'a' => 'Yes. Forex trading is legal and regulated in Bahrain. The Central Bank of Bahrain (CBB) oversees financial services. Bahraini traders may use locally licensed or internationally regulated brokers.'],
                ['q' => 'What is the best forex broker for Bahrain traders?', 'a' => 'Brokers with Islamic accounts, Arabic support, and multiple regulatory licences — such as Exness, Pepperstone, and XM — are recommended for Bahraini traders. Compare spreads, minimum deposits, and withdrawal methods.'],
                ['q' => 'Do Bahrain brokers offer Islamic accounts?', 'a' => 'Yes. All top-tier international brokers offer Islamic swap-free accounts compliant with Islamic finance principles. Bahrain\'s Islamic banking heritage means these accounts are in high demand and widely supported.'],
                ['q' => 'How do I deposit funds from Bahrain?', 'a' => 'Visa, Mastercard, bank wire, Skrill, and Neteller are commonly accepted. Processing times are typically instant for cards and e-wallets, with 1–3 days for bank transfers.'],
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
            'intro'       => 'Oman\'s Capital Market Authority (CMA) provides a regulatory framework for financial services across the Sultanate. Omani traders have embraced global forex markets, particularly as digital payment infrastructure has improved. Access to internationally regulated brokers, Islamic accounts, and Arabic-language support makes the market accessible to retail participants.',
            'faqs'        => [
                ['q' => 'Can I trade forex in Oman?', 'a' => 'Yes. Forex trading is permitted in Oman. The Capital Market Authority (CMA) regulates the financial sector. Most traders access markets via internationally regulated brokers rather than Oman-licensed entities.'],
                ['q' => 'Which payment methods work for Omani traders?', 'a' => 'Visa, Mastercard, bank wire, and e-wallets such as Skrill and Neteller are accepted by most brokers. Some local bank transfers may be available depending on your financial institution.'],
                ['q' => 'Are Islamic forex accounts available in Oman?', 'a' => 'Yes. All leading brokers offer Islamic swap-free accounts. These accounts eliminate overnight interest charges, making them suitable for Muslim traders across Oman.'],
                ['q' => 'What leverage is available for Oman traders?', 'a' => 'Leverage varies by broker entity. Offshore-regulated accounts may offer 1:500 or higher. Stricter regulatory entities (FCA, CySEC) cap retail leverage at 1:30 for major pairs.'],
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
            'intro'       => 'Egypt is the most populous country in the Arab world, and its growing middle class has driven increasing interest in forex trading as a means of preserving and growing wealth. The Financial Regulatory Authority (FRA) oversees non-banking financial services. Egyptian traders primarily use internationally regulated brokers, with USD-denominated accounts to hedge against Egyptian Pound volatility.',
            'faqs'        => [
                ['q' => 'Is forex trading legal in Egypt?', 'a' => 'Forex trading exists in a complex regulatory environment in Egypt. The Financial Regulatory Authority (FRA) oversees non-banking financial services. Most Egyptian traders use internationally regulated brokers. It is advisable to consult local legal advice for compliance.'],
                ['q' => 'What currency should I use for my trading account in Egypt?', 'a' => 'Most Egyptian traders opt for USD-denominated accounts to avoid EGP volatility. Funding via international cards (Visa, Mastercard) or e-wallets (Skrill, Neteller) is common.'],
                ['q' => 'Are there forex brokers that specifically support Egyptian traders?', 'a' => 'Yes. Brokers like Exness, XM, and IC Markets actively serve Egyptian clients with Arabic-language support, regional payment methods, and low minimum deposits that are accessible given local income levels.'],
                ['q' => 'Do Egyptian forex brokers offer Islamic accounts?', 'a' => 'Yes. All major international brokers reviewed on Trader Gulf offer Islamic swap-free accounts. These comply with Sharia principles and are popular among Muslim traders in Egypt.'],
            ],
        ],
    ];

    public function show(Request $request, string $country): void
    {
        $countrySlug = $country;
        $country = self::COUNTRIES[$countrySlug] ?? null;
        if (!$country) $this->notFound();

        $brokers = $this->db()->fetchAll(
            'SELECT * FROM brokers WHERE is_active = 1 ORDER BY overall_rating DESC, sort_order ASC'
        );

        $pageUrl   = url('forex-brokers-in/' . $country['slug']);
        $pageTitle = 'Best Forex Brokers in ' . $country['full_name'] . ' 2025 | Trader Gulf';
        $metaDesc  = 'Compare the top regulated forex brokers for ' . $country['name'] . ' traders in 2025. '
            . 'Regulated, Islamic accounts, Arabic support. Unbiased expert reviews.';

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

        $schemas = "<script type=\"application/ld+json\">$bSchema</script>";
        if ($faqSchema) {
            $schemas .= "<script type=\"application/ld+json\">$faqSchema</script>";
        }

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
