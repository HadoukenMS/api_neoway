<?php

namespace App;

#use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Registros extends Model
{
    protected $table = 'table_registros';
    public $timestamps = false;
    protected $fillable = [
		'id',
		'label',
		'numero',
		'blacklist'
	];

	protected $guarded = [
		'id',
		'label',
		'numero',
		'blacklist'
	];
}
