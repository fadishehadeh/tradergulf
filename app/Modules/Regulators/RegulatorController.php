<?php
declare(strict_types=1);

namespace App\Modules\Regulators;

use App\Core\Controller;
use App\Core\Request;

class RegulatorController extends Controller
{
    private const REGULATORS = [
        'fca' => [
            'slug'        => 'fca',
            'name'        => 'FCA',
            'full_name'   => 'Financial Conduct Authority',
            'country'     => 'United Kingdom',
            'flag'        => '🇬🇧',
            'established' => 2013,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated',
            'compensation'=> 'FSCS up to £85,000',
            'leverage'    => '1:30 (major pairs)',
            'intro'       => 'The Financial Conduct Authority (FCA) is the United Kingdom\'s primary financial services regulator, widely considered the gold standard of global forex regulation. Established in 2013 as the successor to the Financial Services Authority (FSA), the FCA regulates over 50,000 financial firms across the UK. For retail forex traders in the UAE, Saudi Arabia, and the wider Gulf region, an FCA-regulated broker provides the highest level of client protection available - mandatory fund segregation, negative balance protection, and access to the Financial Services Compensation Scheme (FSCS) of up to £85,000 per client. Brokers regulated by the FCA must meet stringent capital adequacy requirements and undergo regular audits. The FCA is a member of IOSCO, the international body for securities regulators.',
            'key_facts'   => [
                'Regulator Type'          => 'Statutory / Independent',
                'Compensation Scheme'     => 'FSCS - up to £85,000 per client',
                'Max Retail Leverage'     => '1:30 major pairs, 1:20 minors, 1:10 commodities',
                'Client Fund Segregation' => 'Required - held separately from firm assets',
                'Negative Balance Protection' => 'Mandatory for retail clients',
                'Bonus Restrictions'      => 'Bonus promotions to retail clients prohibited',
                'Regulatory Register'     => 'FCA Register at register.fca.org.uk',
            ],
            'faqs'        => [
                ['q' => 'What does FCA regulation mean for forex traders?', 'a' => 'FCA regulation means the broker is authorised and supervised by the UK Financial Conduct Authority. Your client funds are held in segregated accounts separate from the broker\'s own money, you have negative balance protection (you cannot lose more than you deposit), and you are eligible for FSCS compensation of up to £85,000 if the broker becomes insolvent. FCA-regulated brokers also cannot use misleading marketing or offer bonuses that incentivise excessive risk.'],
                ['q' => 'Can UAE traders use FCA-regulated brokers?', 'a' => 'Yes. UAE residents can open accounts with FCA-regulated brokers. Many major brokers - including Pepperstone, AvaTrade, and IC Markets - hold FCA licences. However, UAE-based clients may be served by a different entity (e.g. the broker\'s ASIC or offshore entity) depending on the broker\'s account opening process. Always verify which regulatory entity your account falls under.'],
                ['q' => 'Is FCA regulation better than ASIC regulation?', 'a' => 'Both FCA and ASIC are Tier 1 regulators with strict oversight requirements. The key difference is the compensation scheme: the FCA\'s FSCS covers up to £85,000 per client in case of broker insolvency, while ASIC has no equivalent scheme (it relies on AFCA for dispute resolution). For this reason, many traders view FCA regulation as marginally stronger from a client protection standpoint.'],
                ['q' => 'How do I verify if a broker is FCA regulated?', 'a' => 'Visit register.fca.org.uk and search for the broker\'s name or FCA reference number (FRN). An authorised broker will show as "Authorised" with details of the activities it is permitted to carry out. Be cautious of clone firms - always check the FCA register directly rather than relying on documents provided by the broker.'],
            ],
        ],

        'asic' => [
            'slug'        => 'asic',
            'name'        => 'ASIC',
            'full_name'   => 'Australian Securities and Investments Commission',
            'country'     => 'Australia',
            'flag'        => '🇦🇺',
            'established' => 1998,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated',
            'compensation'=> 'No scheme (AFCA dispute resolution)',
            'leverage'    => '1:30 (major pairs)',
            'intro'       => 'The Australian Securities and Investments Commission (ASIC) is Australia\'s corporate and financial services regulator, widely regarded as one of the world\'s top-tier financial regulators alongside the FCA. ASIC-regulated brokers are required to hold client funds in segregated trust accounts, maintain adequate financial resources, and provide retail clients with negative balance protection. In 2021, ASIC introduced stricter leverage limits for retail CFD and forex traders - capping major pair leverage at 1:30, in line with European ESMA rules. ASIC is a popular licensing jurisdiction for internationally recognised brokers serving Gulf and MENA traders, including IC Markets, Pepperstone, and FP Markets, all of which are headquartered in Australia.',
            'key_facts'   => [
                'Regulator Type'          => 'Statutory / Government body',
                'Compensation Scheme'     => 'None - AFCA handles disputes',
                'Max Retail Leverage'     => '1:30 major pairs, 1:20 minors',
                'Client Fund Segregation' => 'Required - trust account holding',
                'Negative Balance Protection' => 'Mandatory for retail clients',
                'Bonus Restrictions'      => 'Inducements that create a conflict of interest prohibited',
                'Regulatory Register'     => 'ASIC Connect at connectonline.asic.gov.au',
            ],
            'faqs'        => [
                ['q' => 'Is ASIC a reliable regulator for forex trading?', 'a' => 'Yes. ASIC is considered a Tier 1 regulator alongside the UK FCA and US NFA. ASIC-regulated brokers must hold client funds in segregated trust accounts, maintain capital adequacy requirements, and provide negative balance protection for retail clients. While ASIC has no compensation scheme equivalent to the UK\'s FSCS, its oversight standards are rigorous and well-enforced.'],
                ['q' => 'Do ASIC regulations apply to Gulf traders?', 'a' => 'ASIC regulations apply to the broker\'s Australian entity. Gulf traders who open accounts under a broker\'s ASIC-regulated entity receive the full protections of Australian financial services law. However, many brokers route non-Australian clients through offshore entities (Seychelles, Vanuatu) - always check which entity will hold your account.'],
                ['q' => 'What leverage does ASIC allow?', 'a' => 'Since October 2021, ASIC caps retail CFD leverage at 1:30 for major currency pairs, 1:20 for minor pairs, 1:10 for commodities and minor indices, and 1:2 for cryptocurrency. Professional client status (meeting asset/income thresholds) allows higher leverage, but professional clients lose negative balance protection.'],
                ['q' => 'How do I verify ASIC registration?', 'a' => 'Search the ASIC Connect database at connectonline.asic.gov.au using the broker\'s name or Australian Financial Services Licence (AFSL) number. A valid ASIC-regulated broker will have an active AFSL authorising it to deal in derivatives and provide general financial advice.'],
            ],
        ],

        'cysec' => [
            'slug'        => 'cysec',
            'name'        => 'CySEC',
            'full_name'   => 'Cyprus Securities and Exchange Commission',
            'country'     => 'Cyprus (EU)',
            'flag'        => '🇨🇾',
            'established' => 2001,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated',
            'compensation'=> 'ICF up to €20,000',
            'leverage'    => '1:30 (major pairs)',
            'intro'       => 'The Cyprus Securities and Exchange Commission (CySEC) is the financial regulatory body of Cyprus and an EU member, meaning CySEC-regulated brokers benefit from EU financial services passporting across all 27 member states. CySEC applies ESMA (European Securities and Markets Authority) rules, which cap retail leverage at 1:30 for major forex pairs and require client fund segregation and negative balance protection. The Investor Compensation Fund (ICF) provides coverage of up to €20,000 per client. Cyprus has become a major hub for forex brokerage operations due to its EU membership, competitive corporate tax rates, and well-established financial services ecosystem. XM, AvaTrade, and Trading 212 are among the brokers with CySEC licences.',
            'key_facts'   => [
                'Regulator Type'          => 'EU statutory regulator',
                'Compensation Scheme'     => 'ICF - up to €20,000 per client',
                'Max Retail Leverage'     => '1:30 major pairs (ESMA rules)',
                'Client Fund Segregation' => 'Required',
                'Negative Balance Protection' => 'Required for retail clients (ESMA)',
                'EU Passport'             => 'Yes - valid across all 27 EU member states',
                'Regulatory Register'     => 'CySEC register at cysec.gov.cy',
            ],
            'faqs'        => [
                ['q' => 'Is CySEC a trusted regulator?', 'a' => 'CySEC is a Tier 2 regulator - well-regulated and EU-compliant, though historically considered less strict than the FCA or ASIC. Since adopting ESMA rules in 2018, CySEC standards have risen significantly: leverage is capped at 1:30, client funds must be segregated, negative balance protection is mandatory, and the ICF compensation scheme covers up to €20,000. For most retail traders, CySEC regulation provides adequate protection.'],
                ['q' => 'How does CySEC compare to FCA regulation?', 'a' => 'Both apply ESMA leverage caps (1:30) and require fund segregation and negative balance protection. The FCA\'s compensation scheme (FSCS, £85,000) is more generous than CySEC\'s ICF (€20,000). The FCA is also generally considered to have more rigorous enforcement. However, CySEC\'s EU passport means a CySEC broker can legally offer services across Europe, which FCA brokers lost post-Brexit.'],
                ['q' => 'Can Gulf traders use CySEC-regulated brokers?', 'a' => 'Yes. Gulf traders can open accounts with CySEC-regulated brokers. XM and AvaTrade both hold CySEC licences and serve Gulf clients. As with all brokers, verify which entity your account is held under - some brokers may route non-EU clients through offshore entities.'],
                ['q' => 'What is the ICF and how does it protect traders?', 'a' => 'The Investor Compensation Fund (ICF) is a Cyprus-based compensation scheme that covers clients of CySEC-regulated investment firms. If a regulated broker becomes insolvent and cannot meet its obligations to clients, the ICF pays compensation of up to €20,000 per client. Claims must be submitted to CySEC after the broker is officially declared unable to meet client obligations.'],
            ],
        ],

        'dfsa' => [
            'slug'        => 'dfsa',
            'name'        => 'DFSA',
            'full_name'   => 'Dubai Financial Services Authority',
            'country'     => 'UAE - Dubai International Financial Centre',
            'flag'        => '🇦🇪',
            'established' => 2004,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Dubai Financial Services Authority (DFSA) is the independent financial regulatory authority of the Dubai International Financial Centre (DIFC) - a special economic zone within Dubai. The DFSA is widely regarded as a Tier 1 regional regulator and one of the most respected financial authorities in the Middle East. Established in 2004, the DFSA regulates banking, insurance, asset management, investment, and financial advisory services within the DIFC. For forex and CFD traders in the UAE, a DFSA-regulated broker provides the strongest local legal protection - client funds are ring-fenced, and the DFSA has enforcement powers to pursue brokers and compensate clients. DFSA-regulated forex brokers are relatively rare; those that hold the licence are typically well-capitalised, institutional-grade firms.',
            'key_facts'   => [
                'Regulator Type'          => 'Independent statutory authority (DIFC)',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'DIFC (Dubai International Financial Centre)',
                'Client Fund Segregation' => 'Required',
                'Regulatory Powers'       => 'Full enforcement - fines, licence revocation',
                'Passporting'             => 'DIFC only; not UAE mainland (SCA jurisdiction)',
                'Regulatory Register'     => 'DFSA register at dfsa.ae/register',
            ],
            'faqs'        => [
                ['q' => 'What does DFSA regulation mean?', 'a' => 'DFSA regulation means the broker is authorised and supervised by the Dubai Financial Services Authority within the Dubai International Financial Centre (DIFC). The DFSA sets capital requirements, mandates client fund segregation, and has full enforcement powers. A DFSA-regulated broker is considered one of the highest-trust options available to UAE-based traders, offering strong local legal recourse.'],
                ['q' => 'Which forex brokers are DFSA regulated?', 'a' => 'DFSA-regulated forex and CFD brokers are relatively few - the DFSA sets high capital and governance requirements. Most DFSA licence holders are institutional or professional-client facing. Retail traders typically use brokers regulated by the FCA, ASIC, or CySEC that also hold MENA-focused licences. Check the DFSA register at dfsa.ae for the current list of authorised firms.'],
                ['q' => 'Is DFSA the same as SCA?', 'a' => 'No. The DFSA regulates firms within the DIFC (a special economic zone in Dubai). The Securities and Commodities Authority (SCA) regulates financial firms on the UAE mainland, outside the DIFC. The two are separate regulators with different jurisdictions. A DFSA licence does not permit operation on the UAE mainland, and vice versa.'],
                ['q' => 'How do I verify DFSA regulation?', 'a' => 'Visit the DFSA\'s public register at dfsa.ae/public-register and search for the broker\'s name or licence number. An authorised firm will show as "Authorised" with details of the licence category and permitted activities. Always verify directly on the register rather than relying on broker-provided documents.'],
            ],
        ],

        'sca' => [
            'slug'        => 'sca',
            'name'        => 'SCA',
            'full_name'   => 'Securities and Commodities Authority',
            'country'     => 'United Arab Emirates (Mainland)',
            'flag'        => '🇦🇪',
            'established' => 2000,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Securities and Commodities Authority (SCA) is the federal financial regulatory body of the United Arab Emirates, responsible for regulating securities markets and financial services on the UAE mainland - outside the DIFC and ADGM financial free zones. Established by Federal Law in 2000, the SCA oversees brokers, investment advisers, and financial services firms operating for UAE mainland clients. The SCA has increasingly strengthened its enforcement capabilities and has issued guidance on OTC derivatives and forex trading. For traders in Dubai (outside the DIFC), Abu Dhabi, Sharjah, and across the UAE, the SCA is the primary federal regulator governing the financial services they access locally.',
            'key_facts'   => [
                'Regulator Type'          => 'Federal statutory authority (UAE Mainland)',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'UAE mainland (all emirates except DIFC/ADGM)',
                'Client Fund Segregation' => 'Required for licensed entities',
                'Regulatory Powers'       => 'Licensing, supervision, enforcement, fines',
                'Regulatory Register'     => 'SCA register at sca.gov.ae',
            ],
            'faqs'        => [
                ['q' => 'What does SCA regulation mean for UAE traders?', 'a' => 'SCA regulation means the broker is authorised by the UAE\'s federal Securities and Commodities Authority to operate on the UAE mainland. SCA-regulated brokers are subject to UAE federal law, must hold client funds separately, and operate under SCA supervision. Most international brokers serving UAE traders hold licences from the FCA or ASIC in addition to or instead of an SCA licence.'],
                ['q' => 'Is SCA the same as DFSA?', 'a' => 'No. The SCA regulates financial services on the UAE mainland (across all 7 emirates outside the DIFC and ADGM). The DFSA regulates firms within the Dubai International Financial Centre (DIFC), which is a special economic zone. The two are separate regulators with separate jurisdictions. Most major international forex brokers operating in the UAE hold an SCA licence or serve UAE clients under FCA/ASIC licences.'],
                ['q' => 'Can I trade forex with an SCA-regulated broker?', 'a' => 'Yes. SCA-regulated brokers can provide forex and CFD trading services to UAE mainland clients. However, the choice of SCA-licensed retail forex brokers is limited. Most Gulf traders use internationally regulated brokers (FCA, ASIC, CySEC) which are legally accessible to UAE residents, providing broader choice and often stronger client protection frameworks.'],
                ['q' => 'How do I verify SCA regulation?', 'a' => 'Visit the SCA website at sca.gov.ae and use the licensed entities search to verify a broker\'s SCA licence status. A legitimate SCA-regulated broker will have an active licence number with details of permitted activities. The SCA has also published warnings against unlicensed brokers targeting UAE investors.'],
            ],
        ],

        'cma-saudi' => [
            'slug'        => 'cma-saudi',
            'name'        => 'CMA',
            'full_name'   => 'Capital Market Authority (Saudi Arabia)',
            'country'     => 'Kingdom of Saudi Arabia',
            'flag'        => '🇸🇦',
            'established' => 2003,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Capital Market Authority (CMA) of Saudi Arabia is the independent government body responsible for regulating and developing the Saudi capital market, including securities exchanges, investment funds, and financial advisory services. Established in 2003, the CMA oversees the Saudi Exchange (Tadawul) and supervises financial services firms operating in the Kingdom. As Vision 2030 drives Saudi Arabia\'s financial sector transformation, the CMA has become an increasingly important regulator. For retail forex traders in Saudi Arabia, the CMA provides the primary domestic regulatory framework. Most Saudi traders use internationally regulated brokers (FCA, ASIC, CySEC) alongside or instead of locally CMA-licensed entities.',
            'key_facts'   => [
                'Regulator Type'          => 'Independent government body',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Kingdom of Saudi Arabia',
                'Regulatory Powers'       => 'Licensing, supervision, enforcement, market oversight',
                'Supervised Exchange'     => 'Saudi Exchange (Tadawul)',
                'Regulatory Register'     => 'CMA register at cma.org.sa',
            ],
            'faqs'        => [
                ['q' => 'Does Saudi Arabia have a forex regulator?', 'a' => 'Yes. The Capital Market Authority (CMA) is the primary financial regulator in Saudi Arabia. The CMA oversees investment firms and financial services companies operating in the Kingdom. For retail forex specifically, the CMA has issued guidance requiring traders to use regulated brokers. The CMA regularly publishes investor warnings about unlicensed offshore brokers targeting Saudi clients.'],
                ['q' => 'Do I need a CMA-licensed broker to trade forex in Saudi Arabia?', 'a' => 'Using a CMA-licensed broker is recommended for the strongest local regulatory protection. However, Saudi traders commonly and legally use internationally regulated brokers (FCA, ASIC, CySEC) - this is widely practised. The key is to avoid completely unlicensed brokers with no regulatory oversight anywhere. Always verify regulation before depositing funds.'],
                ['q' => 'Is forex trading halal in Saudi Arabia under CMA rules?', 'a' => 'The CMA does not issue specific rulings on the religious permissibility of forex trading - that falls to Islamic scholars and Saudi Arabia\'s religious institutions. From a regulatory standpoint, forex trading is permitted in Saudi Arabia under CMA oversight. Islamic swap-free accounts are universally available from major regulated brokers, eliminating overnight interest charges.'],
                ['q' => 'How do I check if a broker is CMA regulated?', 'a' => 'Visit cma.org.sa and use the licensed entities register to search for a broker\'s name or licence number. The CMA also maintains a list of unauthorised firms and warning notices. If a broker claims CMA authorisation, always verify it directly on the official register.'],
            ],
        ],

        'fsca' => [
            'slug'        => 'fsca',
            'name'        => 'FSCA',
            'full_name'   => 'Financial Sector Conduct Authority',
            'country'     => 'South Africa',
            'flag'        => '🇿🇦',
            'established' => 2018,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Up to 1:500 (no cap for retail)',
            'intro'       => 'The Financial Sector Conduct Authority (FSCA) is South Africa\'s primary market conduct regulator for non-banking financial services, established in 2018 as the successor to the Financial Services Board (FSB). The FSCA oversees financial advisers, investment firms, and trading platforms operating in South Africa. Several major international forex brokers - including Exness and IC Markets - hold FSCA licences for their South African entities. For Gulf and MENA traders, the FSCA-regulated entity is often the one that serves accounts due to its permissive leverage regime: unlike the FCA or ASIC, the FSCA does not cap retail leverage, allowing brokers to offer up to 1:500 or higher. The FSCA requires financial service providers (FSPs) to be registered and maintain fit-and-proper standards.',
            'key_facts'   => [
                'Regulator Type'          => 'Statutory conduct authority',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Republic of South Africa',
                'Max Retail Leverage'     => 'No cap - brokers set their own limits',
                'Client Fund Segregation' => 'Required for registered FSPs',
                'Regulatory Register'     => 'FSCA register at fsca.co.za',
            ],
            'faqs'        => [
                ['q' => 'Why do brokers like Exness use an FSCA licence?', 'a' => 'The FSCA is a legitimate, well-regulated authority that also permits higher leverage than the FCA or ASIC. Many brokers hold an FSCA licence for their South African entity, which also serves clients in Africa and sometimes other regions including MENA. For traders wanting higher leverage with reasonable regulatory oversight, an FSCA-regulated entity is a middle ground between Tier 1 regulators and offshore jurisdictions.'],
                ['q' => 'Is FSCA regulation safe?', 'a' => 'FSCA regulation requires brokers to be registered, meet fit-and-proper requirements, and maintain client fund segregation. It is a legitimate Tier 2 regulator. However, unlike the FCA or ASIC, the FSCA has no leverage cap for retail traders and no compensation scheme if a broker becomes insolvent. It provides meaningful oversight but less protection than top-tier regulators.'],
                ['q' => 'Does FSCA regulation apply to Gulf traders?', 'a' => 'It depends on which entity the broker assigns your account to. Some brokers route Gulf clients through their FSCA-registered entity. If so, South African financial services law applies to your account. Always check your account agreement to identify which regulatory entity holds your account and what protections apply.'],
                ['q' => 'How do I verify FSCA registration?', 'a' => 'Visit the FSCA website at fsca.co.za and search the Regulated Entities database by the broker\'s name or FSP licence number. An authorised broker will show as "Active" with the categories of financial services it is licensed to provide.'],
            ],
        ],

        'fsa-seychelles' => [
            'slug'        => 'fsa-seychelles',
            'name'        => 'FSA',
            'full_name'   => 'Financial Services Authority (Seychelles)',
            'country'     => 'Seychelles',
            'flag'        => '🇸🇨',
            'established' => 2013,
            'tier'        => 3,
            'tier_label'  => 'Tier 3 - Offshore',
            'compensation'=> 'No compensation scheme',
            'leverage'    => 'Up to 1:2000 (no cap)',
            'intro'       => 'The Financial Services Authority (FSA) of Seychelles is an offshore financial regulator that licenses and supervises financial services firms in the Republic of Seychelles. The FSA is categorised as a Tier 3 (offshore) regulator - it provides basic licensing oversight but applies significantly fewer restrictions than Tier 1 regulators like the FCA or ASIC. The FSA does not cap retail leverage (brokers may offer up to 1:2000), does not require negative balance protection, and has no compensation scheme for clients. Many major brokers - including Exness (Exness Ltd) and XM (Trading Point of Financial Instruments Ltd) - operate FSA-licensed entities specifically to serve clients who want higher leverage than Tier 1 regulators allow. Gulf traders should understand that FSA-regulated accounts provide less client protection than FCA or ASIC-regulated accounts.',
            'key_facts'   => [
                'Regulator Type'          => 'Offshore financial authority',
                'Compensation Scheme'     => 'None',
                'Jurisdiction'            => 'Republic of Seychelles',
                'Max Retail Leverage'     => 'No cap - up to 1:2000 common',
                'Negative Balance Protection' => 'Not required',
                'Client Fund Segregation' => 'Basic requirements only',
                'Regulatory Register'     => 'FSA register at fsaseychelles.sc',
            ],
            'faqs'        => [
                ['q' => 'Is Seychelles FSA regulation safe?', 'a' => 'The FSA provides basic regulatory oversight - brokers must be registered and meet minimum capital requirements. However, it is a Tier 3 offshore regulator with significantly less oversight than the FCA, ASIC, or CySEC. There is no compensation scheme, no mandatory negative balance protection, and no leverage cap. For traders wanting maximum protection, a Tier 1-regulated broker entity is preferable. FSA-regulated accounts are typically chosen for their high leverage availability.'],
                ['q' => 'Why do major brokers use Seychelles FSA regulation?', 'a' => 'The FSA allows brokers to offer higher leverage (up to 1:2000) than Tier 1 regulators permit. Brokers like Exness and XM use their FSA-registered entities to serve clients - particularly in emerging markets and the Gulf - who prefer high leverage. These same brokers also hold FCA and ASIC licences for clients who prefer stricter regulatory protection. The choice of entity is usually determined by geography and account type.'],
                ['q' => 'Should Gulf traders use FSA Seychelles-regulated accounts?', 'a' => 'It depends on your priorities. If you want higher leverage (1:500+), an FSA-regulated entity may be the only option your broker offers for your region. If client protection and compensation scheme coverage are priorities, request the broker\'s FCA or ASIC-regulated entity instead. Many brokers allow Gulf clients to choose their preferred entity - always ask which entities are available before opening an account.'],
                ['q' => 'How do I check FSA Seychelles regulation?', 'a' => 'Visit fsaseychelles.sc and search the register of licensed entities. A legitimately FSA-registered broker will have an active Securities Dealer licence. The FSA register is publicly searchable. Note that some brokers list a Seychelles company but are not FSA-licensed - always verify the specific licence, not just the company address.'],
            ],
        ],

        'cma-kuwait' => [
            'slug'        => 'cma-kuwait',
            'name'        => 'CMA Kuwait',
            'full_name'   => 'Capital Markets Authority (Kuwait)',
            'country'     => 'State of Kuwait',
            'flag'        => '🇰🇼',
            'established' => 2010,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Capital Markets Authority (CMA) of Kuwait is the independent government body responsible for regulating Kuwait\'s securities markets and financial services sector. Established in 2010 under Law No. 7, the CMA oversees investment portfolios, securities brokers, investment funds, and financial advisory services in Kuwait. The CMA operates under a modern regulatory framework aligned with international IOSCO standards. Kuwait\'s high per-capita income and financially sophisticated population have driven strong retail interest in forex trading. Most Kuwaiti traders access global forex markets through internationally regulated brokers (FCA, ASIC, CySEC), as the local CMA-regulated forex broker market is limited. The CMA has the authority to license, supervise, and take enforcement action against regulated entities.',
            'key_facts'   => [
                'Regulator Type'          => 'Independent government authority',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'State of Kuwait',
                'IOSCO Member'            => 'Yes - signatory to IOSCO MMoU',
                'Regulatory Powers'       => 'Licensing, supervision, enforcement',
                'Regulatory Register'     => 'CMA Kuwait at cma.gov.kw',
            ],
            'faqs'        => [
                ['q' => 'Does Kuwait have a forex regulator?', 'a' => 'Yes. The Capital Markets Authority (CMA) of Kuwait regulates financial services in Kuwait. Forex trading is permitted in Kuwait under CMA oversight. Most Kuwaiti traders use internationally regulated brokers (FCA, ASIC, CySEC) as the selection of locally CMA-licensed retail forex brokers is limited.'],
                ['q' => 'Can Kuwaiti traders use FCA or ASIC-regulated brokers?', 'a' => 'Yes. Kuwaiti traders can legally access internationally regulated brokers including those licensed by the FCA, ASIC, and CySEC. This is standard practice throughout Kuwait and the GCC. Using a well-regulated international broker provides stronger client protection than many locally registered alternatives.'],
                ['q' => 'Is forex trading legal under Kuwait CMA rules?', 'a' => 'Yes. Forex trading is permitted in Kuwait and regulated by the CMA. The CMA has issued warnings against unauthorised brokers and encourages traders to verify regulation before depositing. Islamic swap-free accounts are universally available and widely used by Kuwaiti Muslim traders.'],
                ['q' => 'How do I verify CMA Kuwait regulation?', 'a' => 'Visit cma.gov.kw and search the licensed entities database for a broker\'s name or licence number. The CMA also publishes investor alerts about unlicensed entities targeting Kuwaiti investors. Always verify directly on the official register before opening an account.'],
            ],
        ],
    ];

