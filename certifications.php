<?php

$message = ''; $messageType = 'success'; $editId = null; $editRow = null;

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM certifications WHERE id=?");
    $stmt->execute([$editId]);
    $editRow = $stmt->fetch();
    if (!$editRow) $editId = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) { $message = 'Invalid security token.'; $messageType = 'error'; }
    else {
        $action = $_POST['action'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $date = $_POST['date'] ?? '';
        $id = (int)($_POST['id'] ?? 0);
        $imagePath = $editRow['image_path'] ?? '';

        if ($action === 'add' || $action === 'update') {
            if (!$title || !$date) { $message = 'Title and date are required.'; $messageType = 'error'; }
            else {
                if (!empty($_FILES['certificate_file']['tmp_name'])) {
                    $upload = uploadFile($_FILES['certificate_file'], 'certificates', array_merge(ALLOWED_IMAGE_TYPES, ALLOWED_PDF_TYPES));
                    if ($upload['success']) {
                        if ($imagePath && strpos($imagePath, 'certificate-sample') === false) deleteFile($imagePath);
                        $imagePath = $upload['path'];
                        logActivity($pdo, $_SESSION['admin_id'], 'UPDATE', 'certifications', $id ?: $pdo->lastInsertId(), "Uploaded certificate file");
                    } else {
                        $message = $upload['error']; $messageType = 'error';
                    }
                }
                if ($messageType !== 'error') {
                    if ($action === 'add') {
                        $maxOrder = (int)$pdo->query("SELECT COALESCE(MAX(sort_order),0) FROM certifications")->fetchColumn();
                    $pdo->prepare("INSERT INTO certifications (title, description, date, image_path, sort_order) VALUES (?, ?, ?, ?, ?)")->execute([$title, $description ?: 'Verified Completion Certificate', $date, $imagePath, $maxOrder + 1]);
                        logActivity($pdo, $_SESSION['admin_id'], 'INSERT', 'certifications', $pdo->lastInsertId(), "Added certification: $title");
                        $message = 'Certification added.'; $messageType = 'success';
                    } else {
                        $pdo->prepare("UPDATE certifications SET title=?, description=?, date=?, image_path=?, updated_at=NOW() WHERE id=?")->execute([$title, $description ?: 'Verified Completion Certificate', $date, $imagePath, $id]);
                        logActivity($pdo, $_SESSION['admin_id'], 'UPDATE', 'certifications', $id, "Updated certification: $title");
                        $message = 'Certification updated.'; $messageType = 'success';
                        redirect('certifications.php');
                    }
                }
            }
        } elseif ($action === 'delete' && $id) {
            $stmt = $pdo->prepare("SELECT title, image_path FROM certifications WHERE id=?"); $stmt->execute([$id]); $row = $stmt->fetch();
            if ($row['image_path'] && strpos($row['image_path'], 'certificate-sample') === false) deleteFile($row['image_path']);
            $pdo->prepare("DELETE FROM certifications WHERE id=?")->execute([$id]);
            logActivity($pdo, $_SESSION['admin_id'], 'DELETE', 'certifications', $id, "Deleted certification: ".($row['title'] ?? ''));
            $message = 'Certification deleted.'; $messageType = 'success';
            redirect('certifications.php');
        }
    }
}

