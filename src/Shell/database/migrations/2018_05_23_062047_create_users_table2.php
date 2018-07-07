<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('shelldb')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',25)->unique();
            $table->string('email',100)->unique();
            $table->string('name',100);
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('theme')->nullable();
            $table->boolean('registered')->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->string('registered_by')->nullable();
            $table->boolean('deleted')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->macAddress('last_mac_address')->nullable();
            $table->ipAddress('last_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
