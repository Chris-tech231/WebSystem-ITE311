<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - CodeIgniter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('/') ?>">ITE311</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="<?= base_url('public//') ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?= base_url('public/about') ?>">About</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('public/contact') ?>">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container mt-5">
    <h1 class="mb-4">About Us</h1>
    <p>Our project is built with CodeIgniter 4 to demonstrate MVC, routing, and Bootstrap integration.</p>

    <h3 class="mt-4">Our Team</h3>
    <table class="table table-bordered table-striped mt-3">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Specialty</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Juan Dela Cruz</td>
          <td>Leader</td>
          <td>Backend Development</td>
        </tr>
        <tr>
          <td>Maria Santos</td>
          <td>Member</td>
          <td>Frontend Development</td>
        </tr>
        <tr>
          <td>Jose Rizal</td>
          <td>Member</td>
          <td>Database Design</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
