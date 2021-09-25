<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = [
        'ticket_category_name',
        'ticket_category_latin',
    ];
}
