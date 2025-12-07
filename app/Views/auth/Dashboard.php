<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Welcome, <?= esc($username) ?>!</h2>
            <p class="text-muted">Role: <span class="badge bg-primary"><?= ucfirst(esc($role)) ?></span></p>
            <hr>
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
        <!-- Admin Dashboard -->
        <div class="row">
            <div class="col-md-12">
                <h3>Admin Dashboard</h3>
                <p>Manage system, users, and courses</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_users ?></h5>
                        <p class="card-text">Registered users in the system</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Teachers</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_teachers ?></h5>
                        <p class="card-text">Active teachers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Students</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_students ?></h5>
                        <p class="card-text">Enrolled students</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Users</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_users as $user): ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><span class="badge bg-secondary"><?= ucfirst(esc($user['role'])) ?></span></td>
                                    <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Admin Actions</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary">Manage Users</button>
                        <button class="btn btn-success">Manage Courses</button>
                        <button class="btn btn-warning">System Settings</button>
                        <button class="btn btn-info">View Reports</button>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($role === 'teacher'): ?>
        <!-- Teacher Dashboard -->
        <div class="row">
            <div class="col-md-12">
                <h3>Teacher Dashboard</h3>
                <p>Create content, manage grades, and track student progress</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">My Courses</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_courses ?></h5>
                        <p class="card-text">Courses you're teaching</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">My Students</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $total_students ?></h5>
                        <p class="card-text">Students in your courses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Pending Assignments</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $pending_assignments ?></h5>
                        <p class="card-text">Assignments to grade</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary">Create New Course</button>
                        <button class="btn btn-success">Create Assignment</button>
                        <button class="btn btn-info">Grade Submissions</button>
                        <button class="btn btn-warning">View Students</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>My Courses</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No courses available. Create your first course!</p>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($role === 'student'): ?>
        <!-- Student Dashboard -->
        <div class="row">
            <div class="col-md-12">
                <h3>Student Dashboard</h3>
                <p>View courses, submit work, and track your progress</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Enrolled Courses</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $enrolled_courses ?></h5>
                        <p class="card-text">Your active courses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Pending Assignments</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $pending_assignments ?></h5>
                        <p class="card-text">Assignments due</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Completed</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $completed_assignments ?></h5>
                        <p class="card-text">Assignments submitted</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>My Courses</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No courses enrolled yet. Browse available courses to get started!</p>
                        <button class="btn btn-primary">Browse Courses</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No recent activity</p>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>