<div class="a-card" style="max-width:800px">
    <div class="a-card-header" style="display:flex;justify-content:space-between;align-items:center">
        <h2>Admin Users</h2>
        <a href="<?= url('admin/admins/create') ?>" class="btn-a btn-a-accent">+ Add Admin</a>
    </div>
    <div class="a-card-body" style="padding:0">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($admins as $a): $isSelf = ((int)$a['id'] === (int)session()->get('admin_id')); ?>
                <tr>
                    <td><?= e($a['email']) ?> <?= $isSelf ? '<span style="font-size:.72rem;background:var(--a-accent);color:#fff;border-radius:4px;padding:1px 5px">you</span>' : '' ?></td>
                    <td><?= e($a['name'] ?: '—') ?></td>
                    <td><span class="badge <?= $a['is_active'] ? 'badge-green' : 'badge-red' ?>"><?= $a['is_active'] ? 'Active' : 'Inactive' ?></span></td>
                    <td style="font-size:.82rem;color:var(--a-muted)"><?= e(date('M j, Y', strtotime($a['created_at']))) ?></td>
                    <td>
                        <!-- Change password inline -->
                        <button onclick="document.getElementById('pwform-<?= $a['id'] ?>').style.display='block';this.style.display='none'"
                                class="btn-a btn-a-outline" style="font-size:.78rem;padding:.2rem .6rem">Change Password</button>
                        <?php if (!$isSelf): ?>
                        <form method="post" action="<?= url('admin/admins/' . $a['id'] . '/delete') ?>" style="display:inline"
                              onsubmit="return confirm('Remove <?= e(addslashes($a['email'])) ?>?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-a btn-a-danger" style="font-size:.78rem;padding:.2rem .6rem">Remove</button>
                        </form>
                        <?php endif; ?>
                        <!-- Password change form (hidden) -->
                        <form id="pwform-<?= $a['id'] ?>" method="post" action="<?= url('admin/admins/' . $a['id'] . '/password') ?>"
                              style="display:none;margin-top:.5rem;display:none">
                            <?= csrf_field() ?>
                            <div style="display:flex;gap:.4rem;align-items:center">
                                <input type="password" name="password" placeholder="New password (8+ chars)" minlength="8"
                                       style="font-size:.8rem;padding:.3rem .5rem;border:1px solid var(--a-border);border-radius:4px;background:var(--a-bg);color:var(--a-text)">
                                <button type="submit" class="btn-a btn-a-accent" style="font-size:.78rem;padding:.25rem .6rem">Save</button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
