<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Blog create/update request.
 *
 * Authorization is handled by the `auth.admin` middleware on the route group.
 *
 * NOTE: rules() is intentionally empty for now. The legacy endpoint performed
 * NO field validation (it accepted any input and returned a custom JSON payload
 * on the few checks it did make, e.g. image type/size — which now live in
 * ImageUploadService to preserve that exact JSON response shape). Adding strict
 * rules here would change the response behavior the front-end relies on, so
 * validation will be tightened in a separate, explicitly-confirmed pass.
 */
class StoreBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }
}
