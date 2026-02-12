<?php include "../app/views/layout.html"; ?>

<div class="hero-section">
    <div class="hero-container">
        <h1 class="hero-title">Employee Management System</h1>        
        <?php if ($isLoggedIn): ?>
            <div class="welcome-message">
                <p>Welcome, <strong><?php echo htmlspecialchars($user); ?></strong></p>
            </div>
            <p class="hero-subtitle">You're ready to manage your employee records. Select an option below to get started.</p>
            <div class="hero-button-grid">
                <a class="btn btn-primary btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees" role="button">
                    <i class="bi bi-people-fill"></i> View Employees
                </a>
                <a class="btn btn-success btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/add" role="button">
                    <i class="bi bi-plus-circle-fill"></i> Add Employee
                </a>
            </div>
        <?php else: ?>
            <p class="hero-subtitle">Sign in or create an account to get started managing your employees.</p>
            <div class="hero-button-grid">
                <a class="btn btn-primary btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/login" role="button">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </a>
                <a class="btn btn-success btn-lg btn-custom" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=auth/register" role="button">
                    <i class="bi bi-person-plus-fill"></i> Create Account
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
