<?php

namespace App\Models\Admin;

use PHPFramework\Model;

class User extends Model
{

    protected string $table = 'users';
    protected array $fillable = ['name', 'email', 'role'];
    protected array $rules = [
        'name' => ['min' => 1, 'max' => 100],
        'email' => ['email' => true, 'max' => 100, 'unique' => 'users:email'],
        'avatar' => ['ext' => 'jpg|png', 'size' => 1_048_576]
    ];
    protected array $labels = [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
    ];

    public function saveUser(): false|string
    {
        if ($this->attributes['avatar']['error'] === 0) {
            $avatar = $this->attributes['avatar'];
        } else {
            $avatar = null;
        }
        unset($this->attributes['avatar']);

        $id = $this->save();

        if ($avatar) {
            if ($file_url = upload_file($avatar)) {
                db()->query("UPDATE users SET `avatar` = ? WHERE id = ?", [$file_url, $id]);
            }
        }
        return $id;
    }

	public function updateUser(): bool
    {
        $image = $this->attributes['image']['name'] ? $this->attributes['image'] : null;
        unset($this->attributes['image']);

        $id = $this->attributes['id'];
        if (false !== $this->update()) {
            if ($image) {
                if ($file_url = upload_file($image)) {
                    db()->query("UPDATE users SET avatar = ? WHERE id = ?", [$file_url, $id]);
                }
            }
            return true;
        }
        return false;
    }
}