<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    public $primaryKey='dosen_id';
    protected $table="dosen";
    protected $fillable = [
        'dosen_code', 'name', 'gender', 'skill', 'certified', 'nip', 'photo'
    ];

    public function scopeFilter($query, array $filter)
    {
        return $query->when(isset($filter['search']), function ($query) use ($filter) {
            return $query->where('name', 'LIKE', '%' . $filter['search'] . '%')
                ->orWhere('nip', 'LIKE', '%' . $filter['search'] . '%');
        });
    }

}
