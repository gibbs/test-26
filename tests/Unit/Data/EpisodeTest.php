<?php

use App\Data\Episode;

it('maps an episode', function () {
    expect(Episode::fromArray(jsonFixture('episodes')[0]))->toEqual(new Episode(
        id: 1,
        name: 'Pilot',
        airDate: 'December 2, 2013',
        episode: 'S01E01',
    ));
});
