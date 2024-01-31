<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = array('id', 'nama_supplier', 'alamat_supplier', 'kontak');
    protected $primaryKey = 'id';
    public $timestamps = true;
}