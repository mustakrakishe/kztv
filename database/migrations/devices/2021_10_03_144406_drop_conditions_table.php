<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Modernization;
use App\Models\Repair;
use App\Models\Condition;

class DropConditionsTable extends Migration
{
    
    public function up(){

        // Change modernizations table

        Schema::table('modernizations', function (Blueprint $table) {
            $table->text('characteristics')->nullable();
            $table->unsignedInteger('device_id')->nullable();
        });

        foreach(Modernization::all() as $modernization){
            $condition = Condition::find($modernization->condition_id);
            $modernization->device_id = $condition->device_id;
            $modernization->characteristics = $condition->characteristics;
            $modernization->save();
        }

        Schema::table('modernizations', function (Blueprint $table) {
            $table->unsignedInteger('device_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('cascade')->change();
            $table->dropColumn('condition_id');
        });
        
        // Change repairs table

        Schema::table('repairs', function (Blueprint $table) {
            $table->text('characteristics')->nullable();
            $table->unsignedInteger('device_id')->nullable();
        });

        foreach(Repair::all() as $repair){
            $condition = Condition::find($repair->condition_id);
            $repair->device_id = $condition->device_id;
            $repair->characteristics = $condition->characteristics;
            $repair->save();
        }

        Schema::table('repairs', function (Blueprint $table) {
            $table->unsignedInteger('device_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('cascade')->change();
            $table->dropColumn('condition_id');
        });
        
        // Drop conditions table
        
        Schema::dropIfExists('conditions');
    }
    
    public function down(){

        // Create conditions table
        
        Schema::create('conditions', function (Blueprint $table) {
            $table->id();
            $table->text('characteristics')->nullable();
            $table->unsignedInteger('device_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });

        // Change repairs table

        Schema::table('repairs', function (Blueprint $table) {
            $table->unsignedInteger('condition_id')->nullable();
        });
            
        foreach(Repair::all() as $repair){
            $condition = new Condition;
            $condition->device_id = $repair->device_id;
            $condition->characteristics = $repair->characteristics;
            $condition->save();
        }
            
        Schema::table('repairs', function (Blueprint $table) {
            $table->unsignedInteger('condition_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('cascade')->change();
            $table->dropColumn('characteristics');
            $table->dropColumn('device_id');
        });

        // Change modernizations table

        Schema::table('modernizations', function (Blueprint $table) {
            $table->unsignedInteger('condition_id')->nullable();
        });
            
        foreach(Repair::all() as $repair){
            $condition = new Condition;
            $condition->device_id = $modernizations->device_id;
            $condition->characteristics = $modernizations->characteristics;
            $condition->save();
        }
            
        Schema::table('modernizations', function (Blueprint $table) {
            $table->unsignedInteger('condition_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('cascade')->change();
            $table->dropColumn('characteristics');
            $table->dropColumn('device_id');
        });
    }
}
