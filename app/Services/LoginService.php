<?php

namespace App\Services;

class LoginService
{

    public static function getUser(array $data): ?array
    {
        extract($data);
        $db = new DatabaseService;
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if (!$user) {
            return null;
        }
        return $user;
    }

    public static function authenticate(array $user, $password): bool
    {
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        return true;
    }
}
