<?php

namespace App\Http\Requests;

use App\Rules\QuestTitleRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', new QuestTitleRule()],
            'description' => 'required|string',
            'reward' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id', // Assumes a categories table
        ];
    }

    /**
     * Customize the error messages if necessary.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'reward.integer' => 'Reward must be an integer.',
            'category_id.exists' => 'The selected category does not exist.',
        ];
    }
}
