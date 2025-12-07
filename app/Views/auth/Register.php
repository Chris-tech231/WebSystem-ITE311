<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-person-plus"></i> Register</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/register') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= old('username') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= old('email') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <small class="text-muted">Minimum 6 characters</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirm" 
                                   name="password_confirm" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Register As</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="student" <?= old('role') === 'student' ? 'selected' : '' ?>>Student</option>
                                <option value="teacher" <?= old('role') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus"></i> Register
                            </button>
                        </div>
                    </form>

                    <hr>
                    <p class="text-center mb-0">
                        Already have an account? 
                        <a href="<?= base_url('/login') ?>">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>