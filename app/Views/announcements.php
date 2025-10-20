<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">University Announcements</h1>
        
        <?php if (empty($announcements)): ?>
            <div class="alert alert-info">
                No announcements available at the moment.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($announcements as $announcement): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($announcement['title']) ?></h5>
                                <p class="card-text"><?= esc($announcement['content']) ?></p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Posted on: <?= date('F j, Y g:i A', strtotime($announcement['created_at'])) ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>