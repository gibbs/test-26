<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CharacterRequest extends FormRequest
{
    /** @var array<int, string> */
    private const STATUS = ['alive', 'dead', 'unknown'];

    /** @var array<int, string> */
    private const GENDER = ['female', 'male', 'genderless', 'unknown'];

    /** @return array<string, array<int, mixed>> */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(self::STATUS)],
            'gender' => ['nullable', Rule::in(self::GENDER)],
            'type' => ['nullable', 'string', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ];
    }
}
