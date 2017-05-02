<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = '晚照清舟';
        $user->email = 'spboke.xyz@gmail.com';
        $user->password = bcrypt('18961855677w');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
