<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpTicketCategory extends Model
{
    protected $table = 'help_ticket_categories';
    protected $fillable = ['category'];
}
