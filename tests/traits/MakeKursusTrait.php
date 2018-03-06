<?php

use Faker\Factory as Faker;
use App\Models\Kursus;
use App\Repositories\KursusRepository;

trait MakeKursusTrait
{
    /**
     * Create fake instance of Kursus and save it in database
     *
     * @param array $kursusFields
     * @return Kursus
     */
    public function makeKursus($kursusFields = [])
    {
        /** @var KursusRepository $kursusRepo */
        $kursusRepo = App::make(KursusRepository::class);
        $theme = $this->fakeKursusData($kursusFields);
        return $kursusRepo->create($theme);
    }

    /**
     * Get fake instance of Kursus
     *
     * @param array $kursusFields
     * @return Kursus
     */
    public function fakeKursus($kursusFields = [])
    {
        return new Kursus($this->fakeKursusData($kursusFields));
    }

    /**
     * Get fake data of Kursus
     *
     * @param array $postFields
     * @return array
     */
    public function fakeKursusData($kursusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'kategori' => $fake->word,
            'alamat' => $fake->word,
            'longitude' => $fake->word,
            'latitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $kursusFields);
    }
}
