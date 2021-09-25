<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TariffBase extends Model
{
    protected $fillable = [
        'tariff_bases',
        'tariff_label',
        'tariff_amount',
        'tariff_active',
        'tariff_desc',
    ];
/*$table->string('tariff_bases')->nullable();
$table->string('tariff_label')->nullable();
$table->string('tariff_amount')->nullable();
$table->tinyInteger('tariff_active')->default(1)->nullable();
$table->text('tariff_desc')->nullable();*/
}
