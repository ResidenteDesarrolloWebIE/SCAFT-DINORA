<?php

use Illuminate\Database\Seeder;
use App\Models\UserDetails\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'client';
        $role->description = 'Cliente';
        $role->save();
    }
}
