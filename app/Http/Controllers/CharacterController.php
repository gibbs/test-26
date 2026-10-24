<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Services\RickAndMortyService;
use Inertia\Inertia;
use Inertia\Response;

final class CharacterController extends Controller
{
    public function index(CharacterRequest $request, RickAndMortyService $service): Response
    {
        return Inertia::render('Home', [
            'filters' => $request->validated(),
            'characters' => fn () => $service->characters($request->validated()),
        ]);
    }

    public function show(int $id, RickAndMortyService $service): Response
    {
        $character = $service->character($id) ?? abort(404);

        return Inertia::render('Character', [
            'character' => $character,
            'episodes' => fn () => $service->episodes($character->episodeIds),
        ]);
    }
}
