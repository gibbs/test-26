<?php

use App\Services\Imgproxy;

it('builds a signed srcset', function () {
    $imgproxy = new Imgproxy(
        'http://imgproxy.test',
        '943b421c9eb07c830af81030552c86009268de4e532ba2ee2eab8247c6da0881',
        '520f986b998545b4785e0defbc4f3c1203f22de2374a3d53cb7a7fe9fea309c5',
    );

    expect($imgproxy->srcset('https://rickandmortyapi.com/api/character/avatar/1.jpeg'))
        ->toContain('http://imgproxy.test/Uu5CejH8GoxhpAJIMZkhHIpwumLSzB_zSJSTWhtLlyo/rs:fill:240:240/aHR0cHM6Ly9yaWNrYW5kbW9ydHlhcGkuY29tL2FwaS9jaGFyYWN0ZXIvYXZhdGFyLzEuanBlZw 240w')
        ->toContain(' 160w, ')
        ->toEndWith(' 300w');
});

it('uses an insecure signature without a key', function () {
    expect((new Imgproxy('http://imgproxy.test', null, null))->url('https://example.test/a.jpeg', 160))
        ->toStartWith('http://imgproxy.test/insecure/rs:fill:160:160/');
});

it('returns an empty srcset without a url', function () {
    expect((new Imgproxy(null, null, null))->srcset('https://example.test/a.jpeg'))->toBe('');
});
