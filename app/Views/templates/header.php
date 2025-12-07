<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'LMS Dashboard' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <?php 
    $session = session();
    $isLoggedIn = $session->get('isLoggedIn');
    $role = $session->get('role');
    $username = $session->get('username');
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="bi bi-mortarboard-fill"></i> LMS System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/dashboard') ?>">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>

                        <?php if ($role === 'admin'): ?>
                            <!-- Admin Menu Items -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/admin/users') ?>">
                                    <i class="bi bi-people"></i> Manage Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/admin/courses') ?>">
                                    <i class="bi bi-book"></i> Manage Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/admin/settings') ?>">
                                    <i class="bi bi-gear"></i> Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/admin/reports') ?>">
                                    <i class="bi bi-graph-up"></i> Reports
                                </a>
                            </li>

                        <?php elseif ($role === 'teacher'): ?>
                            <!-- Teacher Menu Items -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/teacher/courses') ?>">
                                    <i class="bi bi-book"></i> My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/teacher/students') ?>">
                                    <i class="bi bi-people"></i> My Students
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/teacher/assignments') ?>">
                                    <i class="bi bi-file-text"></i> Assignments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/teacher/grades') ?>">
                                    <i class="bi bi-clipboard-check"></i> Grades
                                </a>
                            </li>

                        <?php elseif ($role === 'student'): ?>
                            <!-- Student Menu Items -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/student/courses') ?>">
                                    <i class="bi bi-book"></i> My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/student/assignments') ?>">
                                    <i class="bi bi-file-text"></i> Assignments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('/student/grades') ?>">
                                    <i class="bi bi-clipboard-data"></i> My Grades
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?= esc($username) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text">
                                        <small class="text-muted">Logged in as: <strong><?= ucfirst(esc($role)) ?></strong></small>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                        <i class="bi bi-person"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/logout') ?>">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/login') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/register') ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>