<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => 'Account 1',
            'balance' => '1000'
        ]);

        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => 'Account 2',
            'balance' => '1000'
        ]);
    }
}