    public function index(Request $request): void
    {
        $pageTitle = 'Forex Regulators Guide 2026 | FCA, ASIC, DFSA & More | Trader Gulf';
        $metaDesc  = 'Compare the world\'s top forex regulators - FCA, ASIC, CySEC, DFSA, SCA and more. Understand what each licence means for your client protection as a Gulf trader.';
        $pageUrl   = url('regulators');

        $bSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',        'item' => url()],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Regulators',  'item' => $pageUrl],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->render('regulators/index', [
            'title'       => $pageTitle,
            'metaDesc'    => $metaDesc,
            'canonical'   => $pageUrl,
            'headSchemas' => "<script type=\"application/ld+json\">$bSchema</script>",
            'regulators'  => self::REGULATORS,
        ]);
    }

    public function show(Request $request, string $regulator): void
    {
        $reg = self::REGULATORS[$regulator] ?? null;
        if (!$reg) $this->notFound();

        $brokers = $this->db()->fetchAll(
            "SELECT * FROM brokers WHERE is_active = 1 AND regulation LIKE ? ORDER BY overall_rating DESC, sort_order ASC",
            ['%' . $reg['name'] . '%']
        );

        $pageUrl   = url('regulators/' . $reg['slug']);
        $pageTitle = $reg['full_name'] . ' (' . $reg['name'] . ') Regulated Forex Brokers 2026 | Trader Gulf';
        $metaDesc  = 'What is ' . $reg['name'] . ' regulation? Compare all ' . $reg['name'] . '-regulated forex brokers, understand client protections, and verify broker licences. Updated ' . date('Y') . '.';

        $faqSchema = json_encode([
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(fn($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], $reg['faqs']),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $bSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => url()],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Regulators', 'item' => url('regulators')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $reg['name'], 'item' => $pageUrl],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->render('regulators/show', [
            'title'       => $pageTitle,
            'metaDesc'    => $metaDesc,
            'canonical'   => $pageUrl,
            'headSchemas' => "<script type=\"application/ld+json\">$bSchema</script><script type=\"application/ld+json\">$faqSchema</script>",
            'reg'         => $reg,
            'brokers'     => $brokers,
        ]);
    }
}
