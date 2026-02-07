<?php include "../app/views/layout.html"; ?>

<div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="text-center">
        <h1 class="display-2 fw-bold mb-4" style="font-size: 5rem; color: #1a365d;">404</h1>
        <h2 class="h3 mb-4" style="color: #2c5282; font-size: 1.8rem;">Page Not Found</h2>
        <p class="lead mb-5" style="color: #718096; font-size: 1.1rem;">Sorry, the page you're looking for doesn't exist or may have been moved.</p>
        <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/Mvc/public/index.php" class="btn btn-primary btn-lg btn-custom">
            Go to Home
        </a>
    </div>
</div>

<?php include "../app/views/footer.html"; ?>