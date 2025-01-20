<?php

namespace PHPFramework;

class Auth
{

    public static function login(array $credentials): bool
    {
        $password = $credentials['password'];
        unset($credentials['password']);
        $field = array_key_first($credentials);
        $value = $credentials[$field];

        $user = db()->findOne('users', $value, $field);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            session()->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'image' => $user['avatar'],
            ]);
            return true;
        }
        return false;
    }

    public static function user()
    {
        return session()->get('user');
    }

    public static function isAuth(): bool
    {
        return session()->has('user');
    }

    public static function logout(): void
    {
        session()->forget('user');
    }

    public static function setUser(): void
    {
        if ($user_data = self::user()) {
            $user = db()->findOne('users', $user_data['id']);
            if ($user) {
                session()->set('user', [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'image' => $user['avatar'],
                ]);
            }
        }
    }

}