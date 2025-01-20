<?php

namespace App\Models;

use PHPFramework\Model;

class User extends Model
{

    protected string $table = 'users';
    protected array $fillable = ['name', 'email', 'password', 'repassword', 'ressetPassword', 'csrf_token', 'csrf_token_name'];
    protected array $rules = [
        'name' => ['min' => 1, 'max' => 100],
        'email' => ['email' => true, 'max' => 100, 'unique' => 'users:email'],
        'password' => ['min' => 6],
        'repassword' => ['match' => 'password'],
        'avatar' => ['ext' => 'jpg|png|jpeg', 'size' => 1_048_576]
    ];
    protected array $labels = [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'repassword' => 'Confirm Password',
    ];

    public function saveUser(): false|string
    {
        if ($this->attributes['avatar']['error'] === 0) {
            $avatar = $this->attributes['avatar'];
        } else {
            $avatar = null;
        }
        unset($this->attributes['avatar']);
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
        unset($this->attributes['repassword']);
		unset($this->attributes['ressetPassword']);
		unset($this->attributes['csrf_token']);
		unset($this->attributes['csrf_token_name']);
		
        $id = $this->save();
        if ($avatar) {
            if ($file_url = upload_file($avatar)) {
                db()->query("UPDATE users SET `avatar` = ? WHERE id = ?", [$file_url, $id]);
            }
        }
        return $id;
    }

    public function auth(): bool
    {
        if (!$user = db()->query("SELECT * FROM {$this->table} WHERE email = ?", [$this->attributes['email']])->getOne()) {
            return false;
        }
        if (!password_verify($this->attributes['password'], $user['password'])) {
            return false;
        }
        session()->set('user', $user);
        return true;
    }

}