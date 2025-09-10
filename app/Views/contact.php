<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - CodeIgniter</title>
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
          <li class="nav-item"><a class="nav-link" href="<?= base_url('public/about') ?>">About</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?= base_url('public/contact') ?>">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container mt-5">
    <h1>Contact Us</h1>
    <p>If you’d like to get in touch, fill out the form below:</p>

    <form class="mt-3">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" id="name" class="form-control" placeholder="Enter your name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" id="email" class="form-control" placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea id="message" class="form-control" rows="4" placeholder="Type your message"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>
</body>
</html>
