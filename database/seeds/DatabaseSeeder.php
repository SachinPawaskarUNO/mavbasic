<?php

use Illuminate\Database\Seeder;
use App\Http\Traits\AuditsTrait;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuditsTrait::stopAudit("Database Seeding");
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('               Start: Seeding User, Roles and Permissions               !');
        $this->command->info('------------------------------------------------------------------------!');
        // Seed the System Users/Roles/Permissions tables
        $this->call(BaseRolesTableSeeder::class);
        $this->call(BasePermissionsTableSeeder::class);
        $this->call(BaseUsersTableSeeder::class);
        $this->call(BaseRoleUserTableSeeder::class);
        $this->call(BasePermissionRoleTableSeeder::class);
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                End: Seeding User, Roles and Permissions                !');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                        Start: Seeding Setting, Eula                    !');
        $this->command->info('------------------------------------------------------------------------!');
        $this->call(BaseSettingsTableSeeder::class);
        $this->call(BaseEulasTableSeeder::class);
        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('                         End: Seeding Setting, Eula                     !');
        $this->command->info('------------------------------------------------------------------------!');
        AuditsTrait::startAudit();
    }
}
