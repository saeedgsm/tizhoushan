<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_bases', function (Blueprint $table) {
            $table->id();
            $table->string('base_title')->nullable();
            $table->string('base_label')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('educational_bases')->insert([
            [
                'id'=>1,
                'base_title'=>'اول',
                'base_label'=>'اول',
            ],
            [
                'id'=>2,
                'base_title'=>'دوم',
                'base_label'=>'دوم',
            ],
            [
                'id'=>3,
                'base_title'=>'سوم',
                'base_label'=>'سوم',
            ],
            [
                'id'=>4,
                'base_title'=>'چهارم',
                'base_label'=>'چهارم',
            ],
            [
                'id'=>5,
                'base_title'=>'پنجم',
                'base_label'=>'پنجم',
            ],
            [
                'id'=>6,
                'base_title'=>'ششم',
                'base_label'=>'ششم',
            ],
            [
                'id'=>7,
                'base_title'=>'هفتم',
                'base_label'=>'هفتم',
            ],
            [
                'id'=>8,
                'base_title'=>'هشتم',
                'base_label'=>'هشتم',
            ],
            [
                'id'=>9,
                'base_title'=>'نهم',
                'base_label'=>'نهم',
            ],
            [
                'id'=>10,
                'base_title'=>'دهم',
                'base_label'=>'دهم',
            ],
            [
                'id'=>11,
                'base_title'=>'یازدهم',
                'base_label'=>'یازدهم',
            ],
            [
                'id'=>12,
                'base_title'=>'دوازهم',
                'base_label'=>'دوازهم',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educational_bases');
    }
}
