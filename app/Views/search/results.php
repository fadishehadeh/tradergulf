<div class="page-header">
    <div class="container">
        <h1>Search Trader Gulf</h1>
    </div>
</div>

<div class="container" style="max-width:760px;padding:2rem 1rem 3rem">

    <form action="<?= url('search') ?>" method="get" style="display:flex;gap:.75rem;margin-bottom:2.5rem">
        <input type="text" name="q" value="<?= e($q) ?>"
               placeholder="Search brokers, guides, glossary…"
               autofocus autocomplete="off"
               style="flex:1;padding:.7rem 1rem;border:1px solid var(--border);border-radius:8px;background:var(--card-bg);color:var(--text-main);font-size:1rem;outline:none">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php if ($q && empty($results)): ?>
    <p style="color:var(--text-muted)">No results found for "<strong><?= e($q) ?></strong>". Try a different keyword.</p>
    <div style="margin-top:2rem">
        <h3 style="font-size:1rem;margin-bottom:.75rem">Try exploring:</h3>
        <div style="display:flex;flex-wrap:wrap;gap:.5rem">
            <a href="<?= url('brokers') ?>" class="btn btn-ghost btn-sm">All Brokers</a>
            <a href="<?= url('compare') ?>" class="btn btn-ghost btn-sm">Compare Brokers</a>
            <a href="<?= url('guides') ?>" class="btn btn-ghost btn-sm">Trading Guides</a>
            <a href="<?= url('glossary') ?>" class="btn btn-ghost btn-sm">Glossary</a>
        </div>
    </div>

    <?php elseif (!$q): ?>
    <p style="color:var(--text-muted)">Enter a search term above to find brokers, guides, and glossary terms.</p>

    <?php else: ?>
    <p style="color:var(--text-muted);margin-bottom:1.5rem;font-size:.88rem">
        <?= count($results) ?> result<?= count($results) !== 1 ? 's' : '' ?> for "<?= e($q) ?>"
    </p>

    <?php foreach ($results as $r): ?>
    <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.4rem;margin-bottom:.85rem">
        <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.07em;color:var(--accent);font-weight:700;margin-bottom:.3rem">
            <?= e($r['meta']) ?>
        </div>
        <h3 style="margin:0 0 .4rem;font-size:1rem">
            <a href="<?= e($r['url']) ?>" style="color:var(--text-main);text-decoration:none"><?= e($r['title']) ?></a>
        </h3>
        <?php if (!empty($r['excerpt'])): ?>
        <p style="color:var(--text-muted);font-size:.87rem;margin:0;line-height:1.55">
            <?= e(substr($r['excerpt'], 0, 200)) ?>
        </p>
        <?php endif; ?>
        <a href="<?= e($r['url']) ?>" style="font-size:.8rem;color:var(--accent);text-decoration:none;margin-top:.5rem;display:inline-block">
            <?= e($r['url']) ?> →
        </a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

</div>
