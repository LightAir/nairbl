<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, Response
};
use Illuminate\Http\Exception\HttpResponseException;
use Tymon\JWTAuth\Exceptions\{
    JWTException, TokenExpiredException, TokenInvalidException
};
use Tymon\JWTAuth\JWTAuth;

/**
 * Class Auth
 *
 * @package App\Http\Controllers
 */
class Auth extends Controller
{

    /**
     * Экземпляр JWTAuth
     *
     * @var JWTAuth
     */
    protected $jwt;

    /**
     * Auth constructor.
     *
     * @param JWTAuth $jwt
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Метод отдаёт Bearer токен в случае успешной авторизации
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        try {
            $this->validate($request, [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
            ]);
        } catch (\Exception $exc) {
            // future use success function
            return response()->json([
                'error' => [
                    'message' => $exc->getMessage(),
                    'status_code' => Response::HTTP_BAD_REQUEST // todo replace
                ]],
                Response::HTTP_BAD_REQUEST,
                $headers = []
            );
        }

        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * Invalidate token
     *
     * @return mixed
     */
    public function logout()
    {
        if ($this->jwt->invalidate()) {
            return response()->json(['ok']);
        }

        response()->json(['token invalidate failed'], 500);
    }
}
