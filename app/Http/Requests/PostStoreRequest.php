<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $now = now();
        return [
            'title' => 'required',
            'content' => 'required',
            'status' => ['nullable', new EnumValue(PostStatus::class)],
            // 'status' => 'nullable|in:planned,draft,published',
            'published_at' => "nullable|date|required_if:status,==,planned|after_or_equal:{$now}",
            'slug' => 'nullable|unique:posts,slug'
        ];
    }
}
