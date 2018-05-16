<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesSlidesTable extends Migration
{
    public $set_schema_table = 'games_slides';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('slides_id');
            $table->integer('games_id');
            $table->index(["slides_id"], 'fk_games_slides_slides1_idx');


            $table->foreign('slides_id', 'fk_games_slides_slides1_idx')
                ->references('id')->on('slides')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}
