<?php

namespace App\Http\Controllers;

use Api\Infrastructure\AuthenticationInEloquent;
use Api\UseCase\Authentication\Authenticate;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $authenticate = new Authenticate(new AuthenticationInEloquent());
        return $authenticate->execute($request->username, $request->password);
    }
}
