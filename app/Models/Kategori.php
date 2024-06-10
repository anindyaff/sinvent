<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['kategori','deskripsi'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
        
    }
    

    public static function getKategoriAll()
    {
        return DB::table('kategori')
            // ->select('kategori.id', 'kategori','deskripsi',DB::raw('ketKategorik(deskripsi) as ketKategorik'))
            ->select('kategori.id', 'kategori','deskripsi')
            ->get(); // Add this line to execute the query and retrieve the data
    }
    
    public static function katShowAll(){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                // ->select('kategori.id','kategori',DB::raw('ketKategorik(deskripsi) as ketKategorik'),
                //          'barang.merk');
                ->select('kategori.id','kategori');                
                // ->pagination(1);
                // ->get();

    }

    public static function showKategoriById($id){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                // ->select('barang.id','kategori.kategori',DB::raw('ketKategorik(deskripsi.kategori) as ketKategorik'),
                //          'barang.merk','barang.seri','barang.spesifikasi','barang.stok')
                ->select('barang.id','kategori.kategori')
                ->get();

    }
}