<div class="a-card" style="max-width:500px">
    <div class="a-card-header"><h2>Add Admin User</h2></div>
    <div class="a-card-body">
        <form action="<?= url('admin/admins/create') ?>" method="post" class="a-form">
            <?= csrf_field() ?>

            <div class="a-field">
                <label>Email</label>
                <input type="email" name="email" required autofocus>
            </div>

            <div class="a-field">
                <label>Name <span style="color:var(--a-muted);font-weight:400">(optional)</span></label>
                <input type="text" name="name" placeholder="Display name">
            </div>

            <div class="a-field">
                <label>Password</label>
                <input type="password" name="password" minlength="8" required>
                <div class="hint">Minimum 8 characters.</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-a btn-a-accent">Add Admin</button>
                <a href="<?= url('admin/admins') ?>" class="btn-a btn-a-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
