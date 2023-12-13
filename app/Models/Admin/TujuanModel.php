<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanModel extends Model
{
    use HasFactory;
    protected $table = "tbl_tujuan";
    protected $primaryKey = 'tujuan_id';
    protected $fillable = [
        'tujuan_kode',
        'tujuan_nama',
        'tujuan_slug',
        'tujuan_alamat',
    ]; 
}
