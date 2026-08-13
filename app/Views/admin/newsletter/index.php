<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem">
    <div>
        <h2 style="font-size:1.05rem;margin:0">Newsletter Subscribers</h2>
        <div style="font-size:.82rem;color:var(--a-text-muted);margin-top:.2rem"><?= number_format($total) ?> total subscribers</div>
    </div>
    <div style="display:flex;gap:.5rem;align-items:center;flex-wrap:wrap">
        <a href="<?= url('admin/newsletter/campaign') ?>" class="btn-a btn-a-accent btn-a-sm">&#9993; Send Campaign</a>
        <a href="<?= url('admin/settings') ?>" class="btn-a btn-a-outline btn-a-sm">&#8592; Settings</a>
    </div>
</div>

<div class="a-card">
    <div class="a-card-body" style="padding:0">
    <?php if (empty($subscribers)): ?>
        <div style="padding:2.5rem;text-align:center;color:var(--a-text-muted)">
            No subscribers yet. The newsletter signup form appears in the site footer when enabled in Settings.
        </div>
    <?php else: ?>
        <table class="a-table" style="width:100%;border-collapse:collapse">
            <thead>
                <tr>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">Email</th>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">Source</th>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">Subscribed</th>
                    <th style="padding:.65rem 1rem;border-bottom:1px solid var(--a-border)"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($subscribers as $sub): ?>
                <tr>
                    <td style="padding:.65rem 1rem;font-size:.88rem;border-bottom:1px solid var(--a-border)"><?= e($sub['email']) ?></td>
                    <td style="padding:.65rem 1rem;font-size:.82rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border)"><?= e($sub['source'] ?? 'footer') ?></td>
                    <td style="padding:.65rem 1rem;font-size:.82rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border)"><?= date('d M Y', strtotime($sub['created_at'])) ?></td>
                    <td style="padding:.65rem 1rem;border-bottom:1px solid var(--a-border);text-align:right">
                        <form action="<?= url('admin/newsletter/'.$sub['id'].'/delete') ?>" method="post"
                              onsubmit="return confirm('Remove this subscriber?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-a btn-a-danger btn-a-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($pages > 1): ?>
        <div style="padding:1rem;display:flex;gap:.4rem;justify-content:center">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i ?>"
               style="padding:.3rem .65rem;border-radius:5px;font-size:.82rem;font-weight:600;text-decoration:none;
               background:<?= $i===$page ? 'var(--a-accent)' : 'var(--a-card-bg)' ?>;
               color:<?= $i===$page ? 'var(--navy-dark)' : 'var(--a-text-main)' ?>;
               border:1px solid var(--a-border)"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    </div>
</div>
