<?php include "../app/views/layout.html"; ?>

<div style="height: 50vh; display: flex; align-items: center; justify-content: center; overflow: hidden;">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 30px;">
        <h1 style="text-align: center; margin-bottom: 1rem; font-size: 2rem;">Employee Management System</h1>        
        <?php if ($isLoggedIn): ?>
            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dbeafe 100%); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 2px solid #bbf7d0;">
                <p style="color: #166534; margin: 0; font-size: 1rem; font-weight: 600;">Welcome, <strong><?php echo htmlspecialchars($user); ?></strong></p>
            </div>
            <p style="text-align: center; color: #4a5568; margin-bottom: 2rem; font-size: 0.95rem;">You're ready to manage your employee records. Select an option below to get started.</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
                <a class="btn btn-primary btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees" role="button" style="padding: 12px 24px; font-size: 0.9rem;">
                    <i class="bi bi-people-fill"></i> View Employees
                </a>
                <a class="btn btn-success btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/add" role="button" style="padding: 12px 24px; font-size: 0.9rem;">
                    <i class="bi bi-plus-circle-fill"></i> Add Employee
                </a>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #4a5568; margin-bottom: 2rem; font-size: 0.95rem;">Sign in or create an account to get started managing your employees.</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
                <a class="btn btn-primary btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/login" role="button" style="padding: 12px 24px; font-size: 0.9rem;">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </a>
                <a class="btn btn-success btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/register" role="button" style="padding: 12px 24px; font-size: 0.9rem;">
                    <i class="bi bi-person-plus-fill"></i> Create Account
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "../app/views/footer.html"; ?>
