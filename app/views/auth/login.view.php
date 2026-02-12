<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-5 offset-md-3">
        <h2 class="mb-5">Sign In to Your Account</h2>

        <div class="card border-0 shadow-card">
            <div class="card-body p-5">
                <form method="POST">
                    <?php echo csrf_input_field(); ?>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-custom w-100 mb-3">Continue</button>
                </form>

                <hr class="border-color-light">
                <p class="text-center no-margin-bottom mt-3"><span class="text-muted">Don't have an account? </span><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/register" class="text-decoration-none text-primary-link">Create one</a></p>
            </div>
        </div>
    </div>
</div>
