-- Static page content for About, Risk Disclaimer, Privacy Policy
-- Safe to run multiple times
SET NAMES utf8mb4;

UPDATE pages SET content_html = '<div style="max-width:780px;margin:0 auto;line-height:1.8">

<h2 style="font-size:1.3rem;font-weight:700;margin:0 0 1rem">Who We Are</h2>
<p>Trader Gulf is an independent forex broker review and comparison platform built specifically for traders across the Middle East and North Africa (MENA) region. We cover the brokers, tools, and strategies that matter most to traders in the UAE, Saudi Arabia, Kuwait, Egypt, and beyond.</p>

<h2 style="font-size:1.3rem;font-weight:700;margin:2rem 0 1rem">Our Mission</h2>
<p>The forex industry is full of noise — paid rankings, broker-funded "reviews," and promotional content dressed up as editorial. We exist to cut through that. Every broker we review is evaluated against a transparent, consistent methodology so you can compare like with like and make decisions you can trust.</p>

<h2 style="font-size:1.3rem;font-weight:700;margin:2rem 0 1rem">What We Cover</h2>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.5rem"><strong>Broker Reviews</strong> — In-depth, regularly updated reviews of the most popular forex and CFD brokers available to MENA traders, covering regulation, spreads, platforms, and support.</li>
<li style="margin-bottom:.5rem"><strong>Broker Comparisons</strong> — Side-by-side comparisons across trading costs, leverage, account types, and regulation — filtered for what matters to Gulf traders.</li>
<li style="margin-bottom:.5rem"><strong>Islamic Accounts</strong> — Dedicated coverage of genuine swap-free halal account options for Muslim traders. We verify the terms, not just the marketing.</li>
<li style="margin-bottom:.5rem"><strong>Guides &amp; News</strong> — Practical trading guides and market news relevant to the MENA region.</li>
<li style="margin-bottom:.5rem"><strong>Trading Tools</strong> — Free pip calculators, position size calculators, margin calculators, and a live economic calendar.</li>
</ul>

<h2 style="font-size:1.3rem;font-weight:700;margin:2rem 0 1rem">Our Review Methodology</h2>
<p>We evaluate brokers across six core dimensions: regulation and safety, trading costs, platform and tools, account types, deposit and withdrawal experience, and customer support. Each dimension is scored independently. Our overall rating is a weighted average — safety and costs carry the most weight. <a href="/methodology" style="color:var(--accent)">Read our full methodology →</a></p>

<h2 style="font-size:1.3rem;font-weight:700;margin:2rem 0 1rem">Independence &amp; Transparency</h2>
<p>Trader Gulf earns revenue through affiliate commissions when readers click through and open accounts with brokers we review. This does not influence our ratings or editorial content. Our scores are based solely on our objective assessment of each broker. <a href="/affiliate-disclosure" style="color:var(--accent)">Read our full affiliate disclosure →</a></p>

<h2 style="font-size:1.3rem;font-weight:700;margin:2rem 0 1rem">Get in Touch</h2>
<p>Have a question, spotted an error in a review, or want to discuss a partnership or advertising opportunity? We read every message. <a href="/contact" style="color:var(--accent)">Contact us →</a></p>

</div>'
WHERE slug = 'about';


UPDATE pages SET content_html = '<div style="max-width:780px;margin:0 auto;line-height:1.8">

<p style="background:rgba(245,158,11,.1);border-left:4px solid var(--accent);padding:1rem 1.25rem;border-radius:0 8px 8px 0;font-weight:600;margin-bottom:2rem">
Important: Please read this risk disclaimer carefully before using any information or tools on Trader Gulf.
</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:0 0 .75rem">High Risk Investment Warning</h2>
<p>Trading foreign exchange (forex) and contracts for difference (CFDs) on margin carries a high level of risk and may not be suitable for all investors. The high degree of leverage available can work against you as well as for you. <strong>You could lose some or all of your invested capital.</strong> Do not invest money you cannot afford to lose.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Past Performance</h2>
<p>Past performance of any trading system, strategy, or individual trader is not indicative of future results. Markets are unpredictable. Performance data shown on this website or sourced from brokers is historical and should not be relied upon as a guarantee of future performance.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">No Financial Advice</h2>
<p>The content published on Trader Gulf — including broker reviews, comparisons, guides, news articles, and calculator outputs — is provided for <strong>informational and educational purposes only</strong>. Nothing on this website constitutes financial advice, investment advice, trading advice, or any other form of advice. You should not treat any content on this site as a substitute for professional financial or investment advice.</p>

<p>Before making any investment or trading decision, you should seek independent financial advice from a qualified professional adviser who is familiar with your personal circumstances, financial situation, and goals.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Broker Reviews &amp; Ratings</h2>
<p>Our broker reviews and ratings represent the opinions of our editorial team at the time of publication. They are based on publicly available information, direct testing where possible, and user feedback. Broker conditions, fees, regulation, and product offerings change over time. Always verify current terms and conditions directly with the broker before opening an account.</p>

<p>Trader Gulf does not endorse, recommend, or take responsibility for any broker listed on this website. The presence of a broker in our database does not constitute a recommendation to trade with them.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Regulatory Status</h2>
<p>Regulatory status of brokers listed on this site is sourced from publicly available information from the relevant regulatory authorities. We cannot guarantee the accuracy or completeness of regulatory information. Always verify a broker&apos;s current regulatory status directly with the relevant authority before depositing funds.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Affiliate Relationships</h2>
<p>Trader Gulf has commercial relationships with some of the brokers featured on this site. We may earn a commission if you click through and open an account. These commercial relationships do not influence our editorial ratings or review content. <a href="/affiliate-disclosure" style="color:var(--accent)">Read our full affiliate disclosure →</a></p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Accuracy of Information</h2>
<p>While we make every effort to ensure the accuracy of information published on Trader Gulf, we cannot guarantee that all information is current, complete, or free from error. Spreads, fees, leverage limits, minimum deposits, and other trading conditions are subject to change without notice. Always check the broker&apos;s official website for the most up-to-date information.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">Regional Restrictions</h2>
<p>Some brokers may not be available in your country or region due to local regulations. It is your responsibility to check the legal status of forex and CFD trading in your jurisdiction before opening an account.</p>

