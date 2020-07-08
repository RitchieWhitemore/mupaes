<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('type')->default(0);
            $table->string('item_type')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('link')->nullable();
            $table->boolean('show_menu')->default(0);
            $table->boolean('hide_children')->default(0);
            NestedSet::columns($table);
            $table->boolean('hidden')->index('i-hidden')->default(0);
            $table->timestamps();
        });

        \Whitemore\Menu\Models\Menu::create(['title' => 'root']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
