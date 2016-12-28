<?php

use Illuminate\Database\Seeder;
use App\Http\Traits\AuditsTrait;
use App\Tag;

class MaverickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuditsTrait::stopAudit("Maverick Seeder");
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('      Start: Seeding Maverick Orgs, User, Roles and Permissions         !');
        $this->command->info('------------------------------------------------------------------------!');
        $this->call(OrgsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->command->info('User, Role and Permission tables seeded!');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('        End: Seeding Maverick Orgs, User, Roles and Permissions         !');
        $this->command->info('------------------------------------------------------------------------!');

        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                          Start: Seeding Tags                           !');
        $this->command->info('------------------------------------------------------------------------!');
        $this->call(TagsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(SettingUserTableSeeder::class);
        $this->command->info('Tags tables seeded!');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                          End: Seeding Tags                             !');
        $this->command->info('------------------------------------------------------------------------!');
        AuditsTrait::startAudit();
    }
}

class TagsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();
        Tag::create([ 'name' => 'Athlete']);
        Tag::create([ 'name' => 'First Generation']);
        Tag::create([ 'name' => 'Graduate']);
        Tag::create([ 'name' => 'International']);
        Tag::create([ 'name' => 'Military & Veteran']);
        Tag::create([ 'name' => 'Retention Risk']);
        Tag::create([ 'name' => 'Scotts Scholar']);
        Tag::create([ 'name' => 'Undergraduate']);
    }
}

