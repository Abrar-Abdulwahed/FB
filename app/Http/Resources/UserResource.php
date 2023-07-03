<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=> $this->name,
            'email'=> $this->email,
            'roles'=> $this->roles->map(function ($role) {
                return [
                    'name' => $role->name,
                ];
            }),
            'status'=> $this->is_banned,
            'created_at'=> $this->created_at->diffForHumans(),
        ];
    }
}
