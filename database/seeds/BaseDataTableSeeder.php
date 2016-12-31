<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;
use App\Org;
use App\Setting;
use App\Eula;

class BaseOrgsTableSeeder extends Seeder {

    public function run()
    {
        Org::create([ 'name' => 'University of Nebraska Omaha', 'address' => 'University of Nebraska Omaha, 6001 Dodge Street',
            'city' => 'Omaha', 'state' => 'NE', 'zip' => '68182',
            'geo_lat' => '41.258481', 'geo_long' => '-96.010379', 'website' => 'http://www.unomaha.edu/', 'phone' => '402.554.2800',
            'toll_free' => '', 'fax' => '', 'contact_name' => '', 'contact_email' => '',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BaseUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first();

        User::create([ 'name' => 'System', 'password' => '$2y$10$HuOeNE1zocSXywttHTK9TexEpcz7G.rKgpOGsuTeY/uIsrxylva6i', 'email' => 'system@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([ 'org_id' => $org->id, 'name' => 'Sachin Pawaskar', 'password' => '$2y$10$HuOeNE1zocSXywttHTK9TexEpcz7G.rKgpOGsuTeY/uIsrxylva6i', 'email' => 'spawaskar@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        User::create([ 'org_id' => $org->id, 'name' => 'Sachin Pawaskar - OrgAdmin', 'password' => '$2y$10$HuOeNE1zocSXywttHTK9TexEpcz7G.rKgpOGsuTeY/uIsrxylva6i', 'email' => 'spawaskar.orgadmin@unomaha.edu', 'active' => true,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BaseRolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        Role::create([ 'name' => 'sysadmin', 'display_name' => 'System Administrator', 'description' => 'System Administrator User has all permissions',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Role::create([ 'name' => 'admin', 'display_name' => 'Org Administrator', 'description' => 'User is allowed to manage and edit other users within their organization',
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

        // Org Management Permissions
        Permission::create([ 'name' => 'manage-orgs', 'display_name' => 'Manage Orgs', 'description' => 'User is allowed to add, edit and delete orgs',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'create-orgs', 'display_name' => 'Create Orgs', 'description' => 'User is allowed to add other orgs',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'edit-orgs', 'display_name' => 'Edit Orgs', 'description' => 'User is allowed to edit other orgs',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-orgs', 'display_name' => 'View Orgs', 'description' => 'User is allowed to view other orgs',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'delete-orgs', 'display_name' => 'Delete Orgs', 'description' => 'User is allowed to delete other orgs',
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

        // EULA Management Permissions
        Permission::create([ 'name' => 'manage-eulas', 'display_name' => 'Manage EULAs', 'description' => 'User is allowed to add, edit and delete eulas',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'create-eulas', 'display_name' => 'Create EULAs', 'description' => 'User is allowed to add other eulas',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'edit-eulas', 'display_name' => 'Edit EULAs', 'description' => 'User is allowed to edit other eulas',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'view-eulas', 'display_name' => 'View EULAs', 'description' => 'User is allowed to view other eulas',
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Permission::create([ 'name' => 'delete-eulas', 'display_name' => 'Delete EULAs', 'description' => 'User is allowed to delete other eulas',
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

        $user = User::withoutGlobalScope(OrgScope::class)->where('name', '=', 'System')->first();
        $user = User::where('name', '=', 'System')->first();
        $role = Role::where('name', '=', 'sysadmin')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
        DB::table('role_user')->insert($role_user);

//        $user = User::withoutGlobalScope(OrgScope::class)->where('name', '=', 'Sachin Pawaskar')->first();
//        dd($user);
        $user = User::where('name', '=', 'Sachin Pawaskar')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
        DB::table('role_user')->insert($role_user);

        $user = User::where('name', '=', 'Sachin Pawaskar - OrgAdmin')->first();
//        $user = User::withoutGlobalScope(OrgScope::class)->where('name', '=', 'Sachin Pawaskar - OrgAdmin')->first();
//        dd($user);
        $role = Role::where('name', '=', 'admin')->first();
        $role_user = [ 'role_id' => $role->id, 'user_id' => $user->id, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ];
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

//class BaseOrgUserTableSeeder extends Seeder {
//
//    public function run()
//    {
//        DB::table('org_user')->delete();
//
//        $user = User::where('name', '=', 'Sachin Pawaskar')->first()->id;
//        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first()->id;
//        $org_user = [ ['org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
//        DB::table('org_user')->insert($org_user);
//
//        $user = User::where('name', '=', 'Sachin Pawaskar - OrgAdmin')->first()->id;
//        $org_user = [ ['org_id' => $org, 'user_id' => $user, 'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create() ] ];
//        DB::table('org_user')->insert($org_user);
//    }
//}

class BaseSettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();
        // User settings
        Setting::create([  'name' => 'lines_per_page', 'description' => 'Lines per Page', 'default_value' => '10', 'kind' => 'int',
            'display_type' => 'select', 'display_values' => '{"10":10, "25":25, "50":50, "100":100}',
            'help' => 'Controls the numbers of rows of data displayed for views with tables',
            'type' => 'user', 'group' => 'ui', 'display_order' => 1010,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Setting::create([  'name' => 'mru_list_users', 'description' => 'MRU Users', 'default_value' => '5', 'kind' => 'int',
            'display_type' => 'number', 'display_values' => '{"min":0, "max":20, "step":1}',
            'help' => 'Number of Most Recently Used/Accessed (MRU List) Users to keep track off',
            'type' => 'user', 'group' => 'ui', 'display_order' => 1020,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Setting::create([  'name' => 'welcome_screen_on_startup', 'description' => 'Welcome Screen on Startup', 'default_value' => 'true', 'kind' => 'bool',
            'display_type' => 'checkbox', 'display_values' => '',
            'help' => 'Displays the Welcome Screen on startup when the user logs into the application.',
            'type' => 'user', 'group' => 'ui', 'display_order' => 1030,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);

        // Org settings
        Setting::create([  'name' => 'eula_processing', 'description' => 'Eula Processing', 'default_value' => 'false', 'kind' => 'bool',
            'display_type' => 'checkbox', 'display_values' => '',
            'help' => 'Displays the Eula Acceptance Screen on startup when the user logs into the application for the first time',
            'type' => 'org', 'group' => 'ui', 'display_order' => 1040,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Setting::create([  'name' => 'welcome_screen_url', 'description' => 'Welcome Screen URL', 'default_value' => '\welcome', 'kind' => 'url',
            'display_type' => 'text', 'display_values' => '',
            'help' => 'Configure the URL for the welcome screen that is displayed to the user on startup when the user logs into the application.',
            'type' => 'org', 'group' => 'ui', 'display_order' => 1050,
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

class BaseEulasTableSeeder extends Seeder {

    public function run()
    {
        DB::table('eulas')->delete();
        $org = Org::where('name', '=', 'University of Nebraska Omaha')->first();

        Eula::create([ 'org_id' => $org->id, 'version' => '1.0', 'country' => 'US', 'language' => 'en', 'status' => 'Active',
            'agreement' => 'End-User License Agreement for MavBasic
                            This End-User License Agreement (EULA) is a legal agreement between you (either an individual or a single entity) and the mentioned author (MavBasic) of this Software for the software product identified above, which includes computer software and may include associated media, printed materials, and “online” or electronic documentation (“SOFTWARE PRODUCT”).

                            By installing, copying, or otherwise using the SOFTWARE PRODUCT, you agree to be bounded by the terms of this EULA.
                            If you do not agree to the terms of this EULA, do not install or use the SOFTWARE PRODUCT.

                            SOFTWARE PRODUCT LICENSE
                            a) MavBasic Free Version is being distributed as Freeware for personal, commercial use, non-profit organization, educational purpose. It may be included with CD-ROM/DVD-ROM distributions. You are NOT allowed to make a charge for distributing this Software (either for profit or merely to recover your media and distribution costs) whether as a stand-alone product, or as part of a compilation or anthology, nor to use it for supporting your business or customers. It may be distributed freely on any website or through any other distribution mechanism, as long as no part of it is changed in any way.
                            b) MavBasic Professional Version, another all-in-one diagram software, is available with more advanced features.

                            1. GRANT OF LICENSE. This EULA grants you the following rights: Installation and Use. You may install and use an unlimited number of copies of the SOFTWARE PRODUCT.
                            Reproduction and Distribution. You may reproduce and distribute an unlimited number of copies of the SOFTWARE PRODUCT; provided that each copy shall be a true and complete copy, including all copyright and trademark notices, and shall be accompanied by a copy of this EULA.
                            Copies of the SOFTWARE PRODUCT may be distributed as a standalone product or included with your own product as long as The SOFTWARE PRODUCT is not sold or included in a product or package that intends to receive benefits through the inclusion of the SOFTWARE PRODUCT.

                            The SOFTWARE PRODUCT may be included in any free or non-profit packages or products.

                            2. DESCRIPTION OF OTHER RIGHTS AND LIMITATIONS.
                            Limitations on Reverse Engineering, Decompilation, Disassembly and change (add,delete or modify) the resources in the compiled the assembly. You may not reverse engineer, decompile, or disassemble the SOFTWARE PRODUCT, except and only to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation.

                            Update and Maintenance
                            MavBasic upgrades are FREE of charge.

                            Separation of Components.
                            The SOFTWARE PRODUCT is licensed as a single product. Its component parts may not be separated for use on more than one computer.

                            Software Transfer.
                            You may permanently transfer all of your rights under this EULA, provided the recipient agrees to the terms of this EULA.

                            Termination.
                            Without prejudice to any other rights, the Author of this Software may terminate this EULA if you fail to comply with the terms and conditions of this EULA. In such event, you must destroy all copies of the SOFTWARE PRODUCT and all of its component parts.

                            3. COPYRIGHT.
                            All title and copyrights in and to the SOFTWARE PRODUCT (including but not limited to any images, photographs, clipart, libraries, and examples incorporated into the SOFTWARE PRODUCT), the accompanying printed materials, and any copies of the SOFTWARE PRODUCT are owned by the Author of this Software. The SOFTWARE PRODUCT is protected by copyright laws and international treaty provisions. Therefore, you must treat the SOFTWARE PRODUCT like any other copyrighted material. The licensed users or licensed company can use all functions, example, templates, clipart, libraries and symbols in the SOFTWARE PRODUCT to create new diagrams and distribute the diagrams.
                        
                            LIMITED WARRANTY
                        
                            NO WARRANTIES.
                            The Author of this Software expressly disclaims any warranty for the SOFTWARE PRODUCT. The SOFTWARE PRODUCT and any related documentation is provided “as is” without warranty of any kind, either express or implied, including, without limitation, the implied warranties or merchantability, fitness for a particular purpose, or noninfringement. The entire risk arising out of use or performance of the SOFTWARE PRODUCT remains with you.
                            
                            NO LIABILITY FOR DAMAGES.
                             In no event shall the author of this Software be liable for any special, consequential, incidental or indirect damages whatsoever (including, without limitation, damages for loss of business profits, business interruption, loss of business information, or any other pecuniary loss) arising out of the use of or inability to use this product, even if the Author of this Software is aware of the possibility of such damages and known defects.',

            'file_type' => 'Text', 'effective_at' => date_create(),
            'created_by' => 'System', 'updated_by' => 'System', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}

