<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamp('added_at')->default('now');
            $table->foreignId('unit_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('location_id');
                // ->constrained('sqlsrv.dbo.Кадры_Подразделения')
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
            $table->text('cause')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_logs');
    }
}
