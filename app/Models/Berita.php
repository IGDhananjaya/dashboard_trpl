<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class Berita extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "berita";
    protected $fillable = ['title', 'slug', 'description', 'kategori_id', 'photo', 'related_images'];

    protected $primaryKey = "berita_id";
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    static function getBerita()
    {
        return DB::table('berita')
            ->select('berita.*', 'kategori.kategori')
            ->join('kategori', 'berita.kategori_id', '=', 'kategori.kategori_id');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function scopeFilter($query, array $filter)
    {
        if (isset($filter['search']) ? $filter['search'] : false) {
            return $query->where('title', 'LIKE', '%' . request('search') . '%')
                ->orwhere('description', 'LIKE', '%' . request('search') . '%');;
        }

        $query->when(($filter['search']) ??  false, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                ->orwhere('description', 'LIKE', '%' . $search . '%');
        });
    }
    protected $casts = [
        'related_images' => 'array'
    ];
    // Misalnya, Anda ingin mengubah 'related_images' ke dalam array ketika mengaksesnya
    // public function getRelatedImagesAttribute($value)
    // {
    //     return json_decode($value, true);
    // }

    // Misalnya, Anda ingin menyimpan 'related_images' sebagai JSON ketika menyimpannya
    // public function setRelatedImagesAttribute($value)
    // {
    //     $this->attributes['related_images'] = json_encode($value);
    // }
}
