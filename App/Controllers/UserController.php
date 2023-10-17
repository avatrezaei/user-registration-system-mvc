<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Subscription;
use App\Models\RolePermision;
use App\Models\UserRole;

class UserController extends BaseController
{
    public function profile()
    {
        if (
            !isset($_SESSION['user_id'])
            && !isset($_SESSION['role'])
            && $_SESSION['role'] !== User::ROLE_ADMIN
        ) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::query()->find($userId);

        if (!$user) {
            header('Location: /login');
            exit;
        }

        $this->view('profile', ['user' => $user]);
    }

    public function updateAvatar()
    {

        $userId = $_SESSION['user_id'];

        $user = User::query()->where('id', $userId)->first();

        if ($user) {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $user->setAvatar($_FILES['avatar']);
            }

            $user->save();

            $this->setSessionSuccess("Avatar updated successfully.");
            $this->redirect('/profile');
        } else {
            $this->setSessionError("User not found.");
            $this->redirect('/login');
        }
    }

    public function manageRoles()
    {
        if (
            !isset($_SESSION['user_id'])
            && !isset($_SESSION['role'])
            && $_SESSION['role'] !== User::ROLE_ADMIN
        ) {
            header('Location: /login');
            exit;
        }

        $users = User::query()->get();
        $roles = Role::query()->get();
        $permissions = Permission::query()->get();

        $this->view('manage_roles', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function storeRole($request)
    {
        $name = $request['role_name'];

        $role = Role::query()->where('name', $name)->first();

        if ($role) {
            $this->setSessionError("Role already exists.");
            $this->redirect('/manage_roles');
        } else {
            $role = new Role();
            $role->name = $name;
            $role->description = '';
            $role->save();

            $this->setSessionSuccess("Role created successfully.");
            $this->redirect('/manage_roles');
        }
    }

    public function storePermission($request)
    {
        $name = $request['name'];

        $permission = Permission::query()->where('name', $name)->first();

        if ($permission) {
            $this->setSessionError("Permission already exists.");
            $this->redirect('/manage_roles');
        } else {
            $permission = new Permission();
            $permission->name = $name;
            $permission->description = '';
            $permission->save();

            $this->setSessionSuccess("Permission created successfully.");
            $this->redirect('/manage_roles');
        }
    }

    public function addRoleToUser($request)
    {
        $user_id = $request['user_id'];
        $role_id = $request['role_id'];

        $user = User::query()->find($user_id);
        $role = Role::query()->find($role_id);

        if ($user && $role) {

            UserRole::query()->where('user_id', $user->id)->delete();

            $userRole = new UserRole();
            $userRole->user_id = $user->id;
            $userRole->role_id = $role->id;
            $userRole->save();

            $user->role_id = $role->id;
            $user->save();

            $this->setSessionSuccess("Role assigned successfully.");
            $this->redirect('/manage_roles');
        } else {
            $this->setSessionError("User or role not found.");
            $this->redirect('/manage_roles');
        }
    }

    //addPermissionToRole
    public function addPermissionToRole($request)
    {
        $role_id = $request['role_id'];
        $permission_id = $request['permission_id'];

        $role = Role::query()->find($role_id);
        $permission = Permission::query()->find($permission_id);

        if ($role && $permission) {
            $model = new RolePermision();
            $model->role_id = $role->id;
            $model->permission_id = $permission->id;

            $model->save();

            $this->setSessionSuccess("Permission added to role successfully.");
            $this->redirect('/manage_roles');
        } else {
            $this->setSessionError("Role or permission not found.");
            $this->redirect('/manage_roles');
        }
    }

    public function subscribe()
    {
        if (
            !isset($_SESSION['user_id'])
            && !isset($_SESSION['role'])
        ) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::query()->find($userId);

        if (!$user) {
            header('Location: /login');
            exit;
        }

        $subscription = $user->subscription();

        if ($subscription) {
            $subscription->delete();
            $this->setSessionSuccess("Subscription cancelled successfully.");
            $this->redirect('/profile');
        } else {
            $subscription = new Subscription();
            $subscription->user_id = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s');
            $subscription->expiry_date = date('Y-m-d H:i:s', strtotime('+1 month'));
            $subscription->status = 'active';
            $subscription->type = 'monthly';
            $subscription->save();

            $this->setSessionSuccess("Subscription created successfully.");
            $this->redirect('/profile');
        }
    }

    public function unsubscribe(){
        if (
            !isset($_SESSION['user_id'])
            && !isset($_SESSION['role'])
        ) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $user = User::query()->find($userId);

        if (!$user) {
            header('Location: /login');
            exit;
        }

        $subscription = $user->subscription();

        if ($subscription) {
            $subscription->delete();
            $this->setSessionSuccess("Subscription cancelled successfully.");
            $this->redirect('/profile');
        } else {
            $this->setSessionError("Subscription not found.");
            $this->redirect('/profile');
        }
    }
}
