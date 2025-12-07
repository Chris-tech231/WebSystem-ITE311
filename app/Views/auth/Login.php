<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-box-arrow-in-right"></i> Login</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/login') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= old('email') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </div>
                    </form>

                    <hr>
                    <p class="text-center mb-0">
                        Don't have an account? 
                        <a href="<?= base_url('/register') ?>">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>