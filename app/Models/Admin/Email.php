<?php

namespace App\Models\Admin;

use PHPFramework\Model;

class Email extends Model
{

    protected array $fillable = ['name', 'email', 'message', 'csrf_token'];
    protected array $rules = [
        'name' => ['min' => 1, 'max' => 100],
        'email' => ['email' => true, 'max' => 100],
		'image' => ['file' => true, 'ext' => 'jpg|png'],
    ];
    protected array $labels = [
        'name' => 'Name',
        'email' => 'Email',
        'message' => 'Message',
    ];

	public function saveImage($i = false, $path = false): null|string
    {
        $image = $this->attributes['image'] ? $this->attributes['image'] : null;
        unset($this->attributes['image']);


		if (!empty($image['name']) && $image['error'] === UPLOAD_ERR_OK) {
			return upload_file($image, $i, $path);
		}

		return null;
    }
}