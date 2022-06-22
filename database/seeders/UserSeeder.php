<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Affiliation;
use App\Models\AffiliationItem;
use App\Models\AffiliationLink;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'username' => 'admin',
            'password' => 'admin123'
        ]);

        $operatorUser = User::create([
            'name' => 'Operator',
            'email' => 'operator@app.com',
            'username' => 'operator',
            'password' => 'operator123'
        ]);

        $publisherUser = User::create([
            'name' => 'Publisher',
            'email' => 'publisher@app.com',
            'username' => 'publisher',
            'password' => 'publisher123'
        ]);



        $affiliatorUser = User::create([
            'name' => 'Affiliator',
            'email' => 'affiliator@app.com',
            'username' => 'affiliator',
            'password' => 'affiliator123'
        ]);


        $customerUser = User::create([
            'name' => 'Customer',
            'email' => 'customer@app.com',
            'username' => 'customer',
            'password' => 'customer123'
        ]);


        $permissions = Permission::pluck('id','id')->all();//Permissions

        $adminrole = Role::create(['name' => 'admin']);
        $roleoperator = Role::create(['name' => 'operator']);
        $rolepublisher = Role::create(['name' => 'publisher']);
        $roleaffiliator = Role::create(['name' => 'affiliator']);
        $rolecustomer = Role::create(['name' => 'customer']);



        $adminrole->syncPermissions($permissions);
        $roleoperator->syncPermissions($permissions);
        $rolepublisher->syncPermissions($permissions);
        $roleaffiliator->syncPermissions($permissions);
        $rolecustomer->syncPermissions($permissions);


        $adminUser->assignRole([$adminrole->id]);
        $operatorUser->assignRole([$roleoperator->id]);
        $publisherUser->assignRole([$rolepublisher->id]);
        $affiliatorUser->assignRole([$roleaffiliator->id]);
        $customerUser->assignRole([$rolecustomer->id]);
    }
}
