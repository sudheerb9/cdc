<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Placement extends Model
{
    public $table = 'placements';
    public $fillable = ['company_name', 'profile'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($data) {
            $newColumnName = $data->company_name; 
            Schema::table('fourthyear', function($table) use ($data)
            {
                $resume = 'resume';
                $resume = $data->company_name.$resume;
                $table->string($data->company_name)->default('0');
                $table->string($resume)->default('0');
            });
        });

        static::deleting(function ($data) {
            Schema::table('fourthyear', function($table) use ($data) {
                $resume = 'resume';
                $resume = $data->company_name.$resume;
                $table->dropColumn($data->company_name);
                $table->dropColumn($resume);
            });
        });
    }
}
