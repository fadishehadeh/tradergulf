<div class="a-card">
    <div class="a-card-header">
        <h2><?= e($banner['label'] ?? $banner['position']) ?></h2>
        <div style="display:flex;gap:.5rem">
            <?php if ($banner['type'] === 'landscape'): ?>
            <span class="badge badge-blue">Landscape 728×90</span>
            <?php else: ?>
            <span class="badge badge-amber">Portrait 300×600</span>
            <?php endif; ?>
            <a href="<?= url('admin/banners') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
        </div>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" enctype="multipart/form-data" class="a-form">
        <?= csrf_field() ?>
        <input type="hidden" name="clear_image" id="clearImageFlag" value="0">

        <div class="section-divider">Affiliate Link</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="link_url">Affiliate / Destination URL <span class="req">*</span></label>
                <input type="url" id="link_url" name="link_url"
                       value="<?= e($banner['link_url'] ?? '') ?>"
                       placeholder="https://www.broker.com/your-ib-link">
                <div class="hint">Your IB tracking link. Visitors who click this banner will land here.</div>
            </div>
            <div class="a-field">
                <label for="broker_id">Linked Broker (for portrait stats)</label>
                <select id="broker_id" name="broker_id">
                    <option value="">— None —</option>
                    <?php foreach ($brokers as $br): ?>
                    <option value="<?= (int)$br['id'] ?>" <?= ((int)($banner['broker_id'] ?? 0) === (int)$br['id']) ? 'selected' : '' ?>>
                        <?= e($br['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <div class="hint">Portrait banners auto-display broker stats from the linked record.</div>
            </div>
        </div>

        <div class="section-divider">Banner Copy</div>

        <?php if ($banner['type'] === 'landscape'): ?>
        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="headline">Headline (bold text)</label>
                <input type="text" id="headline" name="headline"
                       value="<?= e($banner['headline'] ?? '') ?>"
                       placeholder="Trade with the world's #1 broker by volume.">
            </div>
            <div class="a-field">
                <label for="cta_text">CTA Button Text</label>
                <input type="text" id="cta_text" name="cta_text"
                       value="<?= e($banner['cta_text'] ?? 'Open Account →') ?>"
                       placeholder="Open Account →">
            </div>
        </div>
        <div class="a-field">
            <label for="sub_text">Supporting Text</label>
            <input type="text" id="sub_text" name="sub_text"
                   value="<?= e($banner['sub_text'] ?? '') ?>"
                   placeholder="Ultra-low spreads · Instant withdrawals · Regulated globally">
            <div class="hint">Separated by · (middle dot). Keep under 120 characters.</div>
        </div>
        <?php else: ?>
        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="badge_text">Badge Text</label>
                <input type="text" id="badge_text" name="badge_text"
                       value="<?= e($banner['badge_text'] ?? '') ?>"
                       placeholder="★ Editor's Pick">
                <div class="hint">Small tag shown at the top of the portrait card.</div>
            </div>
            <div class="a-field">
                <label for="cta_text">CTA Button Text</label>
                <input type="text" id="cta_text" name="cta_text"
                       value="<?= e($banner['cta_text'] ?? 'Open Account →') ?>"
                       placeholder="Trade Now →">
            </div>
        </div>
        <?php endif; ?>

        <div class="section-divider">Banner Image</div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start">

            <!-- Upload -->
            <div class="a-field">
                <label>Upload Image from Your Computer</label>
                <div id="dropZone" style="
                    border:2px dashed var(--border-color,#e2e8f0);border-radius:10px;
                    padding:1.5rem;text-align:center;cursor:pointer;
                    transition:border-color .2s,background .2s;
                    background:var(--card-bg,#f8fafc)">
                    <input type="file" id="banner_image" name="banner_image"
                           accept="image/jpeg,image/png,image/webp,image/gif"
                           style="display:none">
                    <div id="dropZonePrompt">
                        <div style="font-size:1.75rem;margin-bottom:.4rem">🖼️</div>
                        <div style="font-weight:600;font-size:.88rem;margin-bottom:.25rem">Click to upload or drag &amp; drop</div>
                        <div style="font-size:.78rem;color:var(--text-muted,#64748b)">JPG, PNG, WebP, GIF · Max 3 MB</div>
                        <div style="font-size:.75rem;color:var(--text-muted,#64748b);margin-top:.35rem">
                            Recommended: <?= $banner['type'] === 'landscape' ? '728×90 px' : '300×600 px' ?>
                        </div>
                    </div>
                    <img id="uploadPreview" src="" alt="Preview" style="display:none;max-width:100%;max-height:130px;object-fit:contain;border-radius:6px">
                    <div id="uploadFileName" style="font-size:.78rem;color:var(--accent,#34d399);margin-top:.5rem;display:none"></div>
                </div>
                <div class="hint" style="margin-top:.4rem">Uploading a new image replaces any existing one. The file is saved on the server.</div>
            </div>

            <!-- OR: external URL -->
            <div class="a-field">
                <label for="image_url">— or paste an external URL</label>
                <input type="url" id="image_url" name="image_url"
                       value="<?= e($banner['image_url'] ?? '') ?>"
                       placeholder="https://broker.com/banners/728x90.jpg"
                       style="margin-bottom:.5rem">
                <div class="hint">If you upload a file above, this field is ignored. Use this for broker-hosted images when you don't want to store the file here.</div>

                <?php if (!empty($banner['image_url'])): ?>
                <!-- Current image -->
                <div id="currentImageBox" style="margin-top:.85rem;padding:.85rem;background:var(--card-bg,#f8fafc);border:1px solid var(--border-color,#e2e8f0);border-radius:8px">
                    <div style="font-size:.72rem;color:var(--text-muted,#64748b);margin-bottom:.5rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em">Current image</div>
                    <img src="<?= e($banner['image_url']) ?>" alt="Current banner"
                         style="max-width:100%;max-height:100px;object-fit:contain;border-radius:4px;display:block;margin-bottom:.65rem">
                    <button type="button" id="clearImageBtn"
                            style="font-size:.78rem;color:var(--red,#ef4444);background:none;border:1px solid var(--red,#ef4444);border-radius:5px;padding:.3rem .75rem;cursor:pointer">
                        ✕ Remove image
                    </button>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="section-divider">Appearance (fallback card design)</div>
        <div style="font-size:.8rem;color:var(--text-muted,#64748b);margin-bottom:1rem">Used only when no image is set above.</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="bg_style">Background CSS</label>
                <input type="text" id="bg_style" name="bg_style"
                       value="<?= e($banner['bg_style'] ?? '') ?>"
                       placeholder="background:linear-gradient(120deg,#09112a 0%,#0f1b35 100%)">
                <div class="hint">Any valid CSS background property — colour, gradient, or image URL.</div>
            </div>
            <div class="a-field" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem">
                <label class="a-checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= $banner['is_active'] ? 'checked' : '' ?>>
                    <span>Banner is Active (shown on homepage)</span>
                </label>
            </div>
        </div>

        <?php if (!empty($banner['bg_style'])): ?>
        <div style="<?= e($banner['bg_style']) ?>;padding:1rem 1.5rem;border-radius:8px;color:#fff;font-size:.82rem;opacity:.8">
            Background preview
        </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">Save Changes</button>
            <a href="<?= url('admin/banners') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
    </div>
</div>

<script>
(function() {
    var dropZone    = document.getElementById('dropZone');
    var fileInput   = document.getElementById('banner_image');
    var preview     = document.getElementById('uploadPreview');
    var prompt      = document.getElementById('dropZonePrompt');
    var fileName    = document.getElementById('uploadFileName');
    var clearBtn    = document.getElementById('clearImageBtn');
    var clearFlag   = document.getElementById('clearImageFlag');
    var currentBox  = document.getElementById('currentImageBox');
    var urlInput    = document.getElementById('image_url');

    // Click drop zone to open file picker
    dropZone.addEventListener('click', function() { fileInput.click(); });

    // Drag-and-drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.style.borderColor = 'var(--accent,#34d399)';
        dropZone.style.background  = 'rgba(52,211,153,.06)';
    });
    dropZone.addEventListener('dragleave', function() {
        dropZone.style.borderColor = '';
        dropZone.style.background  = '';
    });
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.style.borderColor = '';
        dropZone.style.background  = '';
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            showPreview(e.dataTransfer.files[0]);
        }
    });

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length) showPreview(fileInput.files[0]);
    });

    function showPreview(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            prompt.style.display  = 'none';
            fileName.textContent  = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            fileName.style.display = 'block';
            dropZone.style.borderColor = 'var(--accent,#34d399)';
            // If user picks a file, clear the URL field to avoid ambiguity
            if (urlInput) urlInput.value = '';
            if (currentBox) currentBox.style.opacity = '.4';
        };
        reader.readAsDataURL(file);
    }

    // Remove current image
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            if (!confirm('Remove the current banner image?')) return;
            clearFlag.value = '1';
            if (urlInput) urlInput.value = '';
            if (currentBox) {
                currentBox.innerHTML = '<span style="font-size:.8rem;color:var(--text-muted)">Image will be removed on save.</span>';
            }
        });
    }
})();
</script>
