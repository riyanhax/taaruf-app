<?php

use Faker\Factory as Faker;
use App\Slider;
use App\Repositories\SliderRepository;

trait MakeSliderTrait
{
    /**
     * Create fake instance of Slider and save it in database
     *
     * @param array $sliderFields
     * @return Slider
     */
    public function makeSlider($sliderFields = [])
    {
        /** @var SliderRepository $sliderRepo */
        $sliderRepo = App::make(SliderRepository::class);
        $theme = $this->fakeSliderData($sliderFields);
        return $sliderRepo->create($theme);
    }

    /**
     * Get fake instance of Slider
     *
     * @param array $sliderFields
     * @return Slider
     */
    public function fakeSlider($sliderFields = [])
    {
        return new Slider($this->fakeSliderData($sliderFields));
    }

    /**
     * Get fake data of Slider
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSliderData($sliderFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'image' => $fake->text,
            'description' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $sliderFields);
    }
}
