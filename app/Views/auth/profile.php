<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profile Header -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle"></i> My Profile
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="mb-3">
                                <i class="bi bi-person-circle" style="font-size: 100px; color: #0d6efd;"></i>
                            </div>
                            <h5><?= esc($user->name) ?></h5>
                            <p class="text-muted"><?= esc($user->email) ?></p>
                            <span class="badge bg-<?= $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'success' : 'info') ?>">
                                <?= ucfirst(esc($user->role)) ?>
                            </span>
                        </div>
                        <div class="col-md-9">
                            <h5 class="border-bottom pb-2 mb-3">Account Information</h5>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>User ID:</strong></div>
                                <div class="col-md-8"><?= esc($user->id) ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Status:</strong></div>
                                <div class="col-md-8">
                                    <span class="badge bg-<?= $user->status === 'active' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst(esc($user->status)) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Member Since:</strong></div>
                                <div class="col-md-8"><?= date('F d, Y', strtotime($user->created_at)) ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4"><strong>Last Updated:</strong></div>
                                <div class="col-md-8"><?= date('F d, Y H:i', strtotime($user->updated_at)) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Form -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('profile') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person"></i> Full Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= old('name', esc($user->name)) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i> Email Address
                            </label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= old('email', esc($user->email)) ?>" required>
                        </div>

                        <hr class="my-4">
                        
                        <h6 class="mb-3">Change Password (Optional)</h6>
                        <p class="text-muted small">Leave blank if you don't want to change your password</p>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock"></i> New Password
                            </label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Leave blank to keep current password">
                            <small class="text-muted">Minimum 6 characters</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">
                                <i class="bi bi-lock-fill"></i> Confirm New Password
                            </label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" 
                                   placeholder="Confirm your new password">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Profile
                            </button>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>