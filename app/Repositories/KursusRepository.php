<?php

namespace App\Repositories;

use App\Models\Kursus;
use InfyOm\Generator\Common\BaseRepository;

class KursusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'kategori',
        'alamat',
        'longitude',
        'latitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Kursus::class;
    }
}
