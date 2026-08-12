<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem">
    <div>
        <h2 style="font-size:1.05rem;margin:0">Contact Messages</h2>
        <div style="font-size:.82rem;color:var(--a-text-muted);margin-top:.2rem">
            <?= number_format($total) ?> total &nbsp;·&nbsp;
            <?php if ($unread > 0): ?>
            <span style="color:var(--a-accent);font-weight:700"><?= $unread ?> unread</span>
            <?php else: ?>
            all read
            <?php endif; ?>
        </div>
    </div>
    <div style="display:flex;gap:.5rem">
        <a href="?filter=all"   class="btn-a btn-a-sm <?= $filter==='all'   ? 'btn-a-accent' : 'btn-a-ghost' ?>">All</a>
        <a href="?filter=unread" class="btn-a btn-a-sm <?= $filter==='unread' ? 'btn-a-accent' : 'btn-a-ghost' ?>">Unread</a>
    </div>
</div>

<div class="a-card">
    <div class="a-card-body" style="padding:0">
    <?php if (empty($messages)): ?>
        <div style="padding:2.5rem;text-align:center;color:var(--a-text-muted)">
            <?= $filter==='unread' ? 'No unread messages.' : 'No contact messages yet.' ?>
        </div>
    <?php else: ?>
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">From</th>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">Subject / Preview</th>
                    <th style="text-align:left;padding:.65rem 1rem;font-size:.78rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);font-weight:600">Date</th>
                    <th style="padding:.65rem 1rem;border-bottom:1px solid var(--a-border)"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $msg): ?>
                <?php $unreadRow = !(bool)$msg['is_read']; ?>
                <tr style="<?= $unreadRow ? 'background:rgba(52,211,153,.04)' : '' ?>">
                    <td style="padding:.65rem 1rem;font-size:.88rem;border-bottom:1px solid var(--a-border);white-space:nowrap">
                        <?php if ($unreadRow): ?><span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--a-accent);margin-right:.4rem;vertical-align:middle"></span><?php endif; ?>
                        <strong style="font-weight:<?= $unreadRow ? '700' : '500' ?>"><?= e($msg['name'] ?? '—') ?></strong>
                        <div style="font-size:.75rem;color:var(--a-text-muted)"><?= e($msg['email'] ?? '') ?></div>
                    </td>
                    <td style="padding:.65rem 1rem;font-size:.85rem;border-bottom:1px solid var(--a-border);max-width:380px">
                        <?php if (!empty($msg['subject'])): ?>
                        <div style="font-weight:600;margin-bottom:.15rem"><?= e($msg['subject']) ?></div>
                        <?php endif; ?>
                        <div style="color:var(--a-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                            <?= e(substr($msg['message'] ?? '', 0, 120)) ?>
                        </div>
                    </td>
                    <td style="padding:.65rem 1rem;font-size:.82rem;color:var(--a-text-muted);border-bottom:1px solid var(--a-border);white-space:nowrap">
                        <?= date('d M Y', strtotime($msg['created_at'])) ?>
                    </td>
                    <td style="padding:.65rem 1rem;border-bottom:1px solid var(--a-border);text-align:right;white-space:nowrap">
                        <a href="<?= url('admin/contacts/'.$msg['id']) ?>" class="btn-a btn-a-sm btn-a-outline">View</a>
                        <form action="<?= url('admin/contacts/'.$msg['id'].'/delete') ?>" method="post"
                              style="display:inline" onsubmit="return confirm('Delete this message?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-a btn-a-sm btn-a-danger" style="margin-left:.25rem">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($pages > 1): ?>
        <div style="padding:1rem;display:flex;gap:.4rem;justify-content:center">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= $i ?>&filter=<?= e($filter) ?>"
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
