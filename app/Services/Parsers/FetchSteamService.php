<?php


namespace App\Services\Parsers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FetchSteamService
{
    const BASE_URL = 'https://store.steampowered.com/api/appdetails/';

    public $link;
    public $appId = false;
    public bool|string $error = false;

    public bool|array $ruData = false;
    public bool|array $enData = false;
    public $data;


    public function handle($link): FetchSteamService
    {
        $this->setAppId($link);

        if (!$this->error) $this->sendRequest();
        if (!$this->error) $this->setGeneralData();
        return $this;
    }

    public function sendRequest() : void
    {

        $this->ruData = $this->fetch('russian');
        $this->enData = $this->fetch('english');
    }

    public function getDiscountPercent(): ?float
    {
        if (is_array($this->ruData) && !empty($this->ruData['price_overview']['discount_percent'])) {
            return $this->ruData['price_overview']['discount_percent'];
        }

        return null;
    }

    public function getRecommendationsCount(): ?int
    {
        if (!$this->isComingSoon() && !empty($this->ruData['recommendations']['total'])) {
            return $this->ruData['recommendations']['total'];
        }

        return 0;
    }

    public function isComingSoon(): bool
    {
        if (is_array($this->ruData) && isset($this->ruData['release_date']['coming_soon'])) {
            return $this->ruData['release_date']['coming_soon'];
        }
        return false;
    }

    public function fetch($lang = 'russian', $region = 'EU'): false|array
    {
        $data = false;
        try {
            $response = Http::get(self::BASE_URL,[
                'appids' => $this->appId,
                'cc' => $region,
                'l' => $lang,
                'currency' => 'USD',
                'v' => 1,
                'json' => 1
            ]);

            if (!empty($response->json()[$this->appId]) && $response->json()[$this->appId]['success']) {

                $data = $response->json()[$this->appId]['data'];

            } else {
                $this->error = $this->appId. ' - сервер STEAM ответил не успешно для данной игры (возможно нет данных в российском магазине)';
                Log::error($this->error);
            }

        } catch (\Throwable $th) {
            $this->error = $this->appId. ' - ОШИБКА ЗАПРОСА К STEAM';
            Log::error($this->error);
            Log::error($th->getLine() . " ".$th->getMessage(), $th->getTrace());
        }

        return $data;
    }

    protected function setGeneralData()
    {
        \Log::debug(__METHOD__, $this->ruData);
        $data = [];
        $arrConstRU = [
            'genres' => implode(', ', array_map(function($n) {
                return $n['description'];
            }, $this->ruData['genres'])),
            'name' => $this->ruData['name'],
            'app' => $this->ruData['steam_appid'],
            'release' => $this->ruData['release_date']['date'],
            'description' => $this->ruData['short_description']
        ];

        $arrConstEN = [
            'genres' => implode(', ', array_map(function($n) {
                return $n['description'];
            }, $this->enData['genres'])),
            'name' => $this->enData['name'],
            'app' => $this->enData['steam_appid'],
            'release' => $this->enData['release_date']['date'],
            'description' => $this->enData['short_description']
        ];

        $data['name'] = $this->enData['name'];
        $data['genres_en'] = $arrConstEN['genres'];
        $data['genres_ru'] = $arrConstRU['genres'];
        $data['released_at'] = $this->getReleaseDateAsTimestamp($arrConstRU['release'] ?? '');
        $data['developers'] = implode(',', $this->enData['developers']);
        $data['publishers'] = implode(',', $this->enData['publishers']);
        $data['steam_app_id'] = $this->ruData['steam_appid'];
        $data['slug'] = Str::slug($this->enData['name']);
        $data['discount'] = $this->getDiscountPercent();

        $this->data = $data;
    }

    private function setAppId($link)
    {
        if (empty($link)) {
            $this->error = 'НЕ ВВЕДЕНА ССЫЛКА НА ИГРУ В STEAM';
            return false;
        }

        if (is_numeric($link)) {
            $this->appId = $link;
        }elseif (!$this->error) {
            preg_match('#\/app\/(\d+)#', $link, $m);

            if (empty($m[1])) {
                $this->error = 'ВВЕДЕНА НЕКОРРЕКТНАЯ ССЫЛКА';
                return false;
            } else
                $this->appId = $m[1];
        }
        return true;
    }

    private function getReleaseDateAsTimestamp($dateString)
    {
        $dateString = "17 Oct, 2018";
        return Carbon::parse($dateString)?->format('Y-m-d');
    }
}
