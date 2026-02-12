<?php include "../app/views/layout.html"; ?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="mb-2">Employee Directory</h2>
                <p class="text-muted mb-0 text-small">Logged in as: <strong><?php echo htmlspecialchars($user ?? getCurrentUser()); ?></strong></p>
            </div>
            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/add" class="btn btn-primary btn-custom">
                Add Employee
            </a>
        </div>

        <div class="card border-0 mb-4">
            <div class="card-body">
                <form method="GET" class="d-flex gap-2">
                    <input type="hidden" name="url" value="employees/search">
                    <input type="text" class="form-control" name="keyword" placeholder="Quick search...">
                    <button class="btn btn-primary btn-custom" type="submit">Search</button>
                </form>
            </div>
        </div>

        <?php if (empty($employees)): ?>
            <div class="alert alert-info">No employees found. <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/add" class="text-primary-link">Add one now</a></div>
        <?php else: ?>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-custom">
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
                                    <td><?php echo $employee['id']; ?></td>
                                    <td><?php echo htmlspecialchars($employee['name']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                                    <td><?php echo htmlspecialchars($employee['position']); ?></td>
                                    <td><?php echo number_format($employee['salary'], 2); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/EmployeeCRUD/public/index.php?url=employees/edit&id=<?php echo $employee['id']; ?>" class="btn btn-sm btn-warning btn-custom">Edit</a>
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
