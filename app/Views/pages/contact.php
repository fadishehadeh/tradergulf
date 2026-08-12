<?php
$_success = session()->getFlash('success');
$_error   = session()->getFlash('error');
?>
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem;text-align:center">
    <div class="container">
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.65rem">Get in Touch</h1>
        <p style="color:rgba(255,255,255,.7);max-width:520px;margin:0 auto;font-size:.95rem">
            Have a question about a broker? Found an error in our reviews? We'd love to hear from you.
        </p>
    </div>
</section>

<section style="padding:3rem 0 4rem">
    <div class="container" style="max-width:680px">

        <?php if (!empty($_success)): ?>
        <div style="background:rgba(52,211,153,.12);border:1px solid rgba(52,211,153,.3);border-radius:8px;padding:1rem 1.25rem;margin-bottom:1.5rem;color:var(--accent);font-weight:600">
            ✓ <?= e($_success) ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($_error)): ?>
        <div style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:8px;padding:1rem 1.25rem;margin-bottom:1.5rem;color:#ef4444">
            ✕ <?= e($_error) ?>
        </div>
        <?php endif; ?>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem">
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem;text-align:center">
                <div style="font-size:1.75rem;margin-bottom:.4rem">📧</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--text-muted);margin-bottom:.25rem">Email</div>
                <a href="mailto:<?= e(setting('contact_email','info@tradergulf.com')) ?>" style="color:var(--accent);font-size:.88rem">
                    <?= e(setting('contact_email','info@tradergulf.com')) ?>
                </a>
            </div>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem;text-align:center">
                <div style="font-size:1.75rem;margin-bottom:.4rem">⏱️</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--text-muted);margin-bottom:.25rem">Response Time</div>
                <span style="color:var(--text-main);font-size:.88rem">Within 2 business days</span>
            </div>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem">
            <h2 style="font-size:1.1rem;margin-bottom:1.5rem">Send Us a Message</h2>
            <form action="<?= url('contact') ?>" method="post">
                <?= csrf_field() ?>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
                    <div>
                        <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem">Your Name *</label>
                        <input type="text" name="name" required
                               style="width:100%;padding:.6rem .9rem;border:1px solid var(--border);border-radius:7px;background:var(--body-bg);color:var(--text-main);font-size:.9rem"
                               placeholder="John Smith">
                    </div>
                    <div>
                        <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem">Email Address *</label>
                        <input type="email" name="email" required
                               style="width:100%;padding:.6rem .9rem;border:1px solid var(--border);border-radius:7px;background:var(--body-bg);color:var(--text-main);font-size:.9rem"
                               placeholder="you@example.com">
                    </div>
                </div>
                <div style="margin-bottom:1rem">
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem">Subject</label>
                    <input type="text" name="subject"
                           style="width:100%;padding:.6rem .9rem;border:1px solid var(--border);border-radius:7px;background:var(--body-bg);color:var(--text-main);font-size:.9rem"
                           placeholder="Broker question, review feedback...">
                </div>
                <div style="margin-bottom:1.5rem">
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem">Message *</label>
                    <textarea name="message" required rows="5"
                              style="width:100%;padding:.6rem .9rem;border:1px solid var(--border);border-radius:7px;background:var(--body-bg);color:var(--text-main);font-size:.9rem;resize:vertical"
                              placeholder="Your message..."></textarea>
                </div>
                <button type="submit"
                        style="padding:.7rem 2rem;background:var(--accent);border:none;border-radius:7px;color:var(--navy-dark);font-weight:700;font-size:.92rem;cursor:pointer">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>
