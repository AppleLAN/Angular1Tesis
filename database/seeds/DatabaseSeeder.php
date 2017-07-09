<?php
use Illuminate\Database\Seeder;
use App\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_roles = [
          ['role_name' => 'ADMIN'],
          ['role_name' => 'NORMAL_USER'],          
      ];
      
      foreach($user_roles as $ur) {
          $role = new Roles();
          $role->role_name = $ur['role_name'];
          $role->save();
      }
    }
}