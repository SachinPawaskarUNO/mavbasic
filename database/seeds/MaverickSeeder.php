<?php

use Illuminate\Database\Seeder;
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
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('         Start: Seeding Maverick User, Roles and Permissions            !');
        $this->command->info('------------------------------------------------------------------------!');
        // Seed the System Users/Roles/Permissions tables
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->command->info('User, Role and Permission tables seeded!');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('           End: Seeding Maverick User, Roles and Permissions            !');
        $this->command->info('------------------------------------------------------------------------!');

        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                          Start: Seeding Tags                           !');
        $this->command->info('------------------------------------------------------------------------!');
        // Seed the Tags table
        $this->call(TagsTableSeeder::class);
        $this->command->info('Tags tables seeded!');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                          End: Seeding Tags                             !');
        $this->command->info('------------------------------------------------------------------------!');
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

