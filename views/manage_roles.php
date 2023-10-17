<!DOCTYPE html>
<html>

<head>
    <title>Manage Roles and Permissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
        .badge {
            margin-right: 5px;
            color: #fff;
        }
        .badge-primary{
            background-color: #0d6efd;

        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Section to display all user and their role -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Users and Roles</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user->username) ?></td>
                            <td><?= htmlspecialchars($user->role() ? $user->role()->name : '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section to display all roles and their permissions -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Roles and Permissions</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role) : ?>
                        <tr>
                            <td><?= htmlspecialchars($role->name) ?></td>
                            <td>
                                <?php
                                    foreach ($role->permissions() as $permission) {
                                        echo "<span class='badge badge-primary'>" . htmlspecialchars($permission->permission()->name) . "</span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section to add a new role -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Add a New Role</h2>
        </div>
        <div class="card-body">
            <form action="/store_role" method="POST">
                <div class="mb-3">
                    <label for="role_name" class="form-label">Role Name:</label>
                    <input type="text" class="form-control" id="role_name" name="role_name">
                </div>
                <input type="submit" class="btn btn-primary" value="Add Role">
            </form>
        </div>
    </div>

    <!-- Section to add a new role -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Add a New Permission</h2>
        </div>
        <div class="card-body">
            <form action="/store_permission" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Permission Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <input type="submit" class="btn btn-primary" value="Add Permission">
            </form>
        </div>
    </div>

    <!-- Section to add permissions to a role -->
    <div class="card">
        <div class="card-header">
            <h2>Add Permission to Role</h2>
        </div>
        <div class="card-body">
            <form action="/add_permission_to_role" method="POST">
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select class="form-control" id="role" name="role_id">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role->id ?>"><?= htmlspecialchars($role->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="permission" class="form-label">Permission:</label>
                    <select class="form-control" id="permission" name="permission_id">
                        <?php foreach ($permissions as $permission) : ?>
                            <option value="<?= $permission->id ?>"><?= htmlspecialchars($permission->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Add Permission to Role">
            </form>
        </div>
    </div>

    <!-- Section to add role to a user -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Add Role to User</h2>
        </div>
        <div class="card-body">
            <form action="/add_role_to_user" method="POST">
                <div class="mb-3">
                    <label for="user" class="form-label">User:</label>
                    <select class="form-control" id="user" name="user_id">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user->id ?>"><?= htmlspecialchars($user->username) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select class="form-control" id="role" name="role_id">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role->id ?>"><?= htmlspecialchars($role->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Add Role to User">
            </form>
        </div>
    </div>

</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBZ5RUAd/iUZf3ar5cBcFb/++4m/BxPt2s5z7AtgXT2pti4yJd5Dg3f+X" crossorigin="anonymous"></script>
</body>

</html>