<p style="margin-top:2rem;color:var(--text-muted);font-size:.88rem">Last updated: August 2025</p>

</div>'
WHERE slug = 'risk-disclaimer';


UPDATE pages SET content_html = '<div style="max-width:780px;margin:0 auto;line-height:1.8">

<p style="color:var(--text-muted);margin-bottom:2rem">Last updated: August 2025</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:0 0 .75rem">1. Introduction</h2>
<p>Trader Gulf (&ldquo;we&rdquo;, &ldquo;our&rdquo;, or &ldquo;us&rdquo;) operates the website tradergulf.com. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. Please read it carefully.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">2. Information We Collect</h2>
<h3 style="font-size:1rem;font-weight:600;margin:.75rem 0 .5rem">Information you provide to us</h3>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem"><strong>Contact form submissions</strong> — name, email address, and message content when you contact us.</li>
<li style="margin-bottom:.4rem"><strong>Newsletter subscriptions</strong> — email address when you subscribe to our newsletter.</li>
</ul>

<h3 style="font-size:1rem;font-weight:600;margin:.75rem 0 .5rem">Information collected automatically</h3>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem"><strong>Usage data</strong> — pages visited, referrer URLs, approximate IP address (used to identify general location, not individuals), and timestamps. This is used for internal analytics only.</li>
<li style="margin-bottom:.4rem"><strong>Cookies</strong> — we use essential cookies to remember your consent preferences. See Section 5 for details.</li>
</ul>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">3. How We Use Your Information</h2>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem">To respond to enquiries submitted through our contact form.</li>
<li style="margin-bottom:.4rem">To send newsletters to subscribers (you can unsubscribe at any time).</li>
<li style="margin-bottom:.4rem">To understand how our website is used and improve content quality.</li>
<li style="margin-bottom:.4rem">To detect and prevent fraudulent or abusive activity.</li>
<li style="margin-bottom:.4rem">To comply with legal obligations.</li>
</ul>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">4. Third-Party Services</h2>
<p>We use the following third-party services that may collect data:</p>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem"><strong>Google Analytics (GA4)</strong> — website analytics. Governed by <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" style="color:var(--accent)">Google&apos;s Privacy Policy</a>. We use consent mode so analytics data is only collected after you accept cookies.</li>
<li style="margin-bottom:.4rem"><strong>Google Tag Manager</strong> — tag management. Governed by Google&apos;s Privacy Policy.</li>
<li style="margin-bottom:.4rem"><strong>TradingView</strong> — embedded charts and widgets. Governed by <a href="https://www.tradingview.com/policies/" target="_blank" rel="noopener" style="color:var(--accent)">TradingView&apos;s Privacy Policy</a>.</li>
<li style="margin-bottom:.4rem"><strong>Google AdSense</strong> — advertising. If you have consented to advertising cookies, Google may use cookies to serve personalised ads.</li>
</ul>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">5. Cookies</h2>
<p>We use the following types of cookies:</p>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem"><strong>Essential cookies</strong> — required for the website to function. These cannot be disabled.</li>
<li style="margin-bottom:.4rem"><strong>Analytics cookies</strong> — help us understand how visitors use the site (Google Analytics). Only set after you accept cookies.</li>
<li style="margin-bottom:.4rem"><strong>Advertising cookies</strong> — used by Google AdSense to serve relevant ads. Only set after you accept cookies.</li>
</ul>
<p>You can control cookies through our cookie consent banner or your browser settings. Note that disabling certain cookies may affect website functionality.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">6. Data Retention</h2>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem">Contact form messages are retained for up to 24 months.</li>
<li style="margin-bottom:.4rem">Newsletter subscriber data is retained until you unsubscribe.</li>
<li style="margin-bottom:.4rem">Internal page view logs are retained for up to 12 months.</li>
</ul>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">7. Your Rights</h2>
<p>Depending on your location, you may have the right to:</p>
<ul style="margin-left:1.5rem;margin-bottom:1rem">
<li style="margin-bottom:.4rem">Access the personal data we hold about you.</li>
<li style="margin-bottom:.4rem">Request correction of inaccurate data.</li>
<li style="margin-bottom:.4rem">Request deletion of your data.</li>
<li style="margin-bottom:.4rem">Withdraw consent at any time (where processing is based on consent).</li>
<li style="margin-bottom:.4rem">Object to or restrict processing of your data.</li>
</ul>
<p>To exercise any of these rights, contact us at <a href="/contact" style="color:var(--accent)">our contact page</a>.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">8. Children&apos;s Privacy</h2>
<p>Our website is not intended for children under the age of 18. We do not knowingly collect personal information from minors. If you believe a minor has provided us with personal information, please contact us and we will delete it.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">9. Changes to This Policy</h2>
<p>We may update this Privacy Policy from time to time. The date at the top of this page reflects when the policy was last revised. We encourage you to review this page periodically.</p>

<h2 style="font-size:1.2rem;font-weight:700;margin:2rem 0 .75rem">10. Contact Us</h2>
<p>If you have questions about this Privacy Policy or our data practices, please <a href="/contact" style="color:var(--accent)">contact us</a>.</p>

</div>'
WHERE slug = 'privacy-policy';
