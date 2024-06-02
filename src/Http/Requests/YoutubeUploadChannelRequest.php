<?php

namespace Leknoppix\YoutubeUpload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class YoutubeUploadChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isfavorite = implode(',', [
            YoutubeUploadChannel::IS_FAVORITE_YES,
            YoutubeUploadChannel::IS_FAVORITE_NO,
        ]);

        return [
            'channel_name' => ['required', 'string', 'max:255'],
            'is_favorite' => ['required', 'string', 'in:'.$isfavorite],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'channel_name.required' => 'Le nom de la chaine doit être renseigné.',
            'channel_name.string' => 'Le nom de la chaine doit être une chaîne de caractères.',
            'channel_name.max' => 'Le nom de la chaine doit avoir une longueur maximum de 255 caractères.',
        ];
    }
}
