<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name')->nullable();
            $table->string('field_name_latin')->nullable();
            $table->string('field_type')->nullable();
            $table->string('field_model')->nullable();
            $table->integer('field_length')->default(11)->nullable();
            $table->string('field_default_value')->nullable();
            $table->tinyInteger('field_required')->default(0)->nullable();
            $table->string('field_filter')->default(0)->nullable();
            $table->string('field_active')->default(0)->nullable();
            $table->text('field_help')->nullable();
            $table->tinyInteger('check_class_public')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *Name latin
    Name label
    Type
    Model
    Field Length
    Default value
    Required
    Help
    Use as filter
    Active

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customize_fields');
    }
}
