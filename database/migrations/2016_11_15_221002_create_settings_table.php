<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->string('help');
            $table->string('default_value');
            $table->enum('kind', ['string', 'int', 'bool']); // e.g. string, int, bool
            $table->enum('display_type', ['text', 'select', 'checkbox', 'number']); // e.g. text, select, checkbox, number
            $table->string('display_values')->nullable(); // e.g. json: {'10': 10, '25': 25, '50': 50, '100': 100}
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('setting_user', function (Blueprint $table) {
//            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('setting_id')->unsigned();
            $table->string('value');
            $table->string('json_values', '2048')->nullable();  // This will be specific for that setting.
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('setting_id')->references('id')->on('settings')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'setting_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('setting_user');
        Schema::drop('settings');
    }
}
