<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateMusicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) return true;
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'musicId' => [
                'required',
                Rule::exists('music', 'id'),
            ],
            'playlist' => [
                'required',
                Rule::prohibitedIf(function () {
                    $playlist = Playlist::query()
                        ->where('user_id', '=', Auth::id())
                        ->where('name', '=', $this->request->all()['playlist'])
                        ->get();
                    if ($playlist->isEmpty()) return true;
                    else return false;
                }),
            ]
        ];
    }

    public function messages()
    {
        return [
            'musicId' => 'Select valid music...',
            'playlistId' => 'Select valid Playlist...',
        ];
    }
}
