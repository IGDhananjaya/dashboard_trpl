<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class kategori extends Model
// {
//     use HasFactory;

//     protected $table = "kategori";
//     protected $fillable = ['kategori'];

//     protected $primaryKey = "kategori_id";


//     public function berita(){
//         return $this->hasMany(Berita::class,'kategori_id','kategori_id');
//     }
//     public function scopeFilter($query, array $filter)
//     {
//         return $query->when(isset($filter['search']), function ($query) use ($filter) {
//             return $query->where('kategori', 'LIKE', '%' . $filter['search'] . '%')
//                 ->orWhere('kategori_id', 'LIKE', '%' . $filter['search'] . '%');
//         });
//     }
// }

// ----

class kategori extends Model
{
    use HasFactory;

    protected $table = "kategori";
    protected $fillable = ['kategori'];

    protected $primaryKey = "kategori_id";

    public function berita()
    {
        return $this->hasMany(Berita::class, 'kategori_id', 'kategori_id');
    }

    public function scopeFilter($query, array $filter)
    {
        return $query->when(isset($filter['search']), function ($query) use ($filter) {
            return $query->where('kategori', 'LIKE', '%' . $filter['search'] . '%')
                ->orWhere('kategori_id', 'LIKE', '%' . $filter['search'] . '%');
        });
    }
}
