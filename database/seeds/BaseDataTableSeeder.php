<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Setting;

class BaseUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create([  'name' => 'System', 'password' => '$2y$10$HuOeNE1zocSXywttHTK9TexEpcz7G.rKgpOGsuTeY/uIsrxylva6i', 'email' => 'system@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'Sachin Pawaskar', 'password' => '$2y$10$HuOeNE1zocSXywttHTK9TexEpcz7G.rKgpOGsuTeY/uIsrxylva6i', 'email' => 'spawaskar@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BaseRolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        Role::create([ 'name' => 'sysadmin', 'display_name' => 'System Administrator', 'description' => 'System Administrator User has all permissions',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'admin', 'display_name' => 'Administrator', 'description' => 'User is allowed to manage and edit other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BasePermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        // User Management Permissions
        Permission::create([ 'name' => 'manage-users', 'display_name' => 'Manage Users', 'description' => 'User is allowed to add, edit and delete other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'create-users', 'display_name' => 'Create Users', 'description' => 'User is allowed to add other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'edit-users', 'display_name' => 'Edit Users', 'description' => 'User is allowed to edit other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-users', 'display_name' => 'View Users', 'description' => 'User is allowed to view other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'delete-users', 'display_name' => 'Delete Users', 'description' => 'User is allowed to delete other users',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);

        // Role Management Permissions
        Permission::create([ 'name' => 'manage-roles', 'display_name' => 'Manage Roles', 'description' => 'User is allowed to add, edit and delete roles',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'create-roles', 'display_name' => 'Create Roles', 'description' => 'User is allowed to add other roles',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'edit-roles', 'display_name' => 'Edit Roles', 'description' => 'User is allowed to edit other roles',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-roles', 'display_name' => 'View Roles', 'description' => 'User is allowed to view other roles',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'delete-roles', 'display_name' => 'Delete Roles', 'description' => 'User is allowed to delete other roles',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);

        // Setting Management Permissions
        Permission::create([ 'name' => 'manage-settings', 'display_name' => 'Manage Settings', 'description' => 'User is allowed to add, edit and delete settings',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'create-settings', 'display_name' => 'Create Settings', 'description' => 'User is allowed to add other settings',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'edit-settings', 'display_name' => 'Edit Settings', 'description' => 'User is allowed to edit other settings',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-settings', 'display_name' => 'View Settings', 'description' => 'User is allowed to view other settings',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'delete-settings', 'display_name' => 'Delete Settings', 'description' => 'User is allowed to delete other settings',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);

        // Audit Management Permissions
        Permission::create([ 'name' => 'manage-audits', 'display_name' => 'Manage Audits', 'description' => 'User is allowed to add, edit and delete audits',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-audits', 'display_name' => 'View Audits', 'description' => 'User is allowed to view other audits',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'restore-audits', 'display_name' => 'Restore Audits', 'description' => 'User is allowed to restore other audits',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BaseRoleUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('role_user')->delete();

        $user = User::where('name', '=', 'Sachin Pawaskar')->first()->id;
        $role = Role::where('name', '=', 'sysadmin')->first()->id;
        $role_user = [ ['role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('role_user')->insert($role_user);
        $role = Role::where('name', '=', 'admin')->first()->id;
        $role_user = [ ['role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('role_user')->insert($role_user);
    }
}

class BasePermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->delete();

        // User Management Permissions
        $manageUsers = Permission::where('name', '=', 'manage-users')->first();
        $createUsers = Permission::where('name', '=', 'create-users')->first();
        $viewUsers = Permission::where('name', '=', 'edit-users')->first();
        $editUsers = Permission::where('name', '=', 'view-users')->first();
        $deleteUsers = Permission::where('name', '=', 'delete-users')->first();

        // Role Management Permissions
        $manageRoles = Permission::where('name', '=', 'manage-roles')->first();
        $createRoles = Permission::where('name', '=', 'create-roles')->first();
        $viewRoles = Permission::where('name', '=', 'edit-roles')->first();
        $editRoles = Permission::where('name', '=', 'view-roles')->first();
        $deleteRoles = Permission::where('name', '=', 'delete-roles')->first();

        $sysadminRole = Role::where('name', '=', 'sysadmin')->first();
        $sysadminRole->attachPermissions(array($manageUsers, $createUsers, $editUsers, $viewUsers, $deleteUsers));
        $sysadminRole->attachPermissions(array($manageRoles, $createRoles, $editRoles, $viewRoles, $deleteRoles));

        $adminRole = Role::where('name', '=', 'admin')->first();
        $adminRole->attachPermissions(array($manageUsers, $createUsers, $editUsers, $viewUsers, $deleteUsers));
        $adminRole->attachPermissions(array($manageRoles, $createRoles, $editRoles, $viewRoles, $deleteRoles));
    }
}

class BaseSettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();
        Setting::create([  'name' => 'LinesPerPage', 'description' => 'Lines per Page', 'default_value' => '10', 'kind' => 'int',
            'display_type' => 'select', 'display_values' => '{"10":10, "25":25, "50":50, "100":100}',
            'help' => 'Controls the numbers of rows of data displayed for views with tables',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Setting::create([  'name' => 'MRUList_Users', 'description' => 'MRU Users', 'default_value' => '5', 'kind' => 'int',
            'display_type' => 'number', 'display_values' => '{"min":0, "max":20, "step":1}',
            'help' => 'Number of Most Recently Used/Accessed (MRU List) Users to keep track off',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

