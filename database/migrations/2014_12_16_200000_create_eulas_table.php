<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id')->unsigned();
            $table->string('version')->unique();
            $table->text('agreement');
            $table->string('language')->default('en');
            $table->string('country')->default('US');
            $table->enum('status', ['Draft', 'Active', 'InActive'])->default('Draft');
            $table->enum('file_type', ['Text', 'PDF'])->default('Text');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamp('effective_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('org_id')->references('id')->on('orgs')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating eulas to users (Many-to-Many)
        Schema::create('eula_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('eula_id')->unsigned();
            $table->string('signature')->nullable();
            $table->timestamp('accepted_at');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('eula_id')->references('id')->on('eulas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'eula_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eula_user');
        Schema::drop('eulas');
    }
}
