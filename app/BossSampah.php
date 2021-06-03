<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BossSampah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boss_sampah';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_boss_sampah';

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected $fillable = [
		'alamat',
		'waktu_ambil_sampah',
		'member',
		'kurir',
        'berat',
        'total_harga',
        'sudah_diambil',
        'tambahkan_uang_ke_saldo',
	];
}
