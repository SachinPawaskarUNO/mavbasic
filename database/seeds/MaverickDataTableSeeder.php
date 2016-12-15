<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Setting;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::create([  'name' => 'Administrator', 'password' => '$2y$10$aCCNiy0HhJ4Yb31jii5QA.3sUoQr9rvjLOL72w1Gi1rUEphHzm8YK', 'email' => 'basicadmin@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'George Royce', 'password' => '$2y$10$aCCNiy0HhJ4Yb31jii5QA.3sUoQr9rvjLOL72w1Gi1rUEphHzm8YK', 'email' => 'groyce@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'Quinn Nelson', 'password' => '$2y$10$aCCNiy0HhJ4Yb31jii5QA.3sUoQr9rvjLOL72w1Gi1rUEphHzm8YK', 'email' => 'qnelson@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'Donald Steffensmeier', 'password' => '$2y$10$aCCNiy0HhJ4Yb31jii5QA.3sUoQr9rvjLOL72w1Gi1rUEphHzm8YK', 'email' => 'djsteffy@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'Student 1', 'password' => bcrypt('password'), 'email' => 'student1@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([  'name' => 'Intern 1', 'password' => bcrypt('password'), 'email' => 'intern1@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class RolesTableSeeder extends Seeder {

    public function run()
    {
        Role::create([ 'name' => 'faculty', 'display_name' => 'Faculty', 'description' => 'Faculty is allowed to manage ...',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'advisor', 'display_name' => 'Advisor', 'description' => 'Advisor is allowed to manage ...',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'staff', 'display_name' => 'Staff', 'description' => 'Staff is allowed to manage ...',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'student', 'display_name' => 'Student', 'description' => 'Student is allowed to manage ...',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'readonly', 'display_name' => 'ReadOnly', 'description' => 'ReadOnly is allowed Read access to ...',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        // Add any additional new permissions here.
    }
}

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        $user = User::where('name', '=', 'Administrator')->first()->id;
        $role = Role::where('name', '=', 'admin')->first()->id;
        $role_user = [ ['role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'George Royce')->first()->id;
        $role = Role::where('name', '=', 'admin')->first()->id;
        $role_user = [ ['role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Quinn Nelson')->first()->id;
        $role = Role::where('name', '=', 'student')->first()->id;
        $role_user = [ ['role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Donald Steffensmeier')->first()->id;
        $role = Role::where('name', '=', 'student')->first()->id;
        $role_user = [ 'role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()  ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Intern 1')->first()->id;
        $role = Role::where('name', '=', 'readonly')->first()->id;
        $role_user = [ 'role_id' => $role, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()  ];
        DB::table('role_user')->insert($role_user);
    }
}

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        // User Management Permissions
        $manageUsers = Permission::where('name', '=', 'manage-users')->first();
        $viewUsers = Permission::where('name', '=', 'view-users')->first();

        // Role Management Permissions
        $manageRoles = Permission::where('name', '=', 'manage-roles')->first();
        $viewRoles = Permission::where('name', '=', 'view-roles')->first();

        // Assign Permissions to specific Roles below
        $studentRole = Role::where('name', '=', 'student')->first();
        $studentRole->attachPermissions(array($manageUsers, $viewUsers, $manageRoles, $viewRoles));

        $readonlyRole = Role::where('name', '=', 'readonly')->first();
        $readonlyRole->attachPermissions(array($viewUsers, $viewRoles));
    }
}

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        Setting::create([  'name' => 'Accession', 'description' => 'Accession Number', 'default_value' => '', 'kind' => 'string',
            'display_type' => 'text', 'display_values' => '',
            'help' => 'If set, the accession number will be auto-populated on New SE screen',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class SettingUserTableSeeder extends Seeder {

    public function run()
    {
        $user = User::where('name', '=', 'Administrator')->first()->id;
        $setting = Setting::where('name', '=', 'LinesPerPage')->first()->id;
        $setting_user = [ ['setting_id' => $setting, 'user_id' => $user, 'value' => '25', 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('setting_user')->insert($setting_user);

        $user = User::where('name', '=', 'George Royce')->first()->id;
        $setting = Setting::where('name', '=', 'LinesPerPage')->first()->id;
        $setting_user = [ ['setting_id' => $setting, 'user_id' => $user, 'value' => '25', 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
        DB::table('setting_user')->insert($setting_user);
    }
}
