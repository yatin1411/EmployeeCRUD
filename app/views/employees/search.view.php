<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="mb-5">
            <h2>Search Employees</h2>
            <p class="text-muted text-small">Logged in as: <strong><?php echo htmlspecialchars(getCurrentUser()); ?></strong></p>
        </div>

        <div class="card border-0 mb-4">
            <div class="card-body">
                <form method="GET" class="d-flex gap-2">
                    <input type="hidden" name="url" value="employees/search">
                    <input type="text" class="form-control" name="keyword" placeholder="Search by name, email, position..." value="<?php echo htmlspecialchars($keyword); ?>">
                    <button class="btn btn-primary btn-custom" type="submit">Search</button>
                    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/search" class="btn btn-secondary btn-custom">Clear</a>
                </form>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php elseif (!empty($keyword) && empty($employees)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No employees found matching "<?php echo htmlspecialchars($keyword); ?>"
            </div>
        <?php elseif (!empty($employees)): ?>
            <div class="card border-0">
                <div class="card-body">
                    <p class="text-muted mb-3"><strong><?php echo count($employees); ?></strong> result(s) found</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-header-gradient">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($employee['id']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['name']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['position']); ?></td>
                                    <td><?php echo number_format($employee['salary'], 2); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/edit&id=<?php echo $employee['id']; ?>" class="btn btn-sm btn-primary btn-custom">Edit</a>
                                            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/delete&id=<?php echo $employee['id']; ?>" class="btn btn-sm btn-danger btn-custom" onclick="return confirm('Are you sure?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "../app/views/footer.html"; ?>
