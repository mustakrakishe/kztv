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
            $table->timestamps();
            $table->foreignId('device_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('location_id');
                // ->constrained('sqlsrv.dbo.Кадры_Подразделения')
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
            $table->text('cause');
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
