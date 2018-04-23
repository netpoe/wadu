<?php

use Illuminate\Database\Seeder;

use App\Model\User\UserRoleAdapter as UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new UserRole;

        foreach (UserRole::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
