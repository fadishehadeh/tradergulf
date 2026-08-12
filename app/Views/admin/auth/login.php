<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Trader Gulf</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body>

<div class="login-wrap">
    <div class="login-card">
        <div class="login-logo">
            <div class="brand-main">Trader<span>Gulf</span></div>
            <div class="brand-sub">Admin Panel</div>
        </div>

        <?php if (!empty($_flash_error)): ?>
        <div class="flash flash-error" style="margin-bottom:1.25rem">✕ <?= e($_flash_error) ?></div>
        <?php endif; ?>

        <form action="<?= url('admin/login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="a-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="username"
                       required autofocus>
            </div>

            <div class="a-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password"
                       required>
            </div>

            <button type="submit" class="login-submit">Sign In</button>
        </form>

        <p style="text-align:center;margin-top:1.25rem;font-size:.78rem;color:#94a3b8">
            <a href="<?= url() ?>" style="color:#64748b;text-decoration:none">← Back to site</a>
        </p>
    </div>
</div>

</body>
</html>
