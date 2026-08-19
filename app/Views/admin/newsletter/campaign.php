<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem">
    <div>
        <h2 style="font-size:1.05rem;margin:0">Send Campaign</h2>
        <div style="font-size:.82rem;color:var(--a-text-muted);margin-top:.2rem">
            Email all active subscribers
            <span style="background:var(--a-accent);color:var(--navy-dark);border-radius:10px;padding:1px 8px;font-size:.72rem;font-weight:700;margin-left:.4rem"><?= (int)$subscriberCount ?></span>
        </div>
    </div>
    <a href="<?= url('admin/newsletter') ?>" class="btn-a btn-a-outline btn-a-sm">&#8592; Subscriber List</a>
</div>

<?php if ($subscriberCount === 0): ?>
<div style="background:#fef3c7;border:1px solid #f59e0b;border-radius:8px;padding:1rem 1.25rem;margin-bottom:1.25rem;color:#92400e;font-size:.88rem">
    <strong>No active subscribers.</strong> There are currently no active subscribers to send a campaign to.
    Import or wait for users to subscribe before using this feature.
</div>
<?php endif; ?>

<div class="a-card">
    <div class="a-card-body">
        <form method="post"
              action="<?= url('admin/newsletter/campaign/send') ?>"
              onsubmit="return confirm('Send this email to <?= (int)$subscriberCount ?> subscribers?')">
            <?= csrf_field() ?>

            <div style="margin-bottom:1.1rem">
                <label for="subject" style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem;color:var(--a-text-main)">
                    Subject
                </label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="a-input"
                    placeholder="e.g. Top Forex Brokers in the Gulf - August 2026"
                    style="width:100%;box-sizing:border-box"
                    required
                >
            </div>

            <div style="margin-bottom:.5rem">
                <label for="body" style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.35rem;color:var(--a-text-main)">
                    Body
                </label>
                <textarea
                    id="body"
                    name="body"
                    class="a-input"
                    rows="10"
                    placeholder="<p>Your message here...</p>"
                    style="width:100%;box-sizing:border-box;font-family:monospace;font-size:.85rem;resize:vertical"
                    required
                ></textarea>
                <div style="font-size:.76rem;color:var(--a-text-muted);margin-top:.3rem">
                    You can use basic HTML in the body (e.g. &lt;p&gt;, &lt;a&gt;, &lt;strong&gt;, &lt;ul&gt;).
                </div>
            </div>

            <div style="margin-top:1.25rem;display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
                <button
                    type="submit"
                    class="btn-a btn-a-accent"
                    <?= $subscriberCount === 0 ? 'disabled' : '' ?>
                >
                    &#9993; Send to <?= (int)$subscriberCount ?> Subscriber<?= $subscriberCount !== 1 ? 's' : '' ?>
                </button>
                <a href="<?= url('admin/newsletter') ?>" class="btn-a btn-a-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
