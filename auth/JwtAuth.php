<?php
namespace app\auth;

use Yii;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;
use yii\web\IdentityInterface;
use app\models\User;

class JwtAuth extends AuthMethod
{
    /**
    * Tenta autenticar o usuário usando o cabeçalho Authorization: Bearer <token>.
     * Retorna a identidade ou nulo.
     * Proteção de Rota
     */
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader === null) {
            return null;
        }

        if (preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            return null;
        }

        try {
            $payload = JwtHelper::validateToken($token);
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('Invalid or expired token: ' . $e->getMessage());
        }

        $userId = $payload->sub ?? null;
        if (!$userId) {
            throw new UnauthorizedHttpException('Token malformed: no subject claim');
        }

        $identity = User::findOne((int)$userId);
        if ($identity instanceof IdentityInterface) {
            // Set the Yii user identity
            $user->login($identity, 0);
            return $identity;
        }

        return null;
    }

    public function challenge($response)
    {
        $response->getHeaders()->set('WWW-Authenticate', 'Bearer realm="api"');
    }
}
