<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteLog extends Model
{
    //this is the way you can set the name. The reason is that laravel assumes
    //the default name quotes_log to be the default name as it adds an 's' to the 
    //models name
    protected $table = 'quote_log';
}
