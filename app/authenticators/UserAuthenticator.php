<?php

namespace App;
use Nette;
use Nette\Security as NS;

class UserAuthenticator implements NS\IAuthenticator
{
    public $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->database->table('users')->where('username', $username)->select("*")->fetch();
        if (!$row) {
            throw new NS\AuthenticationException('Uživatel nenalezen');
        }

        if (!NS\Passwords::verify($password, $row->password)) {
            throw new NS\AuthenticationException('Neplatné heslo.');
        }

        return new NS\Identity($row->id, $row->role, ['username' => $row->username]);
    }
}