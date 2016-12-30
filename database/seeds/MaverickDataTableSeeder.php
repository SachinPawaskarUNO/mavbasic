<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Setting;
use App\Org;
use App\Scopes\OrgScope;

class OrgsTableSeeder extends Seeder {

    public function run()
    {
        Org::create([  'name' => 'University of Nebraska Omaha Scott Campus', 'address' => 'University of Nebraska Omaha Scott Campus, 1110 S 67th St',
            'city' => 'Omaha', 'state' => 'NE', 'zip' => '68182',
            'geo_lat' => '41.247469', 'geo_long' => '-96.016100', 'website' => 'https://pki.nebraska.edu', 'phone' => '402.554.3333',
            'toll_free' => '', 'fax' => '', 'contact_name' => '', 'contact_email' => '',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $org = Org::where('name', '=', 'University of Nebraska Omaha Scott Campus')->first();
        User::create([ 'org_id' => $org->id, 'name' => 'George Royce', 'password' => '$2y$10$2bwumehsbJ5vc8kn1XyMQOWA6oVXIRF1oX4QfBvh/XvppAPquTeaG', 'email' => 'groyce@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);

        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first();
        User::create([ 'org_id' => $org->id, 'name' => 'Quinn Nelson', 'password' => '$2y$10$2bwumehsbJ5vc8kn1XyMQOWA6oVXIRF1oX4QfBvh/XvppAPquTeaG', 'email' => 'qnelson@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([ 'org_id' => $org->id, 'name' => 'Donald Steffensmeier', 'password' => '$2y$10$2bwumehsbJ5vc8kn1XyMQOWA6oVXIRF1oX4QfBvh/XvppAPquTeaG', 'email' => 'djsteffy@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([ 'org_id' => $org->id, 'name' => 'Student 1', 'password' => bcrypt('password'), 'email' => 'student1@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([ 'org_id' => $org->id, 'name' => 'Intern 1', 'password' => bcrypt('password'), 'email' => 'intern1@unomaha.edu', 'active' => true,
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
        $this->command->info('Running RoleUserTableSeeder');

        $user = User::where('name', '=', 'George Royce')->first();
//        $user = User::withoutGlobalScope(OrgScope::class)->where('name', '=', 'George Royce')->first();
        $role = Role::where('name', '=', 'admin')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Quinn Nelson')->first();
        $role = Role::where('name', '=', 'student')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Donald Steffensmeier')->first();
        $role = Role::where('name', '=', 'student')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Intern 1')->first();
        $role = Role::where('name', '=', 'readonly')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
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

//class OrgUserTableSeeder extends Seeder {
//
//    public function run()
//    {
//        $user = User::where('name', '=', 'George Royce')->first()->id;
//        $org = Org::where('name', '=', 'University of Nebraska Omaha Scott Campus')->first()->id;
//        $org_user = [ ['org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
//        DB::table('org_user')->insert($org_user);
//
//        $user = User::where('name', '=', 'Quinn Nelson')->first()->id;
//        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first()->id;
//        $org_user = [ ['org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
//        DB::table('org_user')->insert($org_user);
//
//        $user = User::where('name', '=', 'Donald Steffensmeier')->first()->id;
//        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first()->id;
//        $org_user = [ 'org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()  ];
//        DB::table('org_user')->insert($org_user);
//
//        $user = User::where('name', '=', 'Intern 1')->first()->id;
//        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first()->id;
//        $org_user = [ 'org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()  ];
//        DB::table('org_user')->insert($org_user);
//    }
//}

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        Setting::create([  'name' => 'accession', 'description' => 'Accession Number', 'default_value' => 'UNO-2016-001', 'kind' => 'string',
            'display_type' => 'text', 'display_values' => '',
            'help' => 'If set, the accession number will be auto-populated on New SE screen',
            'type' => 'user', 'group' => 'se', 'display_order' => 2001,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class SettingUserTableSeeder extends Seeder {

    public function run()
    {
//        $user = User::where('name', '=', 'George Royce')->first();
//        $setting = Setting::where('name', '=', 'lines_per_page')->first();
//        $setting_user = [ ['setting_id' => $setting->id, 'user_id' => $user->id, 'value' => '25', 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
//        DB::table('setting_user')->insert($setting_user);
    }
}
