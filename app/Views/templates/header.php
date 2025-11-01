<!doctype html>
<html>
<head>
    <title>Dashboard - <?= esc($username ?? 'Guest') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">LMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (session()->get('isLoggedIn')): ?>
            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>

            <?php if (session()->get('role') === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="/admin/users">Manage Users</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/reports">Reports</a></li>
            <?php endif; ?>

            <?php if (session()->get('role') === 'teacher'): ?>
                <li class="nav-item"><a class="nav-link" href="/teacher/courses">My Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="/teacher/grades">Gradebook</a></li>
            <?php endif; ?>

            <?php if (session()->get('role') === 'student'): ?>
                <li class="nav-item"><a class="nav-link" href="/student/courses">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="/student/assignments">Assignments</a></li>
            <?php endif; ?>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if (session()->get('isLoggedIn')): ?>
          <li class="nav-item"><span class="nav-link">Hello, <?= esc(session()->get('username')) ?> (<?= esc(session()->get('role')) ?>)</span></li>
          <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('message')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>
