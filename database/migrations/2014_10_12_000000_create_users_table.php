<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->string('phone')->nullable();
            $table->string('default_language')->default('en');
            $table->string('default_country')->default('US');
            $table->ipAddress('last_login_ip_address')->nullable();
            $table->string('last_login_device', 512)->nullable();
            $table->integer('number_of_logins')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('expiration_at')->default(Carbon::maxValue());
            $table->timestamp('password_change_at')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
