<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(isset($password))

        DB::table('users')->insert([
            ['name' => 'Atlas一郎',
            'mail'=>'atlas1@gmail.com',
            'password' => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10)],

            ['name' => 'Atlas二郎',
            'mail'=>'atlas2@gmail.com',
            'password' => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10)],

            ['name' => 'Atlas三郎',
            'mail'=>'atlas3@gmail.com',
            'password' => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10)],

            ['name' => 'Atlas四郎',
            'mail'=>'atlas4@gmail.com',
            'password'=> $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10)]
        ]);
    }
}


//passwardはハッシュ化　新規登録のページUserFactory.php参考　bcryptとは暗号関数
 //シード作成　php artisan make:seeder usersTableSeederで作ったページ　名前登録する
        //⓵datebaseseederに移動する


