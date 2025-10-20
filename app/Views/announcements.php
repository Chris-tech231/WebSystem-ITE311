<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Announcements</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
</head>
<body class="p-4">
<div class="container">
    <h1 class="mb-4">Announcements</h1>

    <?php if (! empty($message)) : ?>
        <div class="alert alert-danger"><?= esc($message) ?></div>
    <?php endif; ?>

    <?php if (empty($announcements)) : ?>
        <div class="alert alert-info">No announcements yet.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($announcements as $a): ?>
                <div class="list-group-item mb-2">
                    <h5 class="mb-1"><?= esc($a['title']) ?></h5>
                    <small class="text-muted"><?= date('F j, Y, g:ia', strtotime($a['created_at'])) ?></small>
                    <p class="mb-0 mt-2"><?= nl2br(esc($a['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
