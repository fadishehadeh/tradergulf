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

        'fsra-adgm' => [
            'slug'        => 'fsra-adgm',
            'name'        => 'FSRA',
            'full_name'   => 'Financial Services Regulatory Authority (Abu Dhabi Global Market)',
            'country'     => 'UAE - Abu Dhabi Global Market',
            'flag'        => '🇦🇪',
            'established' => 2013,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Financial Services Regulatory Authority (FSRA) is the independent financial regulator of the Abu Dhabi Global Market (ADGM), a financial free zone established on Al Maryah Island in Abu Dhabi. The FSRA was established in 2013 alongside the ADGM and applies regulatory standards aligned with IOSCO principles and international best practices. The FSRA is considered a Tier 1 regional regulator, distinct from and separate to the SCA (which regulates the UAE mainland) and the DFSA (which regulates within the DIFC in Dubai). FSRA-regulated brokers must maintain adequate capital, segregate client funds, and comply with robust AML and conduct requirements. The ADGM has attracted a growing number of international financial institutions, making the FSRA increasingly relevant for traders based in Abu Dhabi and across the UAE.',
            'key_facts'   => [
                'Regulator Type'          => 'Independent statutory authority (ADGM free zone)',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Abu Dhabi Global Market (Al Maryah Island)',
                'Client Fund Segregation' => 'Required',
                'Regulatory Powers'       => 'Full enforcement - fines, licence revocation',
                'Passporting'             => 'ADGM only; distinct from SCA (mainland) and DFSA (DIFC)',
                'Regulatory Register'     => 'FSRA register at fsra.adgm.com',
            ],
            'faqs'        => [
                ['q' => 'What is the FSRA and how does it differ from the DFSA?', 'a' => 'The FSRA (Financial Services Regulatory Authority) regulates financial services within the Abu Dhabi Global Market (ADGM), a financial free zone on Al Maryah Island, Abu Dhabi. The DFSA regulates within the Dubai International Financial Centre (DIFC) in Dubai. Both are Tier 1 UAE regulators but operate in separate jurisdictions. A firm licensed by the FSRA may not operate in the DIFC without a DFSA licence, and vice versa.'],
                ['q' => 'Which brokers are FSRA regulated?', 'a' => 'The FSRA-regulated broker market is currently smaller than DFSA. The ADGM has attracted institutional and professional-client businesses rather than mass-market retail forex brokers. Check the FSRA public register at fsra.adgm.com for an up-to-date list of authorised firms. Major international retail forex brokers are more commonly regulated under the DFSA, FCA, or ASIC.'],
                ['q' => 'How does FSRA regulation protect traders?', 'a' => 'FSRA-regulated firms must hold adequate regulatory capital, segregate client funds from company assets, implement AML controls, and meet conduct-of-business standards. The FSRA has enforcement powers including fines and licence revocation. There is no retail compensation scheme equivalent to the UK FSCS, but the regulatory framework provides strong structural protections.'],
                ['q' => 'How do I verify FSRA regulation?', 'a' => 'Visit the FSRA public register at fsra.adgm.com/public-register and search by firm name. An authorised firm will show its licence category, status, and permitted activities. Always verify directly on the register rather than relying on the broker\'s own marketing materials.'],
            ],
        ],

        'cbb' => [
            'slug'        => 'cbb',
            'name'        => 'CBB',
            'full_name'   => 'Central Bank of Bahrain',
            'country'     => 'Bahrain',
            'flag'        => '🇧🇭',
            'established' => 2006,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Up to 1:50 (retail forex)',
            'intro'       => 'The Central Bank of Bahrain (CBB) is Bahrain\'s integrated financial services regulator, assuming its current form in 2006 as the successor to the Bahrain Monetary Agency. The CBB regulates banking, insurance, investment business, and capital markets across the Kingdom of Bahrain. As a regional regulator with long-standing experience in financial services supervision, the CBB applies a risk-based regulatory approach broadly aligned with IOSCO and Basel standards. Bahrain has historically been one of the GCC\'s most developed financial centres, and the CBB\'s regulatory framework reflects this heritage. For forex traders, CBB-regulated brokers must maintain client fund segregation and meet capital adequacy requirements, though Bahrain does not have a retail investor compensation scheme equivalent to the UK FSCS.',
            'key_facts'   => [
                'Regulator Type'          => 'Central bank and integrated regulator',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Kingdom of Bahrain',
                'Max Retail Leverage'     => 'Up to 1:50 (as regulated)',
                'Client Fund Segregation' => 'Required for licensed investment firms',
                'IOSCO Member'            => 'Yes',
                'Regulatory Register'     => 'CBB register at cbb.gov.bh',
            ],
            'faqs'        => [
                ['q' => 'Is Bahrain a reputable financial regulator?', 'a' => 'Yes. The CBB has decades of regulatory heritage as the successor to the Bahrain Monetary Agency (established 1973). Bahrain is an established financial hub in the GCC and the CBB applies risk-based regulatory standards aligned with international bodies including IOSCO and the Basel Committee. It is considered a solid Tier 2 regional regulator.'],
                ['q' => 'Which forex brokers are CBB regulated?', 'a' => 'Several regional and international brokers hold CBB licences to serve Bahraini clients. Check the CBB\'s public register at cbb.gov.bh for the current list of licensed capital market firms. Many international brokers serving Gulf clients hold licences from the FCA or ASIC as their primary regulator in addition to regional licences.'],
                ['q' => 'Can Bahraini traders use internationally regulated brokers?', 'a' => 'Yes. Bahraini traders commonly use brokers regulated by the FCA, ASIC, and CySEC. This is legal and widely practised. International regulation often provides stronger client protections (compensation schemes, stricter capital requirements) than what is available locally. The key is to avoid brokers with no regulation anywhere.'],
                ['q' => 'How do I verify CBB regulation?', 'a' => 'Visit cbb.gov.bh and search the licensed institutions register. A CBB-licensed investment firm will be listed with its licence type and category. The CBB also publishes investor warnings about unlicensed entities. Always verify directly on the official register.'],
            ],
        ],

        'qfcra' => [
            'slug'        => 'qfcra',
            'name'        => 'QFCRA',
            'full_name'   => 'Qatar Financial Centre Regulatory Authority',
            'country'     => 'Qatar',
            'flag'        => '🇶🇦',
            'established' => 2005,
            'tier'        => 2,
            'tier_label'  => 'Tier 2 - Well Regulated (Regional)',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'Set by individual licence conditions',
            'intro'       => 'The Qatar Financial Centre Regulatory Authority (QFCRA) is the independent financial regulator of the Qatar Financial Centre (QFC), a special economic and financial zone established in Doha to attract international financial institutions. The QFCRA was established in 2005 and operates separately from Qatar\'s domestic financial regulator (the Qatar Central Bank). The QFCRA applies international regulatory standards, is a signatory to IOSCO\'s multilateral memorandum of understanding (MMoU), and maintains strong anti-money laundering frameworks. The QFC has attracted global banks, asset managers, and insurance companies, making Qatar an increasingly significant financial centre in the region. For retail forex traders in Qatar, the QFCRA is the local Tier 2 regulatory option, though most Qatari traders access international markets via FCA, ASIC, or CySEC-regulated brokers.',
            'key_facts'   => [
                'Regulator Type'          => 'Independent statutory authority (QFC free zone)',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Qatar Financial Centre (Doha)',
                'IOSCO Member'            => 'Yes - signatory to IOSCO MMoU',
                'Regulatory Powers'       => 'Licensing, supervision, enforcement',
                'Passporting'             => 'QFC zone only; Qatar Central Bank governs domestic institutions',
                'Regulatory Register'     => 'QFCRA register at qfcra.com',
            ],
            'faqs'        => [
                ['q' => 'What is the QFCRA and how does it work?', 'a' => 'The QFCRA regulates financial services firms operating within the Qatar Financial Centre - a special economic zone in Doha. It is separate from the Qatar Central Bank, which regulates domestic banks and financial institutions. Firms licenced by the QFCRA operate under international-standard rules aligned with IOSCO principles, making it a credible Tier 2 regional regulator.'],
                ['q' => 'Are there QFCRA-regulated forex brokers for retail traders?', 'a' => 'The QFC primarily attracts institutional and professional-client financial services firms rather than mass-market retail forex brokers. Most retail Qatari forex traders use internationally regulated brokers (FCA, ASIC, CySEC). Check the QFCRA public register at qfcra.com for the current list of authorised firms.'],
                ['q' => 'Is forex trading legal in Qatar?', 'a' => 'Yes. Forex trading is legal in Qatar. The QFCRA regulates eligible firms within the QFC, and the Qatar Central Bank oversees domestic financial services. Most Qatari traders use internationally regulated brokers - this is widely practised and legal. Islamic swap-free accounts are universally available and align with Qatar\'s Islamic finance principles.'],
                ['q' => 'How do I verify QFCRA regulation?', 'a' => 'Visit the QFCRA website at qfcra.com and search the public register of authorised firms. A firm with a valid QFCRA licence will appear with its authorisation category and permitted activities. Always verify on the official register rather than relying on broker documentation.'],
            ],
        ],

        'mas' => [
            'slug'        => 'mas',
            'name'        => 'MAS',
            'full_name'   => 'Monetary Authority of Singapore',
            'country'     => 'Singapore',
            'flag'        => '🇸🇬',
            'established' => 1971,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated',
            'compensation'=> 'No retail compensation scheme (strong oversight)',
            'leverage'    => 'No fixed cap; guidance-based (typically 1:20 to 1:50 retail)',
            'intro'       => 'The Monetary Authority of Singapore (MAS) is Singapore\'s central bank and integrated financial regulator, established in 1971. The MAS is widely considered one of the world\'s premier financial regulatory bodies, known for its stability, rigour, and business-friendly approach. As Singapore is a global financial hub with one of the highest-ranked financial systems in the world, MAS regulation carries significant credibility. MAS-regulated forex brokers hold a Capital Markets Services (CMS) licence, which requires substantial capitalisation, client fund segregation, and compliance with conduct-of-business rules. Several major international forex brokers serving Gulf and Asian clients hold MAS licences, including Pepperstone, IG Group, and Saxo Bank. Singapore does not have a retail investor compensation scheme equivalent to the UK FSCS, but the rigour of MAS supervision makes broker failure rare.',
            'key_facts'   => [
                'Regulator Type'          => 'Central bank and integrated regulator',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'Republic of Singapore',
                'Licence Type'            => 'Capital Markets Services (CMS) licence',
                'Client Fund Segregation' => 'Required',
                'IOSCO Member'            => 'Yes - full member',
                'Regulatory Register'     => 'MAS Financial Institutions Directory at mas.gov.sg',
            ],
            'faqs'        => [
                ['q' => 'Is MAS a top-tier regulator?', 'a' => 'Yes. The MAS is widely ranked among the world\'s top three or four financial regulators alongside the FCA (UK) and ASIC (Australia). Singapore\'s financial system consistently ranks in the top tier globally for stability and regulatory quality. An MAS-regulated forex broker is considered highly credible and trustworthy, with rigorous oversight standards.'],
                ['q' => 'Can Gulf traders use MAS-regulated brokers?', 'a' => 'Yes. Many major brokers hold MAS licences and serve Gulf clients through various entities. Pepperstone, IG, and Saxo Bank all hold MAS licences. As with any broker, verify which regulatory entity will hold your account - some brokers assign Gulf clients to a different entity (e.g. ASIC or an offshore licence) rather than the MAS entity.'],
                ['q' => 'Does MAS cap forex leverage?', 'a' => 'The MAS does not set a fixed retail leverage cap equivalent to ESMA\'s 1:30 rule. However, MAS regulations require brokers to set appropriate leverage limits and implement margin requirements. In practice, most MAS-regulated brokers offer retail clients leverage of 1:20 to 1:50 on major forex pairs, with higher leverage available to accredited investors.'],
                ['q' => 'How do I verify MAS regulation?', 'a' => 'Visit the MAS Financial Institutions Directory at mas.gov.sg/financial-institutions and search for the broker\'s name or licence number. A CMS licence holder will appear with its authorised activities. The MAS Investor Alert List also publishes warnings about unlicensed entities targeting Singapore residents.'],
            ],
        ],

        'nfa' => [
            'slug'        => 'nfa',
            'name'        => 'NFA',
            'full_name'   => 'National Futures Association (CFTC-supervised)',
            'country'     => 'United States',
            'flag'        => '🇺🇸',
            'established' => 1982,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated',
            'compensation'=> 'No specific forex compensation scheme',
            'leverage'    => '1:50 (major pairs), 1:20 (minor pairs)',
            'intro'       => 'The National Futures Association (NFA) is the self-regulatory organisation for the US derivatives industry, operating under the oversight of the Commodity Futures Trading Commission (CFTC). All retail forex dealers in the United States must be NFA members and CFTC-registered. The NFA and CFTC together form the world\'s most stringent retail forex regulatory framework: US brokers must maintain a minimum net capital of $20 million, retail leverage is capped at 1:50 for major pairs and 1:20 for minors, and FIFO (first in, first out) rules apply to open positions. These strict requirements have led many international brokers to avoid the US market. Traders worldwide searching for highly regulated brokers often consider NFA/CFTC-regulated firms (such as OANDA, TD Ameritrade, and Interactive Brokers) as the benchmark for regulatory rigour.',
            'key_facts'   => [
                'Regulator Type'          => 'Self-regulatory body (under CFTC oversight)',
                'Compensation Scheme'     => 'No specific retail forex compensation',
                'Jurisdiction'            => 'United States of America',
                'Min Capital Requirement' => '$20 million net capital for forex dealers',
                'Max Retail Leverage'     => '1:50 major pairs, 1:20 minor pairs',
                'Hedging'                 => 'Prohibited for US retail clients (FIFO rule)',
                'Regulatory Register'     => 'NFA BASIC at nfa.futures.org',
            ],
            'faqs'        => [
                ['q' => 'What does NFA regulation mean for a forex broker?', 'a' => 'NFA membership means the broker is registered with the Commodity Futures Trading Commission (CFTC) and subject to NFA\'s self-regulatory rules. US-regulated forex dealers face the strictest requirements in the world: $20 million minimum net capital, leverage capped at 1:50 (major pairs), no hedging (FIFO rule applies), and no bonuses or promotional incentives. NFA regulation is the global gold standard for regulatory rigour, though its restrictions make US brokers less popular with international traders seeking higher leverage.'],
                ['q' => 'Can Gulf traders use NFA-regulated brokers?', 'a' => 'Yes. Gulf traders can open accounts with NFA/CFTC-regulated brokers such as OANDA, TD Ameritrade, and Interactive Brokers. However, US-regulated entities apply strict leverage caps (1:50) and FIFO rules, which differ significantly from what traders are accustomed to with European or Australian brokers. Most Gulf traders use FCA or ASIC-regulated brokers that offer higher flexibility alongside strong protection.'],
                ['q' => 'Why do most major forex brokers avoid NFA regulation?', 'a' => 'The CFTC/NFA framework imposes the world\'s strictest forex rules: $20 million minimum capital, 1:50 leverage cap, no hedging, FIFO position rules, and extensive compliance requirements. This makes US regulation expensive and operationally complex. Most international brokers - including XM, Exness, and Pepperstone - choose not to register as US forex dealers, instead serving US clients (where legally permitted) via alternative structures.'],
                ['q' => 'How do I verify NFA membership?', 'a' => 'Use the NFA BASIC search tool at nfa.futures.org/BasicNet to look up any futures or forex firm. A registered firm will show its NFA ID, registration status, and regulatory history including any disciplinary actions. This is one of the most transparent regulatory registers in the world - all enforcement actions and fines are publicly searchable.'],
            ],
        ],

        'bafin' => [
            'slug'        => 'bafin',
            'name'        => 'BaFin',
            'full_name'   => 'Federal Financial Supervisory Authority (Bundesanstalt fur Finanzdienstleistungsaufsicht)',
            'country'     => 'Germany (EU)',
            'flag'        => '🇩🇪',
            'established' => 2002,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated (EU)',
            'compensation'=> 'EdW up to EUR 20,000',
            'leverage'    => '1:30 (major pairs, ESMA rules)',
            'intro'       => 'BaFin (Bundesanstalt fur Finanzdienstleistungsaufsicht) is Germany\'s federal financial supervisory authority, formed in 2002 through the merger of three predecessor agencies. As an EU member regulator, BaFin applies ESMA (European Securities and Markets Authority) regulations, capping retail leverage at 1:30 for major forex pairs and requiring client fund segregation and negative balance protection. BaFin-regulated brokers benefit from EU financial services passporting, allowing them to offer services across all 27 EU member states. Germany\'s Investor Compensation Scheme (Entschadigungseinrichtung deutscher Wertpapierhandelsunternehmen, or EdW) covers retail clients up to EUR 20,000. BaFin is considered one of Europe\'s most respected financial regulators, alongside the FCA and AMF (France), and brings significant credibility to any broker that holds its authorisation.',
            'key_facts'   => [
                'Regulator Type'          => 'Federal statutory authority (EU)',
                'Compensation Scheme'     => 'EdW - up to EUR 20,000 per client',
                'Max Retail Leverage'     => '1:30 major pairs (ESMA)',
                'Client Fund Segregation' => 'Required',
                'Negative Balance Protection' => 'Required for retail clients (ESMA)',
                'EU Passport'             => 'Yes - valid across all 27 EU member states',
                'Regulatory Register'     => 'BaFin database at bafin.de',
            ],
            'faqs'        => [
                ['q' => 'How strong is BaFin regulation for forex traders?', 'a' => 'BaFin is a Tier 1 EU regulator applying the full ESMA ruleset: 1:30 leverage cap, mandatory client fund segregation, negative balance protection, and the EdW compensation scheme (up to EUR 20,000). It is considered one of Europe\'s most rigorous financial regulators. A BaFin-regulated broker provides comparable protection to a CySEC-regulated one (both apply ESMA rules), with BaFin\'s German institutional backing adding additional credibility.'],
                ['q' => 'Which forex brokers hold BaFin regulation?', 'a' => 'Several major forex and CFD brokers hold BaFin authorisation, including IG Group (via its German entity), GKFX, and others operating in the German market. The EU passport means some brokers licensed elsewhere in the EU (e.g. CySEC in Cyprus) also use that licence to passport into Germany without a separate BaFin licence. Check bafin.de\'s public database for authorised firms.'],
                ['q' => 'Can Gulf traders use BaFin-regulated brokers?', 'a' => 'Yes. Gulf traders can open accounts with BaFin-regulated brokers. However, as with all EU-regulated brokers, verify which entity covers your account - some brokers assign non-EU clients to offshore entities to offer higher leverage. If client protection is your priority, request to be placed under the broker\'s BaFin or other Tier 1-regulated entity.'],
                ['q' => 'How do I verify BaFin regulation?', 'a' => 'Visit bafin.de and use the company database search to look up a broker\'s name or BaFin ID. An authorised firm will appear with its licence type and permitted activities. BaFin also maintains a warning list of unlicensed entities targeting German investors, updated regularly.'],
            ],
        ],

        'fsc-mauritius' => [
            'slug'        => 'fsc-mauritius',
            'name'        => 'FSC Mauritius',
            'full_name'   => 'Financial Services Commission Mauritius',
            'country'     => 'Mauritius',
            'flag'        => '🇲🇺',
            'established' => 2001,
            'tier'        => 3,
            'tier_label'  => 'Tier 3 - Offshore',
            'compensation'=> 'No compensation scheme',
            'leverage'    => 'Up to 1:500 (no cap)',
            'intro'       => 'The Financial Services Commission (FSC) of Mauritius is the integrated regulator for non-banking financial services in the Republic of Mauritius. Established under the Financial Services Act 2007, the FSC licences investment dealers, fund managers, and global business companies. The FSC Mauritius is classified as a Tier 3 offshore regulator - it provides a recognised regulatory framework but with significantly fewer restrictions than Tier 1 bodies such as the FCA or ASIC. There is no retail leverage cap and no mandatory compensation scheme. Many major international forex brokers - including IC Markets, FP Markets, and Pepperstone - operate FSC Mauritius-licensed entities specifically to serve clients who want higher leverage than Tier 1 regulations permit. Gulf traders should understand that an FSC Mauritius-regulated account offers less client protection than an FCA or ASIC-regulated account from the same broker.',
            'key_facts'   => [
                'Regulator Type'          => 'Integrated financial services regulator (offshore)',
                'Compensation Scheme'     => 'None',
                'Jurisdiction'            => 'Republic of Mauritius',
                'Max Retail Leverage'     => 'No cap - typically up to 1:500',
                'Negative Balance Protection' => 'Not mandated',
                'Client Fund Segregation' => 'Required for investment dealers',
                'Regulatory Register'     => 'FSC register at fscmauritius.org',
            ],
            'faqs'        => [
                ['q' => 'Is FSC Mauritius a legitimate regulator?', 'a' => 'Yes. The FSC Mauritius is a recognised financial regulator with a formal licensing process and ongoing supervision requirements. It is not a Tier 1 regulator like the FCA or ASIC, but it is a legitimate Tier 3 offshore authority. Many well-known brokers hold FSC Mauritius licences as one of multiple regulatory entities. Its framework is less strict than Tier 1 bodies - no leverage cap, no compensation scheme, no mandatory negative balance protection - but it is not an unregulated offshore shell.'],
                ['q' => 'Why do established brokers use an FSC Mauritius licence?', 'a' => 'FSC Mauritius allows brokers to offer higher leverage (1:500) than Tier 1 regulators permit (1:30). For clients in markets like the Gulf, Africa, and Asia who prefer high leverage, brokers create an FSC Mauritius entity. A broker holding both an FCA licence and an FSC Mauritius licence demonstrates that it meets top-tier standards overall, even if the Mauritius entity has fewer restrictions. Always check which entity your account is assigned to.'],
                ['q' => 'Should Gulf traders use an FSC Mauritius-regulated account?', 'a' => 'If you want leverage above 1:30, an FSC Mauritius entity may be the option your broker offers for the Gulf region. The trade-off is less regulatory protection: no compensation scheme, no negative balance protection, and lower capital requirements than Tier 1 regulators. If protection matters more than leverage, request your broker\'s FCA or ASIC-regulated entity instead - some brokers allow clients to choose.'],
                ['q' => 'How do I verify FSC Mauritius regulation?', 'a' => 'Visit fscmauritius.org and search the public register of licensees. An authorised investment dealer will show its licence number, category, and expiry date. The FSC also publishes investor alerts about unauthorised entities. Verify the exact legal entity name - a broker\'s Mauritius company may have a different name than the parent brand.'],
            ],
        ],

        'vfsc' => [
            'slug'        => 'vfsc',
            'name'        => 'VFSC',
            'full_name'   => 'Vanuatu Financial Services Commission',
            'country'     => 'Vanuatu',
            'flag'        => '🇻🇺',
            'established' => 1993,
            'tier'        => 3,
            'tier_label'  => 'Tier 3 - Offshore',
            'compensation'=> 'No compensation scheme',
            'leverage'    => 'Up to 1:1000 (no cap)',
            'intro'       => 'The Vanuatu Financial Services Commission (VFSC) is the financial regulator of the Republic of Vanuatu, a small Pacific island nation. The VFSC is classified as a Tier 3 offshore regulator: it provides basic licensing oversight with low capital requirements, minimal ongoing supervision, and no retail leverage cap or compensation scheme. VFSC licences are among the most accessible in the forex industry and are commonly used by smaller brokers or as a secondary entity by larger brokers wanting to offer maximum leverage. Traders should exercise significant caution with brokers whose primary or only regulation is a VFSC licence. Unlike legitimate offshore regulators such as FSC Mauritius or the Seychelles FSA, the VFSC has very limited enforcement capacity. That said, some established brokers do hold VFSC licences as one of several regulatory entities.',
            'key_facts'   => [
                'Regulator Type'          => 'Offshore financial authority',
                'Compensation Scheme'     => 'None',
                'Jurisdiction'            => 'Republic of Vanuatu',
                'Capital Requirements'    => 'Very low - among lowest in industry',
                'Max Retail Leverage'     => 'No cap - up to 1:1000 common',
                'Negative Balance Protection' => 'Not required',
                'Regulatory Register'     => 'VFSC register at vfsc.vu',
            ],
            'faqs'        => [
                ['q' => 'Is VFSC regulation safe for forex trading?', 'a' => 'VFSC regulation provides very limited client protection. Capital requirements are low, there is no compensation scheme, no leverage cap, and enforcement capacity is minimal. A broker whose only regulation is a VFSC licence carries significant risk. However, if an established broker (with FCA or ASIC licences for other entities) also holds a VFSC licence, it may be a legitimate entity for clients wanting very high leverage - the broader broker group\'s standards provide some indirect comfort.'],
                ['q' => 'Why do some brokers choose VFSC over other offshore regulators?', 'a' => 'VFSC licences are inexpensive and relatively quick to obtain compared to Seychelles FSA or Mauritius FSC licences. For brokers wanting to establish an offshore entity quickly, VFSC is one of the fastest options. However, its very low requirements also mean less oversight. Reputable offshore jurisdictions for forex regulation are generally considered to be Seychelles (FSA) and Mauritius (FSC) ahead of Vanuatu (VFSC).'],
                ['q' => 'Should I avoid all VFSC-regulated brokers?', 'a' => 'Not necessarily. If the VFSC licence is one of several licences held by a large, reputable broker group (FCA, ASIC, CySEC also held), it may be a legitimate high-leverage entity. The concern is a broker that holds only a VFSC licence with no other regulation - that is a significant red flag. Always check what other regulatory licences the broker group holds before opening an account with any entity.'],
                ['q' => 'How do I check VFSC regulation?', 'a' => 'Visit vfsc.vu and search the register of licensed financial dealers. A licensed firm will appear with its licence number and activity category. Verify the exact legal entity name as broker subsidiaries often differ from the parent brand name. The VFSC register is publicly searchable online.'],
            ],
        ],

        'fma-nz' => [
            'slug'        => 'fma-nz',
            'name'        => 'FMA',
            'full_name'   => 'Financial Markets Authority (New Zealand)',
            'country'     => 'New Zealand',
            'flag'        => '🇳🇿',
            'established' => 2011,
            'tier'        => 1,
            'tier_label'  => 'Tier 1 - Top Rated',
            'compensation'=> 'No specific compensation scheme',
            'leverage'    => 'No fixed cap (risk-based approach)',
            'intro'       => 'The Financial Markets Authority (FMA) is New Zealand\'s financial markets regulator, established under the Financial Markets Authority Act 2011. The FMA oversees financial advisers, brokers, investment managers, and derivatives issuers operating in New Zealand, applying a conduct-based regulatory approach focused on ensuring fair, efficient, and transparent markets. New Zealand has a small but sophisticated financial services sector, and the FMA is considered a Tier 1 regulator due to its rigorous standards, enforcement track record, and alignment with IOSCO principles. Several well-known international forex brokers hold FMA licences, including Pepperstone and IC Markets, for their New Zealand entities. The FMA does not set a fixed retail leverage cap (unlike ESMA\'s 1:30 rule), instead applying a risk-based approach. New Zealand does not have a retail investor compensation scheme equivalent to the UK FSCS.',
            'key_facts'   => [
                'Regulator Type'          => 'Statutory authority',
                'Compensation Scheme'     => 'No specific retail compensation fund',
                'Jurisdiction'            => 'New Zealand',
                'Licence Type'            => 'Derivatives Issuer (DI) licence',
                'Client Fund Segregation' => 'Required',
                'IOSCO Member'            => 'Yes',
                'Regulatory Register'     => 'FMA register at fma.govt.nz',
            ],
            'faqs'        => [
                ['q' => 'Is FMA New Zealand a tier-1 regulator?', 'a' => 'Yes. The FMA is classified as a Tier 1 regulator due to its rigorous regulatory standards, active enforcement, IOSCO membership, and New Zealand\'s strong rule-of-law environment. While it does not have an investor compensation scheme and does not cap retail leverage as strictly as the FCA or ASIC, its oversight framework and enforcement track record are well-regarded internationally.'],
                ['q' => 'Which forex brokers hold an FMA (NZ) licence?', 'a' => 'Pepperstone and IC Markets are among the established international brokers with FMA Derivatives Issuer (DI) licences in New Zealand. These entities typically serve clients in the Asia-Pacific region. Search the FMA register at fma.govt.nz for the current list of licensed derivatives issuers.'],
                ['q' => 'Does FMA NZ cap forex leverage?', 'a' => 'The FMA does not apply a fixed leverage cap equivalent to ESMA\'s 1:30 rule. It uses a risk-based approach where brokers set appropriate leverage limits based on client suitability assessments. In practice, many FMA-regulated brokers offer retail leverage of 1:30 to 1:500, depending on the account type and client classification. Higher leverage is typically available to wholesale/professional clients.'],
                ['q' => 'How do I verify FMA New Zealand regulation?', 'a' => 'Visit the FMA website at fma.govt.nz and search the register of financial service providers. A Derivatives Issuer licensee will appear with its licence number, status, and authorised activities. The FMA also publishes a warning list of entities operating without a licence.'],
            ],
        ],

        'cima' => [
            'slug'        => 'cima',
            'name'        => 'CIMA',
            'full_name'   => 'Cayman Islands Monetary Authority',
            'country'     => 'Cayman Islands (British Overseas Territory)',
            'flag'        => '🇰🇾',
            'established' => 1997,
            'tier'        => 3,
            'tier_label'  => 'Tier 3 - Offshore',
            'compensation'=> 'No compensation scheme',
            'leverage'    => 'Up to 1:500 (no cap)',
            'intro'       => 'The Cayman Islands Monetary Authority (CIMA) is the financial regulatory body of the Cayman Islands, a British Overseas Territory in the Caribbean. CIMA was established in 1997 and regulates banks, trust companies, investment funds, and securities investment businesses in the Cayman Islands. The Cayman Islands are widely known as one of the world\'s leading offshore financial jurisdictions, hosting thousands of hedge funds and investment vehicles. For retail forex, CIMA is a Tier 3 offshore regulator - it provides a formal licensing structure but with lower requirements and less enforcement capacity than Tier 1 bodies. Some major forex brokers hold CIMA licences for specific entities or client segments. The Cayman Islands\' legal system is based on English common law, providing a degree of legal predictability, but there is no retail investor compensation scheme.',
            'key_facts'   => [
                'Regulator Type'          => 'Offshore financial authority',
                'Compensation Scheme'     => 'None',
                'Jurisdiction'            => 'Cayman Islands (British Overseas Territory)',
                'Legal System'            => 'English common law',
                'Max Retail Leverage'     => 'No cap - typically up to 1:500',
                'Negative Balance Protection' => 'Not required',
                'Regulatory Register'     => 'CIMA register at cima.ky',
            ],
            'faqs'        => [
                ['q' => 'Is CIMA a legitimate regulator for forex trading?', 'a' => 'CIMA is a legitimate regulatory body with a formal licensing process, but it is an offshore Tier 3 regulator. It has lower capital requirements and less enforcement capacity than Tier 1 regulators like the FCA or ASIC. There is no retail compensation scheme and no leverage cap. A broker with only a CIMA licence provides less client protection than an FCA or ASIC-regulated one. However, CIMA is considered more structured than some other offshore jurisdictions.'],
                ['q' => 'Why do some brokers use a CIMA licence?', 'a' => 'The Cayman Islands offer a well-established legal framework (English common law), political stability as a British Overseas Territory, and low tax rates. CIMA licences are used by hedge funds, institutional brokers, and some retail forex brokers wanting an offshore entity with a credible legal system. For retail forex specifically, FSC Mauritius and Seychelles FSA are more commonly used offshore alternatives.'],
                ['q' => 'Should Gulf traders trust CIMA-regulated brokers?', 'a' => 'It depends on what other regulation the broker holds. A major broker group with FCA and ASIC licences that also has a CIMA entity for high-leverage accounts is a different risk profile than a broker with only a CIMA licence. Always check the full regulatory structure of the broker group, not just the entity your account falls under. Never trade with a broker whose sole regulation is an offshore licence.'],
                ['q' => 'How do I verify CIMA regulation?', 'a' => 'Visit cima.ky and search the public register of regulated entities. A licensed Securities Investment Business will appear with its registration number and category. Always verify the exact legal entity name - Cayman companies often have different names than the broker\'s trading brand. The Cayman Islands also maintains a list of entities operating without CIMA authorisation.'],
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
