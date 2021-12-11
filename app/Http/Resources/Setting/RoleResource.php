<?php

namespace App\Http\Resources\Setting;

use App\Models\RoleModel;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Role $role */
        $role=$this;
        return [
            'id'=>$role->id,
            'name'=>$role->name,
            'guard_name'=>$role->guard_name,
            'created_at' => $role->created_at->toISOString(),
            'updated_at' => $role->updated_at->toISOString()
        ];
    }
}

