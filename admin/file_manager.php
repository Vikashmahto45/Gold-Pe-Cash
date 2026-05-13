<?php
// admin/file_manager.php — Built-in Code Editor
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$base_dir = realpath(__DIR__ . '/../'); // Top level htdocs/Gold Pe Cash folder
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : $base_dir;

// Security Sandbox: Ensure the user cannot escape the base directory (e.g. using ../../)
if (strpos($current_dir, $base_dir) !== 0) {
    $current_dir = $base_dir;
}

$message = '';
$file_content = '';
$current_file = isset($_GET['file']) ? realpath($_GET['file']) : '';

// Security Sandbox for File execution
if ($current_file && strpos($current_file, $base_dir) === 0 && file_exists($current_file) && !is_dir($current_file)) {
    $file_content = file_get_contents($current_file);
} else {
    $current_file = ''; // Invalid or out-of-bounds file
}

// ── Handle Save Action ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_file') {
    $save_target = isset($_POST['target_file']) ? realpath($_POST['target_file']) : '';
    if ($save_target && strpos($save_target, $base_dir) === 0 && file_exists($save_target)) {
        $new_content = $_POST['file_content'];
        if (file_put_contents($save_target, $new_content) !== false) {
            $message = "<div class='alert success'><i class='fas fa-check-circle'></i> File saved successfully.</div>";
            $file_content = file_get_contents($save_target); // Refresh content
        } else {
            $message = "<div class='alert error'><i class='fas fa-exclamation-triangle'></i> Failed to save file. Check permissions.</div>";
        }
    } else {
        $message = "<div class='alert error'><i class='fas fa-shield-alt'></i> Security Error: Invalid file path.</div>";
    }
}

// ── Directory Listing ──────────────────────────────────────────────
$items = scandir($current_dir);
$folders = [];
$files = [];

