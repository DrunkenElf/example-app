<?php

namespace App\Models;

use App\Dto\Category\CategoryDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = ['id'];

    protected $casts = [
        'createdDate' => 'datetime',
    ];

    public function toDto()
    {
        return new CategoryDto(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            createdDate: $this->createdDate,
            active: $this->active
        );
    }
}
