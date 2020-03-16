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
        User::create([
            'name' => 'Daengweb',
            'email' => 'admin@daengweb.id',
            'id_roles' => '1',
            'password' => bcrypt('secret'),
            'status' => true
        ]);


        User::create([
            'name' => 'ranti',
            'email' => 'ranti@ivo.id',
            'id_roles' => '2',
            'password' => bcrypt('ivo12345'),
            'status' => true
        ]);


        User::create([
            'name' => 'wiki',
            'email' => 'wiki@widi.id',
            'id_roles' => '3',
            'password' => bcrypt('widi12345'),
            'status' => true
        ]);
    }
}
