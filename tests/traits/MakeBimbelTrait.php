<?php

use Faker\Factory as Faker;
use App\Models\Bimbel;
use App\Repositories\BimbelRepository;

trait MakeBimbelTrait
{
    /**
     * Create fake instance of Bimbel and save it in database
     *
     * @param array $bimbelFields
     * @return Bimbel
     */
    public function makeBimbel($bimbelFields = [])
    {
        /** @var BimbelRepository $bimbelRepo */
        $bimbelRepo = App::make(BimbelRepository::class);
        $theme = $this->fakeBimbelData($bimbelFields);
        return $bimbelRepo->create($theme);
    }

    /**
     * Get fake instance of Bimbel
     *
     * @param array $bimbelFields
     * @return Bimbel
     */
    public function fakeBimbel($bimbelFields = [])
    {
        return new Bimbel($this->fakeBimbelData($bimbelFields));
    }

    /**
     * Get fake data of Bimbel
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBimbelData($bimbelFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'kategori' => $fake->word,
            'nama' => $fake->word,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bimbelFields);
    }
}
