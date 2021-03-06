<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Super Admin']);
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Teacher']);
        $role = Role::create(['name' => 'Student']);

    }
}
