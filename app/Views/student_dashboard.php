<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Student Dashboard</h2>
                    </div>
                    <div class="card-body">
                        <h3>Welcome, Student!</h3>
                        <p>This is your dedicated dashboard where you can view your courses, grades, and academic information.</p>
                        <a href="/announcements" class="btn btn-primary">View Announcements</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>