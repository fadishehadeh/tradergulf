<div class="page-header">
    <div class="container">
        <h1>Forex Glossary</h1>
        <p>Plain-English definitions of key trading terms every forex trader needs to know.</p>
    </div>
</div>

<div class="container">

    <nav class="glossary-nav" aria-label="Glossary alphabet">
        <?php
        $alphabet = range('A', 'Z');
        foreach ($alphabet as $letter):
            $hasTerms = isset($grouped[$letter]);
        ?>
        <?php if ($hasTerms): ?>
        <a href="#letter-<?= $letter ?>" class="<?= $hasTerms ? '' : 'disabled' ?>"><?= $letter ?></a>
        <?php else: ?>
        <span style="display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:4px;background:var(--bg);color:var(--border);font-size:.9rem;font-weight:700"><?= $letter ?></span>
        <?php endif; ?>
        <?php endforeach; ?>
    </nav>

    <?php foreach ($grouped as $letter => $terms): ?>
    <div class="glossary-section" id="letter-<?= $letter ?>">
        <div class="glossary-letter"><?= $letter ?></div>
        <ul class="glossary-list">
            <?php foreach ($terms as $term): ?>
            <li>
                <a href="<?= url('glossary/' . $term['slug']) ?>"><?= e($term['term']) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>

    <?php if (empty($grouped)): ?>
    <p style="color:var(--muted);text-align:center;padding:3rem 0">No glossary terms yet. Check back soon.</p>
    <?php endif; ?>

</div>
