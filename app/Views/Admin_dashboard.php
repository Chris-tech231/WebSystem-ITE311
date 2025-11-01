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
                <h1>Welcome, Admin!</h1>
                <p>This is your dedicated dashboard with administrative controls.</p>
                <a href="<?= site_url('announcements') ?>" class="btn btn-primary">View Announcements</a>
                <a href="<?= site_url('logout') ?>" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>