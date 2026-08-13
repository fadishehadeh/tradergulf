<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> | Trader Gulf Admin</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body>

<!-- ========== SIDEBAR ========== -->
<aside class="admin-sidebar">
    <a href="<?= url('admin') ?>" class="sidebar-brand">
        <div class="brand-main">Trader<span>Gulf</span></div>
        <div class="brand-sub">Admin Panel</div>
    </a>

    <nav class="sidebar-nav">
        <?php
        $currentPath = ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
        $adminBase   = ltrim(parse_url(url('admin'), PHP_URL_PATH), '/');
        function adminNavLink(string $href, string $icon, string $label, string $current, string $base): void {
            $path    = ltrim(parse_url($href, PHP_URL_PATH), '/');
            $active  = ($current === $path || ($path !== $base && str_starts_with($current, $path . '/')));
            $class   = $active ? ' active' : '';
            echo "<a href=\"$href\" class=\"$class\"><span class=\"nav-icon\">$icon</span> $label</a>";
        }
        ?>

        <div class="sidebar-section">Main</div>
        <?php adminNavLink(url('admin'), '📊', 'Dashboard', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/analytics'), '📈', 'Analytics', $currentPath, $adminBase); ?>

        <div class="sidebar-section">Content</div>
        <?php adminNavLink(url('admin/brokers'), '🏦', 'Brokers', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/articles'), '📝', 'Articles', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/glossary'), '📖', 'Glossary', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/pages'), '📄', 'Static Pages', $currentPath, $adminBase); ?>

        <div class="sidebar-section">Marketing</div>
        <?php adminNavLink(url('admin/ads'), '💰', 'Ad Spaces', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/banners'), '🖼️', 'IB Banners', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/seo'), '🔍', 'SEO Pages', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/sitemap'), '🗺️', 'Sitemap', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/newsletter'), '📧', 'Newsletter', $currentPath, $adminBase); ?>

        <div class="sidebar-section">Inbox</div>
        <?php
        $unreadCount = (int)(app()->database()->fetchValue('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0') ?? 0);
        $contactLabel = 'Messages' . ($unreadCount > 0 ? ' <span style="background:var(--a-accent);color:var(--navy-dark);border-radius:10px;padding:1px 6px;font-size:.68rem;font-weight:700;margin-left:.3rem">' . $unreadCount . '</span>' : '');
        adminNavLink(url('admin/contacts'), '✉️', $contactLabel, $currentPath, $adminBase);
        ?>

        <div class="sidebar-section">System</div>
        <?php adminNavLink(url('admin/admins'), '👥', 'Admin Users', $currentPath, $adminBase); ?>
        <?php adminNavLink(url('admin/settings'), '⚙️', 'Settings', $currentPath, $adminBase); ?>

        <div class="sidebar-section" style="margin-top:auto"></div>
        <a href="<?= url() ?>" target="_blank"><span class="nav-icon">🌐</span> View Site</a>
    </nav>

    <div class="sidebar-footer">
        Logged in as <strong style="color:rgba(255,255,255,.6)"><?= e(session()->get('admin_name', session()->get('admin_user', 'admin'))) ?></strong>
    </div>
</aside>

<!-- ========== MAIN ========== -->
<div class="admin-main">

    <div class="admin-topbar">
        <h1><?= e($pageTitle ?? 'Admin') ?></h1>
        <div class="topbar-right">
            <form action="<?= url('admin/logout') ?>" method="post" style="margin:0">
                <?= csrf_field() ?>
                <button type="submit" class="btn-a btn-a-ghost btn-a-sm">Logout</button>
            </form>
        </div>
    </div>

    <div class="admin-content">
        <?php if (!empty($_flash_success)): ?>
        <div class="flash flash-success">✓ <?= e($_flash_success) ?></div>
        <?php endif; ?>
        <?php if (!empty($_flash_error)): ?>
        <div class="flash flash-error">✕ <?= e($_flash_error) ?></div>
        <?php endif; ?>

        <?= $content ?>
    </div>
</div>

</body>
</html>
