<?php

declare(strict_types=1);

namespace App\Application\Request;

use App\Application\Request\Dto\RegistrationRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class CreateUserRequest extends FormRequest
{
    private const int USER_NAME_MAX = 30;
    private const int PHONE_NUMBER_MAX = 15;

    public function rules(): array
    {
        return [
            'user_name' => [
                'required',
                'string',
                sprintf('max:%d', self::USER_NAME_MAX),
                'regex:/^[a-zA-Z ]*$/',
            ],
            'phone_number' => [
                'required',
                'string',
                sprintf('max:%d', self::PHONE_NUMBER_MAX),
                'regex:/\d/',
            ],
        ];
    }

    public function messages(): array
    {
        $messages = static fn (string $field, string $key) => match ($key) {
            'required' => sprintf('The %s is required.', str_replace('_', ' ', $field)),
            'string' => sprintf('The %s must be a string.', str_replace('_', ' ', $field)),
            'max' => sprintf(
                'The %s cannot be longer than %d characters.',
                str_replace('_', ' ', $field),
                match ($field) {
                    'user_name' => self::USER_NAME_MAX,
                    'phone_number' => self::PHONE_NUMBER_MAX,
                    default => '',
                },
            ),
            'regex' => sprintf('The %s contains invalid characters.', str_replace('_', ' ', $field)),
            default => '',
        };

        return [
            'user_name.required' => $messages('user_name', 'required'),
            'user_name.string' => $messages('user_name', 'string'),
            'user_name.max' => $messages('user_name', 'max'),
            'user_name.regex' => $messages('user_name', 'regex'),
            'phone_number.required' => $messages('phone_number', 'required'),
            'phone_number.string' => $messages('phone_number', 'string'),
            'phone_number.max' => $messages('phone_number', 'max'),
            'phone_number.regex' => $messages('phone_number', 'regex'),
        ];
    }

    public function toDto(): RegistrationRequestDto
    {
        return new RegistrationRequestDto(...$this->validated());
    }
}