foreach ($items as $item) {
    if ($item === '.' || $item === '.git' || $item === '.gemini')
        continue; // Hide system dots and git
    if ($item === '..' && $current_dir === $base_dir)
        continue; // Hide "parent" if at project root

    $path = $current_dir . DIRECTORY_SEPARATOR . $item;
    if (is_dir($path)) {
        $folders[] = $item;
    } else {
        // Optional: Filter out raw images/zips if we only want code editing. For now, allow text-based.
        $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
        if (in_array($ext, ['php', 'html', 'css', 'js', 'json', 'txt', 'md', 'htaccess'])) {
            $files[] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raw Code File Manager — Gold Pe Cash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CodeMirror for syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/php/php.min.js"></script>

    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #1e1e1e;
            /* Dark IDE look */
            color: #d4d4d4;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* ── Top Bar ── */
        .topbar {
            background: #2d2d2d;
            border-bottom: 1px solid #444;
            padding: 0 20px;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .topbar h1 {
            font-size: 1.2rem;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar h1 i {
            color: #b088f0;
        }

        .topbar-actions a {
            color: #ccc;
            text-decoration: none;
            margin-left: 20px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .topbar-actions a:hover {
            color: #fff;
        }

        .topbar-actions a.btn-red {
            background: #e60000;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
        }

        /* ── Main Layout ── */
        .main-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* ── File Explorer Sidebar ── */
        .sidebar {
            width: 300px;
            background: #252526;
            border-right: 1px solid #444;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            border-bottom: 1px solid #333;
        }

        .current-path {
            padding: 10px 15px;
            font-size: 0.8rem;
            color: #aaa;
            background: #1e1e1e;
            word-break: break-all;
            border-bottom: 1px solid #333;
        }

        .file-list {
            list-style: none;
        }

        .file-list li a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            gap: 10px;
        }

        .file-list li a:hover {
            background: #37373d;
            color: #fff;
        }

        .file-list li.active a {
            background: #094771;
            color: #fff;
        }

        .file-list li a i.fa-folder {
            color: #dcb67a;
        }

        .file-list li a i.fa-file-code {
            color: #519aba;
        }

        .file-list li a i.fa-level-up-alt {
            color: #888;
        }

        /* ── Editor Canvas ── */
        .editor-canvas {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #1e1e1e;
        }

        .editor-header {
            background: #1e1e1e;
            padding: 10px 20px;
            border-bottom: 1px solid #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .file-name {
            color: #e2c08d;
            font-size: 0.9rem;
            font-family: monospace;
        }

        /* ── Target CodeMirror itself ── */
        .CodeMirror {
            flex: 1;
            height: auto;
            font-family: 'Consolas', 'Courier New', monospace;
            font-size: 14px;
        }

        .btn-save {
            background: #0e639c;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-save:hover {
            background: #1177bb;
        }

        .alert {
            padding: 10px;
            border-radius: 4px;
            margin: 10px 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert.success {
            background: rgba(40, 167, 69, 0.2);
            color: #4ade80;
            border: 1px solid #28a745;
        }

        .alert.error {
            background: rgba(220, 53, 69, 0.2);
            color: #f87171;
            border: 1px solid #dc3545;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>

<body>

    <div class="topbar">
        <h1><i class="fas fa-terminal"></i> Developer File Manager</h1>
        <div class="topbar-actions">
            <a href="dashboard.php"><i class="fas fa-arrow-left"></i> Back to Visual Dashboard</a>
            <a href="../" target="_blank" class="btn-red"><i class="fas fa-external-link-alt"></i> View Live Site</a>
        </div>
    </div>

    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                Project Explorer
            </div>
            <div class="current-path">
                <i class="fas fa-hdd" style="margin-right:5px; color:#aaa;"></i>
                <?= htmlspecialchars(str_replace($base_dir, 'Root', $current_dir)) ?>
            </div>
            <ul class="file-list">
                <?php if ($current_dir !== $base_dir): ?>
                    <li>
                        <a href="?dir=<?= urlencode(dirname($current_dir)) ?>">
                            <i class="fas fa-level-up-alt"></i> .. (Parent Directory)
                        </a>
                    </li>
                <?php endif; ?>

                <?php foreach ($folders as $folder): ?>
                    <li>
                        <a href="?dir=<?= urlencode($current_dir . DIRECTORY_SEPARATOR . $folder) ?>">
                            <i class="fas fa-folder"></i>
                            <?= htmlspecialchars($folder) ?>
                        </a>
                    </li>
                <?php endforeach; ?>

                <?php foreach ($files as $file): ?>
                    <?php
                    $filePath = $current_dir . DIRECTORY_SEPARATOR . $file;
                    $isActive = ($filePath === $current_file) ? 'active' : '';
                    ?>
                    <li class="<?= $isActive ?>">
                        <a href="?dir=<?= urlencode($current_dir) ?>&file=<?= urlencode($filePath) ?>">
                            <i class="fas fa-file-code"></i>
                            <?= htmlspecialchars($file) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Editor -->
        <div class="editor-canvas">
            <?= $message ?>

            <?php if ($current_file): ?>
                <div class="editor-header">
                    <div class="file-name">
                        <i class="fas fa-file-signature" style="margin-right:8px; color:#aaa;"></i>
                        <?= htmlspecialchars(basename($current_file)) ?>
                    </div>
                    <!-- The Save Form -->
                    <form method="POST" id="editorForm" style="margin:0;">
                        <input type="hidden" name="action" value="save_file">
                        <input type="hidden" name="target_file" value="<?= htmlspecialchars($current_file) ?>">
                        <!-- This textarea gets mirrored by CodeMirror -->
                        <textarea id="codeContent" name="file_content"
                            style="display:none;"><?= htmlspecialchars($file_content) ?></textarea>
                        <button type="submit" class="btn-save" title="Save Changes (Ctrl+S)">
                            <i class="fas fa-save"></i> Save Code
                        </button>
                    </form>
                </div>
                <!-- Div where CodeMirror injects itself -->
                <div id="codeEditorWrap" style="flex:1; display:flex; flex-direction:column;"></div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-code"></i>
                    <h2>No file selected</h2>
                    <p>Select a file from the sidebar to start editing.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Initialize CodeMirror -->
    <?php if ($current_file): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var textarea = document.getElementById('codeContent');

                // Determine mode based on file extension
                var filename = "<?= basename($current_file) ?>";
                var ext = filename.split('.').pop().toLowerCase();
                var mode = "application/x-httpd-php"; // Default to PHP/HTML mix

                if (ext === 'css') mode = "text/css";
                else if (ext === 'js') mode = "text/javascript";
                else if (ext === 'json') mode = "application/json";

                var editor = CodeMirror(function (elt) {
                    document.getElementById('codeEditorWrap').appendChild(elt);
                }, {
                    value: textarea.value,
                    lineNumbers: true,
                    mode: mode,
                    theme: "monokai",
                    indentUnit: 4,
                    indentWithTabs: false,
                    lineWrapping: false,
                    matchBrackets: true
                });

                // Update traditional textarea before normal form submission
                document.getElementById('editorForm').addEventListener('submit', function () {
                    textarea.value = editor.getValue();
                });

                // Add Save Hotkey (Ctrl+S / Cmd+S)
                document.addEventListener("keydown", function (e) {
                    if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey) && e.keyCode == 83) {
                        e.preventDefault();
                        textarea.value = editor.getValue();
                        document.getElementById('editorForm').submit();
                    }
                }, false);

                // Focus editor by default
                editor.focus();
            });
        </script>
    <?php endif; ?>
</body>

</html>