<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    public $primaryKey='mk_id';
    protected $table="matakuliah";
    protected $fillable = [
        'mk_kode', 'mk_nama', 'semester', 'sks', 'type'
    ];
    public function scopeFilter($query, array $filter)
    {
        return $query->when(isset($filter['search']), function ($query) use ($filter) {
            return $query->where('mk_nama', 'LIKE', '%' . $filter['search'] . '%')
                ->orWhere('semester', 'LIKE', '%' . $filter['search'] . '%');
        });
    }
}
