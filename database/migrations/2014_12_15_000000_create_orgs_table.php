<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->decimal('geo_lat', 10, 7)->nullable();
            $table->decimal('geo_long', 10, 7)->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('toll_free')->nullable();
            $table->string('fax')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('org_id')->unsigned()->nullable();
            $table->foreign('org_id')->references('id')->on('orgs');
        });

        Schema::table('roles', function(Blueprint $table)
        {
            $table->integer('org_id')->unsigned()->nullable();
            $table->foreign('org_id')->references('id')->on('orgs');
            $table->dropUnique('roles_name_unique');
            $table->unique(['org_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropForeign('users_org_id_foreign');
            $table->dropColumn('org_id');
        });

        Schema::table('roles', function(Blueprint $table)
        {
            $table->dropForeign('roles_org_id_foreign');
            $table->dropColumn('org_id');
        });
        
        Schema::drop('orgs');
    }
}
