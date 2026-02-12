<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-5 offset-md-3">
        <h2 class="mb-5">Create Your Account</h2>

        <div class="card border-0 shadow-card">
            <div class="card-body p-5">
                <form method="POST">
                    <?php echo csrf_input_field(); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimum 6 characters" required>
                        <small class="text-muted">Must be at least 6 characters long</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-custom w-100 mb-3">Create Account</button>
                </form>

                <hr class="border-color-light">
                <p class="text-center no-margin-bottom mt-3"><span class="text-muted">Already have an account? </span><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/login" class="text-decoration-none text-primary-link">Sign in</a></p>
            </div>
        </div>
    </div>
</div>
