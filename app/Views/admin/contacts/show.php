<div style="margin-bottom:1rem">
    <a href="<?= url('admin/contacts') ?>" class="btn-a btn-a-ghost btn-a-sm">&#8592; Back to Messages</a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h2 style="margin:0;font-size:1rem">Message from <?= e($msg['name'] ?? 'Unknown') ?></h2>
        <span style="font-size:.8rem;color:var(--a-text-muted)"><?= date('d M Y, H:i', strtotime($msg['created_at'])) ?></span>
    </div>
    <div class="a-card-body">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem 2rem;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--a-border)">
            <div>
                <div style="font-size:.75rem;color:var(--a-text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.25rem">Name</div>
                <div><?= e($msg['name'] ?? '-') ?></div>
            </div>
            <div>
                <div style="font-size:.75rem;color:var(--a-text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.25rem">Email</div>
                <div><a href="mailto:<?= e($msg['email'] ?? '') ?>" style="color:var(--a-accent)"><?= e($msg['email'] ?? '-') ?></a></div>
            </div>
            <?php if (!empty($msg['subject'])): ?>
            <div style="grid-column:1/-1">
                <div style="font-size:.75rem;color:var(--a-text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.25rem">Subject</div>
                <div><?= e($msg['subject']) ?></div>
            </div>
            <?php endif; ?>
        </div>

        <div>
            <div style="font-size:.75rem;color:var(--a-text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.6rem">Message</div>
            <div style="background:var(--a-body-bg);border:1px solid var(--a-border);border-radius:8px;padding:1.25rem;font-size:.9rem;line-height:1.7;white-space:pre-wrap"><?= e($msg['message'] ?? '') ?></div>
        </div>

        <div style="margin-top:1.5rem;display:flex;gap:.75rem;align-items:center;flex-wrap:wrap">
            <a href="mailto:<?= e($msg['email'] ?? '') ?>?subject=Re: <?= urlencode($msg['subject'] ?? 'Your enquiry') ?>"
               class="btn-a btn-a-accent">Reply via Email</a>
            <form action="<?= url('admin/contacts/'.$msg['id'].'/delete') ?>" method="post"
                  onsubmit="return confirm('Permanently delete this message?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn-a btn-a-danger">Delete Message</button>
            </form>
        </div>

    </div>
</div>
