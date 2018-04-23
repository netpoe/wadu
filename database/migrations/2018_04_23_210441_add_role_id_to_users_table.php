<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable()->after('id');
            $table->integer('business_id')->unsigned()->nullable()->after('role_id');
            $table->foreign('role_id', 'users_to_user_role')->references('id')->on('user_role')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('business_id', 'users_to_business')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
            $table->dropForeign('users_to_user_role');
            $table->dropForeign('users_to_business');
        });
    }
}
