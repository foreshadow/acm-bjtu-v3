<?php

use Illuminate\Database\Migrations\Migration;
use Ultraware\Roles\Models\Role;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Role::create(['name' => 'Super Admin', 'slug' => 'superadmin', 'level' => 4]);
        Role::create(['name' => 'Admin', 'slug' => 'admin', 'level' => 3]);
        Role::create(['name' => 'Bjtu ACMer', 'slug' => 'bjtuacm', 'level' => 2]);
        Role::create(['name' => 'Registered User', 'slug' => 'registereduser', 'level' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Role::where('slug', 'superadmin')->delete();
        Role::where('slug', 'admin')->delete();
        Role::where('slug', 'bjtuacm')->delete();
        Role::where('slug', 'registereduser')->delete();
    }
}
