<?php

namespace App\Http\Resources;

use App\Traits\DefaultCoverTrait;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    use DefaultCoverTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'azmoon_title' => $this->azmoon_title,
            'soal_cover' => asset($this->checkDefaultImage($this->soal->soal_cover,'azmoon_cover')),
            'azmoon_type' => 453,
            'azmoon_start' => convertNumbers(Verta::instance($this->azmoon_start)->format('H:i Y/m/d')),
        ];
      //  return parent::toArray($request);
    }
}
