<?php
// admin/edit_page.php — Visual Block-Based Page Editor
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

// Helper to parse blocks from HTML (very basic)
function parseBlocks($html) {
    // In a real system, we'd store JSON, but for now we'll just store HTML 
    // and provide a simple way to append new blocks.
    // However, to make it "simple" for the user, we should probably store JSON 
    // and render HTML on the fly.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_desc = $_POST['meta_desc'] ?? '';
    $meta_keywords = $_POST['meta_keywords'] ?? '';
    $status = $_POST['status'] ?? 'published';
    $featured_image = $_POST['existing_image'] ?? '';

    // Convert Blocks to HTML
    $html_content = '';
    if (isset($_POST['blocks'])) {
        foreach ($_POST['blocks'] as $block) {
            $type = $block['type'];
            if ($type === 'heading') {
                $html_content .= "\n<h2>" . htmlspecialchars($block['val']) . "</h2>\n";
            } elseif ($type === 'text') {
                $html_content .= "\n<p>" . nl2br(htmlspecialchars($block['val'])) . "</p>\n";
            } elseif ($type === 'cta') {
                $html_content .= "\n<div style='text-align:center; margin:40px 0;'><a href='".htmlspecialchars($block['link'])."' class='btn-gold' style='padding:15px 40px; border-radius:50px; text-decoration:none; display:inline-block; font-weight:700;'>".htmlspecialchars($block['text'])."</a></div>\n";
            } elseif ($type === 'image_text') {
                $dir = ($block['pos'] === 'right') ? 'row-reverse' : 'row';
                $html_content .= "\n<div style='display:flex; gap:30px; align-items:center; margin:30px 0; flex-wrap:wrap; flex-direction:$dir;'>\n";
                $html_content .= "  <div style='flex:1; min-width:300px;'><img src='".htmlspecialchars($block['img'])."' style='width:100%; border-radius:15px;'></div>\n";
                $html_content .= "  <div style='flex:1; min-width:300px;'><h3>".htmlspecialchars($block['title'])."</h3><p>".nl2br(htmlspecialchars($block['text']))."</p></div>\n";
                $html_content .= "</div>\n";
            }
        }
    } else {
        // Fallback to manual content if blocks not used
        $html_content = $_POST['content'] ?? '';
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
            $stmt->execute([$title, $slug, $html_content, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status, $id]);
            $success = "Page updated successfully!";
        } catch (PDOException $e) { $error = "Error: " . $e->getMessage(); }
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO dynamic_pages (title, slug, content, meta_title, meta_desc, meta_keywords, featured_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $html_content, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status]);
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
        .section-box .remove-btn { position: absolute; top: 10px; right: 10px; color: #ff4d4d; cursor: pointer; font-size: 1.2rem; }
        .section-type-badge { display: inline-block; padding: 3px 10px; background: #4b0000; color: white; border-radius: 20px; font-size: 0.7rem; font-weight: 700; margin-bottom: 15px; }
        
        .add-btns { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 30px; }
        .add-btn { background: white; border: 2px dashed #ddd; padding: 15px 20px; border-radius: 12px; cursor: pointer; flex: 1; min-width: 150px; text-align: center; transition: 0.3s; }
        .add-btn:hover { border-color: #4b0000; color: #4b0000; background: #fff5f5; }
        .add-btn i { display: block; font-size: 1.5rem; margin-bottom: 5px; }
        
        .btn-save { background: linear-gradient(135deg, #4b0000, #800000); color: white; border: none; padding: 15px 40px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; width: 100%; box-shadow: 0 10px 20px rgba(75,0,0,0.2); }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 15px 25px rgba(75,0,0,0.3); }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="topbar">
        <div><strong>Gold Pe Cash</strong> — Simple Page Builder</div>
        <a href="dashboard.php" style="color:white; text-decoration:none;"><i class="fas fa-times"></i> Exit</a>
    </div>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
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
            <p style="color:#888; font-size:0.9rem; margin-bottom:20px;">Click the buttons below to add sections to your page. No code needed!</p>
            
            <div id="blocks-container">
                <!-- Blocks will appear here -->
            </div>

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
                    <label>Meta Description (for Google)</label>
                    <textarea name="meta_desc" style="height:80px;"><?= htmlspecialchars($page['meta_desc'] ?? '') ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Page</button>
        </form>
    </div>

    <script>
        let blockCount = 0;
        const container = document.getElementById('blocks-container');

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
                html += `<textarea name="blocks[${id}][val]" placeholder="Enter long text or paragraphs here...">${data.val || ''}</textarea>`;
            } else if (type === 'cta') {
                html += `<span class="section-type-badge">BUTTON</span>`;
                html += `<div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                            <input type="text" name="blocks[${id}][text]" placeholder="Button Text (e.g. Call Us)" value="${data.text || ''}">
                            <input type="text" name="blocks[${id}][link]" placeholder="Link (e.g. contact-us)" value="${data.link || ''}">
                         </div>`;
            } else if (type === 'image_text') {
                html += `<span class="section-type-badge">IMAGE + TEXT</span>`;
                html += `<input type="text" name="blocks[${id}][img]" placeholder="Image URL (e.g. assets/images/Logo.webp)" value="${data.img || 'assets/images/Logo.webp'}">
                         <input type="text" name="blocks[${id}][title]" placeholder="Heading" style="margin:10px 0;" value="${data.title || ''}">
                         <textarea name="blocks[${id}][text]" placeholder="Content text...">${data.text || ''}</textarea>
                         <select name="blocks[${id}][pos]" style="margin-top:10px;">
                            <option value="left">Image on Left</option>
                            <option value="right">Image on Right</option>
                         </select>`;
            }
            
            div.innerHTML = html;
            container.appendChild(div);
        }

        // Auto Slug
        const titleIn = document.getElementById('titleIn');
        const slugIn = document.getElementById('slugIn');
        titleIn.addEventListener('input', () => {
            if (slugIn.value === '' || slugIn.dataset.auto === 'true') {
                slugIn.value = titleIn.value.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
                slugIn.dataset.auto = 'true';
            }
        });

        // Initialize with one heading if new
        <?php if (!$id): ?>
            addBlock('heading', {val: 'Welcome to My New Page'});
            addBlock('text', {val: 'Start typing your content here...'});
        <?php endif; ?>
    </script>
</body>
</html>
