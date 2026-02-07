<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-5 offset-md-3">
        <h2 class="mb-5">Sign In to Your Account</h2>

        <div class="card border-0" style="box-shadow: 0 8px 24px rgba(26, 54, 93, 0.12);">
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

                <hr style="border-color: #e8f0ff;">
                <p class="text-center" style="color: #718096; margin-bottom: 0; margin-top: 1.5rem;">Don't have an account? <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/Mvc/public/index.php?url=auth/register" class="text-decoration-none" style="color: #2c5282; font-weight: 700;">Create one</a></p>
            </div>
        </div>
    </div>
</div>

<?php include "../app/views/footer.html"; ?>
