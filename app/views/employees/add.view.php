<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="mb-3">Add New Employee</h2>
        <p class="text-muted mb-5 text-small">Logged in as: <strong><?php echo htmlspecialchars(getCurrentUser()); ?></strong></p>

        <div class="card border-0 shadow-card">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="required-field">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter employee name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="required-field">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="e.g., Manager, Developer">
                    </div>

                    <div class="mb-4">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" step="0.01" min="0" placeholder="0.00">
                    </div>

                    <button type="submit" class="btn btn-success btn-custom w-100 mb-2">Add Employee</button>
                    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees" class="btn btn-secondary btn-custom w-100">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
