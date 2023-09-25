<?php

namespace App\Dto\Category;

class UpdateCategoryDto
{
    public function __construct(
        public int $id,
        public string|null $name,
        public string|null $description,
        public bool|null   $active,
    )
    {
    }

    public function toArray()
    {
        $arr = [];
        if (!is_null($this->name)) {
            $arr['name'] = $this->name;
        }
        if (!is_null($this->description)) {
            $arr['description'] = $this->description;
        }
        if (!is_null($this->active)) {
            $arr['active'] = $this->active;
        }

        return $arr;
    }
}
