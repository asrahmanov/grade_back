<?php

namespace App\Connectors;
use App\Http\Controllers\v1\Response\ResponseController;
use Illuminate\Validation\ValidationException;
use LdapRecord\Auth\PasswordRequiredException;
use LdapRecord\Auth\UsernameRequiredException;
use LdapRecord\Configuration\ConfigurationException;
use LdapRecord\Connection;
use LdapRecord\Container;
use function PHPUnit\Framework\throwException;

class LdapConnector extends ResponseController
{
    /**
     * @throws ConfigurationException
     * @throws UsernameRequiredException
     * @throws PasswordRequiredException
     */
    public function connect($email, $password)
    {
        $connection = new Connection([
            'hosts' => [''],
            'base_dn' => '',
            'username' => '',
            'password' => '',
        ]);
        Container::addConnection($connection);
        if ($connection->auth()->attempt($email, $password)) {
            $query = $connection->query();
            return $query->where('mail' , $email)->select('title','name','OU','extensionAttribute1','givenName','cn', 'telephoneNumber', 'mail')->get();
        }
        return false;
    }



}
