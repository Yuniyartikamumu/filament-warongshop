<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\RajaongkirSetting;
use Filament\Notifications\Notification;


class RajaongkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $setting;

    public function __construct()
    {
        $this->setting = RajaongkirSetting::getActive();

        if (!$this->setting || !$this->setting->is_valid) {
            Notification::make()
                ->title('Rajaongkir API is not valid')
                ->body('Please configure valid Rajaongkir settings before creating a store')
                ->danger()
                ->send();
            return;
        }

        $this->apiKey = $this->setting->api_key;
        $this->baseUrl = $this->setting->base_url;
    }
     public function getProvinces()
    {

        if (!$this->setting || !$this->setting->is_valid) {
            return collect();
        }

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl.'/province');



        if ($response->successful()) {
            return collect($response->json('rajaongkir.results'))->pluck('province', 'province_id');
        }
    }
     public function getCities($provinceId)
    {
         $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl.'/city', [
            'province' => $provinceId
        ]);

        if ($response->successful()) {
            return collect($response->json('rajaongkir.results'))
                ->mapWithKeys(function ($item) {
                    $displayName = "{$item['type']} {$item['city_name']}";
                    return [$item['city_id'] => $displayName];
                });
        }
    }

}
