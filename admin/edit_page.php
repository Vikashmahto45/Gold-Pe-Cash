<?php
// admin/edit_page.php — Create or Edit Dynamic Pages
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
    $content = $_POST['content'] ?? '';
    $meta_title = $_POST['meta_title'] ?? '';
    $meta_desc = $_POST['meta_desc'] ?? '';
    $meta_keywords = $_POST['meta_keywords'] ?? '';
    $status = $_POST['status'] ?? 'published';
    $featured_image = $_POST['existing_image'] ?? '';

    // Handle Image Upload
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/images/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        
        $filename = time() . '_' . $_FILES['featured_image']['name'];
        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $upload_dir . $filename)) {
            $featured_image = 'assets/images/' . $filename;
        }
    }

    if ($id) {
        // Update
        try {
            $stmt = $pdo->prepare("UPDATE dynamic_pages SET title=?, slug=?, content=?, meta_title=?, meta_desc=?, meta_keywords=?, featured_image=?, status=? WHERE id=?");
            $stmt->execute([$title, $slug, $content, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status, $id]);
            $success = "Page updated successfully!";
        } catch (PDOException $e) {
            $error = "Error updating: " . $e->getMessage();
        }
    } else {
        // Create
        try {
            $stmt = $pdo->prepare("INSERT INTO dynamic_pages (title, slug, content, meta_title, meta_desc, meta_keywords, featured_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $content, $meta_title, $meta_desc, $meta_keywords, $featured_image, $status]);
            $id = $pdo->lastInsertId();
            $success = "Page created successfully!";
            header("Location: edit_page.php?id=$id&success=" . urlencode($success));
            exit;
        } catch (PDOException $e) {
            $error = "Error creating: " . $e->getMessage();
        }
    }
}

if (isset($_GET['success'])) $success = $_GET['success'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Edit' : 'Create' ?> Page — Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background: #f4f6f9; color: #333; margin: 0; }
        .topbar { background: #4b0000; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem; color: #555; }
        input[type="text"], textarea, select { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; font-size: 1rem; }
        textarea { height: 300px; }
        .btn { padding: 12px 25px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; text-decoration: none; display: inline-block; }
        .btn-primary { background: #4b0000; color: white; }
        .btn-secondary { background: #eee; color: #333; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-error { background: #fee2e2; color: #991b1b; }
        
        .toolbar { background: #f8f9fa; padding: 10px; border: 1px solid #ddd; border-bottom: none; border-top-left-radius: 8px; border-top-right-radius: 8px; display: flex; gap: 10px; flex-wrap: wrap; }
        .tool-btn { background: white; border: 1px solid #ccc; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 0.8rem; }
        .tool-btn:hover { background: #eee; }
        
        .flex-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    </style>
</head>
<body>
    <div class="topbar">
        <div><i class="fas fa-edit"></i> <strong>Gold Pe Cash</strong> — CMS</div>
        <a href="dashboard.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="container">
        <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="card">
                <h2 style="margin-top:0;"><?= $id ? 'Edit Page' : 'Create New Page' ?></h2>
                
                <div class="flex-row">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($page['title'] ?? '') ?>" placeholder="e.g. How to Sell Gold" required id="titleInput">
                    </div>
                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" name="slug" value="<?= htmlspecialchars($page['slug'] ?? '') ?>" placeholder="e.g. how-to-sell-gold" required id="slugInput">
                    </div>
                </div>

                <div class="form-group">
                    <label>Page Content (HTML Allowed)</label>
                    <div class="toolbar">
                        <strong>Insert Structure:</strong>
                        <button type="button" class="tool-btn" onclick="insertContent('heading')">H2 Heading</button>
                        <button type="button" class="tool-btn" onclick="insertContent('para')">Paragraph</button>
                        <button type="button" class="tool-btn" onclick="insertContent('box')">Highlight Box</button>
                        <button type="button" class="tool-btn" onclick="insertContent('img_left')">Image Left + Text</button>
                        <button type="button" class="tool-btn" onclick="insertContent('img_right')">Text + Image Right</button>
                        <button type="button" class="tool-btn" onclick="insertContent('cta')">CTA Button</button>
                    </div>
                    <textarea name="content" id="contentArea" style="border-top-left-radius:0; border-top-right-radius:0;"><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label>Featured Image</label>
                    <?php if ($page['featured_image'] ?? ''): ?>
                        <div style="margin-bottom:10px;"><img src="../<?= $page['featured_image'] ?>" style="height:100px; border-radius:8px;"></div>
                        <input type="hidden" name="existing_image" value="<?= $page['featured_image'] ?>">
                    <?php endif; ?>
                    <input type="file" name="featured_image" accept="image/*">
                </div>

                <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">
                <h3>SEO Settings</h3>
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_desc" style="height:80px;"><?= htmlspecialchars($page['meta_desc'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label>Keywords (Comma separated)</label>
                    <input type="text" name="meta_keywords" value="<?= htmlspecialchars($page['meta_keywords'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="published" <?= ($page['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>

                <div style="margin-top:30px;">
                    <button type="submit" class="btn btn-primary">Save Page</button>
                    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Auto-slug generation
        const titleInput = document.getElementById('titleInput');
        const slugInput = document.getElementById('slugInput');
        
        if (!<?= $id ? 'true' : 'false' ?>) {
            titleInput.addEventListener('input', () => {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            });
        }

        const editor = document.getElementById('contentArea');
        function insertContent(type) {
            let snippet = '';
            switch(type) {
                case 'heading': snippet = '\n<h2>Enter Heading Here</h2>\n'; break;
                case 'para': snippet = '\n<p>Enter your paragraph text here. You can add long content to explain your topic.</p>\n'; break;
                case 'box': snippet = '\n<div class="highlight-box">\n  <strong>Important Note:</strong> Enter some key takeaway or highlighted information here.\n</div>\n'; break;
                case 'img_left': snippet = '\n<div style="display:flex; gap:30px; align-items:center; margin:30px 0; flex-wrap:wrap;">\n  <div style="flex:1; min-width:300px;"><img src="assets/images/Logo.webp" style="width:100%; border-radius:15px;"></div>\n  <div style="flex:1; min-width:300px;">\n    <h3>Section Heading</h3>\n    <p>Enter text that appears next to the image here.</p>\n  </div>\n</div>\n'; break;
                case 'img_right': snippet = '\n<div style="display:flex; gap:30px; align-items:center; margin:30px 0; flex-wrap:wrap; flex-direction:row-reverse;">\n  <div style="flex:1; min-width:300px;"><img src="assets/images/Logo.webp" style="width:100%; border-radius:15px;"></div>\n  <div style="flex:1; min-width:300px;">\n    <h3>Section Heading</h3>\n    <p>Enter text that appears next to the image here.</p>\n  </div>\n</div>\n'; break;
                case 'cta': snippet = '\n<div style="text-align:center; margin:40px 0;">\n  <a href="contact-us" class="btn-gold" style="padding:15px 40px; border-radius:50px; text-decoration:none; display:inline-block; font-weight:700;">Get Cash Now</a>\n</div>\n'; break;
            }
            
            const start = editor.selectionStart;
            const end = editor.selectionEnd;
            editor.value = editor.value.substring(0, start) + snippet + editor.value.substring(end);
            editor.focus();
        }
    </script>
</body>
</html>
