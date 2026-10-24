<?php

use App\Data\Character;

it('maps a character dto', function () {
    expect(Character::fromArray(jsonFixture('character')))->toEqual(new Character(
        id: 1,
        name: 'Rick Sanchez',
        status: 'Alive',
        species: 'Human',
        type: '',
        gender: 'Male',
        image: 'https://rickandmortyapi.com/api/character/avatar/1.jpeg',
        origin: 'Earth (C-137)',
        location: 'Citadel of Ricks',
        episodes: [
            'https://rickandmortyapi.com/api/episode/1',
            'https://rickandmortyapi.com/api/episode/2',
        ],
        episodeIds: [1, 2],
    ));
});
