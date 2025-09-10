<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CodeIgniter + Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/') ?>">My CI App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= (url_is('/') ? 'active' : '') ?>" href="<?= base_url('public//') ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (url_is('about') ? 'active' : '') ?>" href="<?= base_url('public/about') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (url_is('contact') ? 'active' : '') ?>" href="<?= base_url('public/contact') ?>">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container mt-5">
    <h1 class="text-primary text-center">
        <?= $title ?? 'Welcome to My CI App' ?>
    </h1>
    <p class="text-muted text-center">
        <?= $content ?? 'This is a sample page.' ?>
    </p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