$certifications = $pdo->query("SELECT * FROM certifications ORDER BY sort_order ASC, id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certifications &amp; Seminars | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .admin-card {
            background: linear-gradient(145deg, rgba(31, 41, 55, 0.6), rgba(17, 24, 39, 0.6));
            border: 1px solid rgba(55, 65, 81, 0.8);
            backdrop-filter: blur(12px);
        }
        .admin-card:hover { border-color: rgba(99, 102, 241, 0.4); }
        .form-input {
            background: rgba(17, 24, 39, 0.6);
            border: 1px solid rgba(55, 65, 81, 0.8);
            color: #fff;
        }
        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        .admin-table th {
            background: rgba(17, 24, 39, 0.4);
            color: #9ca3af;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #22d3ee);
            color: #fff;
        }
        .btn-primary:hover {
            filter: brightness(1.1);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen antialiased pb-12">

    <div class="max-w-5xl mx-auto px-6 py-8 space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-certificate text-indigo-400"></i> Certifications &amp; Seminars
                </h2>
                <p class="text-sm text-gray-400 mt-1">Manage your certification records and uploaded files.</p>
            </div>
            <div class="flex gap-2">
                <?php if (!$editId): ?>
                    <a href="certifications.php?add=1" class="btn-primary px-4 py-2 rounded-xl text-sm font-semibold shadow-lg shadow-indigo-500/25 transition">
                        + Add Certification
                    </a>
                <?php else: ?>
                    <a href="certifications.php" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 bg-gray-800/80 border border-gray-700/60 hover:bg-gray-800 transition">Cancel</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Message -->
        <?php if ($message): ?>
            <div class="rounded-xl px-4 py-3 border flex items-center gap-3
                <?= $messageType === 'success' ? 'bg-indigo-950/20 border-indigo-500/30 text-indigo-200' : 'bg-rose-950/20 border-rose-500/30 text-rose-200' ?>">
                <i class="fa-solid fa-<?= $messageType === 'success' ? 'circle-check' : 'circle-exclamation' ?>"></i>
                <span class="text-sm font-medium"><?= h($message) ?></span>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <div class="admin-card p-6 md:p-8 rounded-[1.5rem] shadow-2xl max-w-2xl">
            <form method="POST" enctype="multipart/form-data" action="" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                <input type="hidden" name="action" value="<?= $editId ? 'update' : 'add' ?>">
                <input type="hidden" name="id" value="<?= h($editId ?? 0) ?>">

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Certification Title</label>
                    <input type="text" name="title" value="<?= h($editRow['title'] ?? '') ?>" required placeholder="e.g. Online Safety Through Netiquette"
                        class="w-full form-input px-4 py-2.5 rounded-xl text-sm focus:outline-none transition">
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Description</label>
                    <input type="text" name="description" value="<?= h($editRow['description'] ?? '') ?>" placeholder="Verified Completion Certificate"
                        class="w-full form-input px-4 py-2.5 rounded-xl text-sm focus:outline-none transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
                        <input type="date" name="date" value="<?= h($editRow['date'] ?? '') ?>" required
                            class="w-full form-input px-4 py-2.5 rounded-xl text-sm focus:outline-none transition">
                    </div>

                    <div class="form-group flex flex-col">
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Certificate File (Image or PDF)</label>
                        <input type="file" name="certificate_file" accept="image/*,.pdf"
                            class="w-full form-input px-4 py-2.5 rounded-xl text-sm text-gray-400 focus:outline-none transition cursor-pointer">
                        <div class="text-xs text-gray-500 mt-1.5">JPG, PNG, WEBP, GIF or PDF. Max 5MB. Leave blank to keep existing file.</div>
                        <?php if (!empty($editRow['image_path'])): ?>
                            <div class="mt-3">
                                <?php if (strtolower(pathinfo($editRow['image_path'], PATHINFO_EXTENSION)) === 'pdf'): ?>
                                    <a href="<?= h($editRow['image_path']) ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-indigo-300 bg-indigo-950/40 border border-indigo-500/30 hover:bg-indigo-900/30 transition">
                                        <i class="fa-solid fa-file-pdf"></i> View PDF
                                    </a>
                                <?php else: ?>
                                    <img src="<?= h($editRow['image_path']) ?>" class="w-24 h-24 object-cover rounded-lg border border-gray-700/50" alt="Preview" onerror="this.style.display='none'">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold shadow-lg shadow-indigo-500/25 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-<?= $editId ? 'pen' : 'plus' ?>"></i>
                    <?= $editId ? 'Update Certification' : 'Add Certification' ?>
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="admin-card p-0 rounded-[1.5rem] shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-800/50">
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">File</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    <?php foreach ($certifications as $c): ?>
                    <tr class="hover:bg-gray-800/30 transition">
                        <td class="px-6 py-4 text-sm font-medium text-white"><?= h($c['title']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-400"><?= h($c['description']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-400"><?= date('M j, Y', strtotime($c['date'])) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-400 truncate max-w-xs"><?= basename($c['image_path']) ?></td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex gap-2">
                                <a href="certifications.php?edit=<?= (int)$c['id'] ?>" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-300 bg-indigo-950/40 border border-indigo-500/30 hover:bg-indigo-900/30 transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button onclick="return confirmDeleteCert(this, 'Delete this certification?')" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-300 bg-rose-950/40 border border-rose-500/30 hover:bg-rose-900/30 transition" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <form method="POST" style="display:none;" id="delForm-<?= (int)$c['id'] ?>">
                                    <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!$certifications): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">No certifications found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

<script>
function confirmDeleteCert(btn, msg) {
    if (!confirm(msg)) return false;
    const id = btn.closest('.inline-flex').querySelector('input[name="id"]').value;
    document.getElementById('delForm-' + id).submit();
    return false;
}
</script>
</body>
</html>
