<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'keranjang';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_keranjang';
    
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
		'keranjang',
        'member'
	];
}
