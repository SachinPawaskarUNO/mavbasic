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
            $table->enum('type', ['user', 'org', 'system'])->default('user'); // e.g. user. org and system
            $table->string('group'); // display group name
            $table->integer('display_order'); // display order
            $table->string('default_value');
            $table->enum('kind', ['string', 'int', 'bool', 'url', 'object', 'model']); // e.g. string, int, bool, url, object/model
            $table->enum('display_type', ['text', 'select', 'checkbox', 'number']); // e.g. text, select, checkbox, number
            $table->string('display_values')->nullable(); // e.g. json: {'10': 10, '25': 25, '50': 50, '100': 100}
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('settingables', function (Blueprint $table) {
            $table->integer('setting_id')->unsigned()->index();
            $table->morphs('settingable');
            $table->string('value');
            $table->string('json_values', '2048')->nullable();  // This will be specific for that setting.
            $table->boolean('override')->default(false);
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('setting_id')->references('id')->on('settings')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settingables');
        Schema::drop('settings');
    }
}
