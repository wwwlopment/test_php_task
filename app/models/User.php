<?php

namespace models;
class User
{
    private $users;

    public function __construct()
    {
        $this->users = [
            [
                'id' => 1,
                'name' => 'Alex',
                'email' => 'alex@test.com',
                'password' => 'bcbe3365e6ac95ea2c0343a2395834dd'
            ],
            [
                'id' => 2,
                'name' => 'Anna',
                'email' => 'hanna@ukr.test',
                'password' => '15de21c670ae7c3f6f3f1f37029303c9'
            ],
        ];
    }

    public function addUser(array $userData): void
    {
        $userData['password'] = md5($userData['password']);
        unset($userData['password_confirm']);
        $userData['id'] = $this->getNextId();
        $this->users[] = $userData;
    }

    public function getUserByEmail(string $email): ?array
    {
        foreach ($this->users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }

        return null;
    }

    public function getAllUsers(): array
    {
        return $this->users;
    }

    private function getNextId(): int
    {
        $max_id = max(array_column($this->users, 'id'));
        return $max_id + 1;
    }
}
