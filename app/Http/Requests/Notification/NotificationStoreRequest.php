<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'to' => [
                'required',
                $this->getCorrectValidationRule(),
            ],
            'message' => ['required', 'string']
        ];
    }

    public function getCorrectValidationRule(): string
    {
        // This is for demonstrative purposes only
        return match(config('services.notification.provider')) {
            'email' => 'email',
            'sms' => 'numeric',
            default => 'email'
        };
    }
}
