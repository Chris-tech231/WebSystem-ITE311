<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div>
            <a href="<?= site_url('logout') ?>" class="btn btn-outline-light">Logout</a>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h3>Welcome, <?= session()->get('name') ?>!</h3>
    <p>You are logged in as <strong><?= session()->get('role') ?></strong>.</p>
</div>
</body>
</html>
