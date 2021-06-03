<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaSampah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'harga_sampah';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_harga_sampah';
    
    /**
     * Add nullable creation and update timestamps to the table.
     *
     * @param  int  $precision
     * @return void
     */
	public $timestamps = false;

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'harga',
	];
}
