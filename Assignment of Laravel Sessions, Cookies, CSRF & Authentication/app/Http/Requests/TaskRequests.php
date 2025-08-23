<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }


    public function rules(): array
    {
        return [
        'title' => ['required','string','min:3'],
        'description' => ['nullable','string','max:255'],
        'status' => ['required','in:Pending,Completed'],
        ];
    }
}
