<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\CP\BaseController as  Controller;
use App\Http\Requests\CP\Game\SaveGameRequest;
use App\Models\Game;
use App\Services\Parsers\FetchSteamService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::paginate(25);
        return $this->sendPreparedResponse('cp.games.index', compact('games'));
    }

    public function form(?Game $game)
    {
        return !$game->exists
            ? $this->sendPreparedResponse('cp.games.create')
            : $this->sendPreparedResponse('cp.games.edit', compact('game'));
    }

    public function save(SaveGameRequest $request)
    {
        $game = $request->id
            ? Game::findOrFail($request->id)
            : new Game();
        $this->fillBaseFields($game, $request->validated());
        $game->image = $this->uploadImage($request->file('image'), $game) ?: $game->image;
        $game->image_og = $this->uploadImage($request->file('image_og'), $game) ?: $game->image_og;

        $this->handleTranslation($game, 'ru', $request->ru);
        $this->handleTranslation($game, 'en', $request->en);
        $game->save();
        \Log::debug(__METHOD__, [$game]);
        return $request->expectsJson()
            ? response(['success' => 'ok', 'Game' => $game], 200)
            : redirect()->route('cp.games.form', ['Game' => $game->id])->with('success', 'Успешно');
    }

    public function fetchSteam(Request $request)
    {
        $steamService = new FetchSteamService();
        $steamService->handle($request->link);
        if ($msg = $steamService->error) {
            return response(['link' => $msg], 400);
        }
        return $steamService->data;
    }

    private function fillBaseFields(&$game, array $data)
    {
        $baseFields = ['name', 'slug', 'developers', 'publishers', 'keywords', 'discount', 'steam_app_id', 'released_at'];
        foreach ($baseFields as $property) {
            if (isset($data[$property])) {
                $game->$property = $data[$property];
            }
        }
    }
}
