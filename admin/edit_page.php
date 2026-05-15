<?php
// admin/edit_page.php — Visual Block-Based Page Editor with Quill.js support
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

include '../includes/db.php';

$id = $_GET['id'] ?? null;
$page = null;
$success = '';
$error = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM dynamic_pages WHERE id = ?");
    $stmt->execute([$id]);
    $page = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_desc = $_POST['meta_desc'] ?? '';
    $meta_keywords = $_POST['meta_keywords'] ?? '';
    $status = $_POST['status'] ?? 'published';
    $featured_image = $_POST['existing_image'] ?? '';

    // Convert Blocks to JSON instead of flat HTML to preserve structure
    if (isset($_POST['blocks'])) {
        $blocks = $_POST['blocks'];
        
        // Handle Block Image Uploads
        if (isset($_FILES['block_images'])) {
            foreach ($_FILES['block_images']['name'] as $id => $name) {
                if ($_FILES['block_images']['error'][$id] === UPLOAD_ERR_OK) {
                    $upload_dir = '../assets/images/';
                    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
                    $filename = 'blk_' . time() . '_' . $name;
                    if (move_uploaded_file($_FILES['block_images']['tmp_name'][$id], $upload_dir . $filename)) {
                        $blocks[$id]['img'] = 'assets/images/' . $filename;
                    }
                }
            }
        }
        $blocks_json = json_encode($blocks);
    }

    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/images/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $filename = time() . '_' . $_FILES['featured_image']['name'];
        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $upload_dir . $filename)) {
            $featured_image = 'assets/images/' . $filename;
        }
    }

    if ($id) {
        try {
            $stmt = $pdo->prepare("UPDATE dynamic_pages SET title=?, slug=?, content=?, meta_title=?, meta_desc=?, meta_keywords=?, featured_image=?, status=? WHERE id=?");
            $stmt->execute([$title, $slug, $blocks_json, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status, $id]);
            $success = "Page updated successfully!";
        } catch (PDOException $e) { $error = "Error: " . $e->getMessage(); }
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO dynamic_pages (title, slug, content, meta_title, meta_desc, meta_keywords, featured_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $blocks_json, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status]);
            $id = $pdo->lastInsertId();
            header("Location: edit_page.php?id=$id&success=Created"); exit;
        } catch (PDOException $e) { $error = "Error: " . $e->getMessage(); }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visual Editor — Gold Pe Cash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background: #f0f2f5; margin: 0; color: #333; }
        .topbar { background: #4b0000; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; color: #888; margin-bottom: 8px; letter-spacing: 0.5px; }
        input[type="text"], textarea, select { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; font-family: inherit; font-size: 1rem; transition: 0.3s; }
        input:focus, textarea:focus { border-color: #4b0000; outline: none; box-shadow: 0 0 0 3px rgba(75,0,0,0.1); }
        
        .section-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 15px; position: relative; animation: fadeIn 0.3s; }
        .section-box .remove-btn { position: absolute; top: 10px; right: 10px; color: #ff4d4d; cursor: pointer; font-size: 1.2rem; z-index: 10; }
        .section-type-badge { display: inline-block; padding: 3px 10px; background: #4b0000; color: white; border-radius: 20px; font-size: 0.7rem; font-weight: 700; margin-bottom: 15px; }
        
        .add-btns { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 30px; }
        .add-btn { background: white; border: 2px dashed #ddd; padding: 15px 20px; border-radius: 12px; cursor: pointer; flex: 1; min-width: 150px; text-align: center; transition: 0.3s; }
        .add-btn:hover { border-color: #4b0000; color: #4b0000; background: #fff5f5; }
        .add-btn i { display: block; font-size: 1.5rem; margin-bottom: 5px; }
        
        .btn-save { background: linear-gradient(135deg, #4b0000, #800000); color: white; border: none; padding: 15px 40px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; width: 100%; box-shadow: 0 10px 20px rgba(75,0,0,0.2); }
        
        /* Quill Editor Tweaks */
        .ql-container { background: white; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; min-height: 150px; font-family: 'Outfit', sans-serif; font-size: 1rem; }
        .ql-toolbar { background: #eee; border-top-left-radius: 10px; border-top-right-radius: 10px; border-color: #ddd !important; }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="topbar">
        <div><strong>Gold Pe Cash</strong> — Simple Page Builder</div>
        <a href="dashboard.php" style="color:white; text-decoration:none;"><i class="fas fa-times"></i> Exit</a>
    </div>

    <div class="container">
        <?php if ($success): ?><div style="background:#d1fae5; color:#065f46; padding:15px; border-radius:10px; margin-bottom:20px;"><?= $success ?></div><?php endif; ?>
        <form method="POST" enctype="multipart/form-data" id="mainForm">
            <div class="card">
                <div class="form-group">
                    <label>Page Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($page['title'] ?? '') ?>" placeholder="e.g. Sell Gold in 3 Easy Steps" required id="titleIn">
                </div>
                <div class="form-group">
                    <label>URL Address (Slug)</label>
                    <input type="text" name="slug" value="<?= htmlspecialchars($page['slug'] ?? '') ?>" placeholder="e.g. sell-gold-steps" required id="slugIn">
                </div>
            </div>

            <h3 style="margin: 30px 0 15px; color: #4b0000;">Page Content Sections</h3>
            <div id="blocks-container"></div>

            <div class="add-btns">
                <div class="add-btn" onclick="addBlock('heading')"><i class="fas fa-heading"></i> Add Heading</div>
                <div class="add-btn" onclick="addBlock('text')"><i class="fas fa-align-left"></i> Add Text</div>
                <div class="add-btn" onclick="addBlock('image_text')"><i class="fas fa-th-large"></i> Image + Text</div>
                <div class="add-btn" onclick="addBlock('cta')"><i class="fas fa-mouse-pointer"></i> Add Button</div>
            </div>

            <div class="card">
                <h3>SEO & Image</h3>
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="featured_image">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_desc" style="height:80px;"><?= htmlspecialchars($page['meta_desc'] ?? '') ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Page</button>
        </form>
    </div>

    <!-- Quill.js JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        let blockCount = 0;
        const container = document.getElementById('blocks-container');
        const quills = {};

        function addBlock(type, data = {}) {
            const id = blockCount++;
            const div = document.createElement('div');
            div.className = 'section-box';
            div.id = 'block-' + id;
            
            let html = `<i class="fas fa-trash remove-btn" onclick="this.parentElement.remove()"></i>`;
            html += `<input type="hidden" name="blocks[${id}][type]" value="${type}">`;
            
            if (type === 'heading') {
                html += `<span class="section-type-badge">HEADING</span>`;
                html += `<input type="text" name="blocks[${id}][val]" placeholder="Enter Heading Text Here..." value="${data.val || ''}">`;
            } else if (type === 'text') {
                html += `<span class="section-type-badge">PARAGRAPH</span>`;
                html += `<input type="hidden" name="blocks[${id}][val]" id="input-${id}">`;
                html += `<div id="editor-${id}" class="quill-editor">${data.val || ''}</div>`;
            } else if (type === 'cta') {
                html += `<span class="section-type-badge">BUTTON</span>`;
                html += `<div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                            <input type="text" name="blocks[${id}][text]" placeholder="Button Text" value="${data.text || ''}">
                            <input type="text" name="blocks[${id}][link]" placeholder="Link" value="${data.link || ''}">
                         </div>`;
            } else if (type === 'image_text') {
                html += `<span class="section-type-badge">IMAGE + TEXT</span>`;
                html += `<div style="margin-bottom:10px;">
                            <label style="display:inline-block; margin-right:10px;">Upload Image:</label>
                            <input type="file" name="block_images[${id}]" accept="image/*">
                            <input type="hidden" name="blocks[${id}][img]" value="${data.img || 'assets/images/Logo.webp'}">
                         </div>
                         <input type="text" name="blocks[${id}][title]" placeholder="Heading" style="margin:10px 0;" value="${data.title || ''}">
                         <input type="hidden" name="blocks[${id}][text]" id="input-${id}">
                         <div id="editor-${id}" class="quill-editor">${data.text || ''}</div>
                         <select name="blocks[${id}][pos]" style="margin-top:10px;">
                            <option value="left" ${data.pos==='left'?'selected':''}>Image on Left</option>
                            <option value="right" ${data.pos==='right'?'selected':''}>Image on Right</option>
                         </select>`;
            }
            
            div.innerHTML = html;
            container.appendChild(div);

            // Initialize Quill for text/image_text
            if (type === 'text' || type === 'image_text') {
                const q = new Quill('#editor-' + id, {
                    theme: 'snow',
                    modules: { toolbar: [
                        ['bold', 'italic', 'link'], 
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }], 
                        ['clean']
                    ] }
                });
                quills[id] = q;
            }
        }

        // Sync Quill content to hidden inputs before submit
        document.getElementById('mainForm').onsubmit = function() {
            for (let id in quills) {
                const input = document.getElementById('input-' + id);
                if (input) {
                    input.value = quills[id].root.innerHTML;
                }
            }
        };

        // Auto Slug logic
        const titleIn = document.getElementById('titleIn');
        const slugIn = document.getElementById('slugIn');
        titleIn.addEventListener('input', () => {
            if (slugIn.value === '' || slugIn.dataset.auto === 'true') {
                slugIn.value = titleIn.value.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
                slugIn.dataset.auto = 'true';
            }
        });

        // Initialize with existing blocks or default blocks
        <?php 
        $existingContent = $page['content'] ?? '';
        $existingBlocks = json_decode($existingContent, true);
        
        // MIGRATION LOGIC: If content exists but isn't JSON, it's legacy HTML.
        // Wrap it in a 'text' block so it doesn't get lost.
        if (!$existingBlocks && !empty($existingContent)) {
            $existingBlocks = [
                ['type' => 'text', 'val' => $existingContent]
            ];
        }

        if ($existingBlocks && is_array($existingBlocks)): 
            foreach ($existingBlocks as $b): ?>
                addBlock('<?= $b['type'] ?>', <?= json_encode($b, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>);
            <?php endforeach; 
        elseif (!$id): ?>
            addBlock('heading', {val: 'Welcome to My New Page'});
            addBlock('text', {val: '<p>Start typing your content here...</p>'});
        <?php endif; ?>
    </script>
</body>
</html>
