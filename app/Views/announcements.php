<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">University Announcements</h1>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (empty($announcements)): ?>
                    <div class="alert alert-info">
                        No announcements available at the moment.
                    </div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($announcements as $announcement): ?>
                            <div class="list-group-item mb-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= esc($announcement['title']) ?></h5>
                                    <small><?= date('M j, Y g:i A', strtotime($announcement['created_at'])) ?></small>
                                </div>
                                <p class="mb-1"><?= nl2br(esc($announcement['content'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>