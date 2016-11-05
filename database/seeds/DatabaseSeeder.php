<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Settings;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // run in console before first run
        // ./artisan db:seed

        $this->call('MkDataBase');

        User::create([
            'name' => 'admin',
            'email' => 'admin@nairbl.local',
            'password' => bcrypt('admin')
        ]);

        $info =[
          'title' => 'My blog',
            'author' => 'admin',
            'slogan' => 'slogan'
        ];

        \DB::beginTransaction();

        foreach ($info as $key => $value){
            Settings::create([
                'group' => 'info',
                'setting_key' => $key,
                'setting' => $value
            ]);
        }

        \DB::commit();
    }
}
