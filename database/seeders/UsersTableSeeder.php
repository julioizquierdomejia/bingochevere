<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        */

        //colocamos en variables roles para poder relacionarlos
        $role_superadmin = Role::where('name', 'superadmin')->first();
        $role_admin = Role::where('name', 'client')->first();
        $role_user = Role::where('name', 'user')->first();

        $user = new User();
        $user->name = 'Alex Barbier';
        $user->email = 'alex@gmail.com';
        $user->status = 1;
        $user->password = bcrypt('sacaroncha88');
        
        $user->save();

        $user->roles()->attach($role_superadmin);


        /*
        $user = new User();
        $user->name = 'Saga Falabella';
        $user->email = 'saga@gmail.com';
        $user->parent_id = 1;
        $user->status = 1;
        $user->password = bcrypt('12345678');
        
        $user->save();

        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Ripley';
        $user->email = 'ripley@gmail.com';
        $user->status = 1;
        $user->parent_id = 1;
        $user->password = bcrypt('12345678');
        
        $user->save();

        $user->roles()->attach($role_admin);
        */
    }
}
