<?php

namespace App\Http\Requests\PostRequests;

class PostEditRequest
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
    public function rules($request)
    {
        if (empty($request->title) || empty($request->title_link) || empty($request->content_post)) {
            return ['status' => 1, 'message' => 'Edit Post thất bại, các trường không được để trống !!!'];
        }
    }
}
