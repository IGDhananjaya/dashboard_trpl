<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     // return parent::toArray($request);
        
    //     $related_images = array_map(function ($image) {
    //         return url('uploads' . $image);
    //     }, $this->related_images ?? []);

    //     return [
    //         'berita_id' => $this->berita_id,
    //         'title' => $this->title,
    //         'slug' => $this->slug,
    //         'description' => $this->description,
    //         'kategori_id' => $this->kategori_id,
    //         'photo' => url('uploads' . $this->photo), // Mengarahkan ke direktori yang ditentukan
    //         'related_images' => $related_images, // Mengarahkan setiap gambar terkait ke direktori yang ditentukan
    //         // 'kategori' => $this->kategori->kategori,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    
    // }

    // -----

    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->berita_id,
    //         'title' => $this->title,
    //         'slug' => $this->slug,
    //         'description' => $this->description,
    //         'kategori_id' => $this->kategori->kategori,
    //         'photo' => $this->photo,
    //         // 'related_images' => $this->related_images,
    //         'related_images' => json_decode($this->related_images, true),
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //         // Tambahkan kolom lainnya sesuai kebutuhan Anda
    //     ];
    // }

    // ----

    // public function toArray($request)
    // {
    //     // Decode related_images to check if it's an array
    //     $decodedRelatedImages = json_decode($this->related_images, true);

    //     // Validate if decoded related_images is an array
    //     if (!is_array($decodedRelatedImages)) {
    //         // Jika bukan array, kirimkan respons error
    //         return [
    //             'error' => 'The related images must be an array.'
    //         ];
    //     }

    //     // Jika validasi berhasil, kembalikan data seperti biasa
    //     return [
    //         'id' => $this->berita_id,
    //         'title' => $this->title,
    //         'slug' => $this->slug,
    //         'description' => $this->description,
    //         'kategori_id' => $this->kategori->kategori,
    //         'photo' => $this->photo,
    //         'related_images' => $decodedRelatedImages,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //         // Tambahkan kolom lainnya sesuai kebutuhan Anda
    //     ];
    // }

    // ----

    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->id,                // ID berita
    //         'title' => $this->title,          // Judul berita
    //         'slug' => $this->slug,            // Slug berita
    //         'description' => $this->description, // Deskripsi berita
    //         'kategori_id' => $this->kategori_id, // ID kategori berita
    //         'photo' => $this->photo,           // Path foto utama
    //         'related_images' => $this->getRelatedImagePaths(), // Path gambar terkait
    //         'created_at' => $this->created_at->toDateTimeString(), // Tanggal dibuat berita
    //         'updated_at' => $this->updated_at->toDateTimeString(), // Tanggal diperbarui berita
    //     ];
    // }

    // /**
    //  * Mendapatkan path gambar terkait dalam bentuk array.
    //  *
    //  * @return array
    //  */
    // protected function getRelatedImagePaths()
    // {
    //     // Anda bisa menyesuaikan dengan cara Anda menyimpan path gambar terkait.
    //     // Contoh: Jika Anda menyimpannya dalam format JSON, Anda bisa menggunakan json_decode.
    //     // $relatedImagePaths = json_decode($this->related_image_paths, true);

    //     // Untuk contoh sederhana, saya asumsikan Anda menyimpannya dalam bentuk string path.
    //     // Ubah sesuai dengan kebutuhan Anda.
    //     return $this->related_image_paths; 
    // }

    // -----

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'kategori_id' => $this->kategori_id,
            'photo' => asset('storage/' . $this->photo),  // Path untuk photo
            'related_images' => $this->relatedImagesArray(),  // Mengonversi ke array
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Custom method to convert related_images JSON string to array.
     *
     * @return array
     */
    protected function relatedImagesArray()
    {
        return json_decode($this->related_images, true) ?? [];  // Mengonversi JSON ke array atau kembalikan array kosong jika null
    }

}
