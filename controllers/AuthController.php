<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use app\models\User;
use app\auth\JwtHelper;
use yii\web\UnauthorizedHttpException;

class AuthController extends Controller
{
    public $enableCsrfValidation = false; // endpoints API: desabilitar CSRF para simples testes (Ajuste em produção)

    public function behaviors()
    {
        return [
            // permitir JSON response
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
     
    /**
     * @SWG\Post(
     *   path="/auth/login",
     *   summary="Login na API",
     *   tags={"Auth"},
     *   @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *       type="object",
     *       @SWG\Property(property="username", type="string"),
     *       @SWG\Property(property="password", type="string")
     *     )
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Token gerado com sucesso"
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="Credenciais inválidas"
     *   )
     * )
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $body = json_decode(Yii::$app->request->rawBody, true);


        $username = $body['username'] ?? null;
        $password = $body['password'] ?? null;

        if (!$username || !$password) {
            throw new BadRequestHttpException('username and password required');
        }

        $user = User::findByUsername($username);
        if (!$user || !$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Invalid credentials');
        }

        $token = JwtHelper::generateToken((int)$user->id);
        $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key(Yii::$app->params['jwtSecret'], 'HS256'));

        return [
            'token' => $token,
            'expires_at' => $decoded->exp ?? null,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ],
        ];
    }

    /**
     * Protação de Rotas
     */
    public function actionMe()
    {
        
        $auth = new \app\auth\JwtAuth();
        $identity = $auth->authenticate(Yii::$app->user, Yii::$app->getRequest(), Yii::$app->getResponse());
        if (!$identity) {
            throw new UnauthorizedHttpException('User not authenticated');
        }

        return [
            'id' => $identity->id,
            'username' => $identity->username,
        ];
    }
}
