<?php

namespace Database\Seeders;

use App\Utils\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
                'name' => Roles::$ADMIN
            ]
        );
        Role::create(
            [
                'name' => Roles::$USER
            ]
        );
        Role::create(
            [
                'name' => Roles::$PREMIUM_USER
            ]
        );
    }
}
