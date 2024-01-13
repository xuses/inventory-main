<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanModel extends Model
{
    use HasFactory;
    protected $table = "tbl_lokasi";
    protected $primaryKey = 'lokasi_id';
    protected $fillable = [
        'bk_tujuan',
        'lokasi_nama',
        'lokasi_slug',
        'lokasi_alamat'
    ]; 
}
