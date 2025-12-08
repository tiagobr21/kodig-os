<?php
namespace app\auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class JwtHelper extends Component
{
    
    protected static function getSecret(): string
    {
        $secret = Yii::$app->params['jwtSecret'] ?? getenv('JWT_SECRET');
        if (!$secret) {
            throw new InvalidConfigException('JWT secret not configured (params[jwtSecret] or JWT_SECRET).');
        }
        return $secret;
    }
    
    /* Gera o Token para Autenticação*/
    public static function generateToken(int $userId, ?int $ttl = null): string
    {
        $secret = self::getSecret();
        $now = time();
        $expire = $now + ($ttl ?? (Yii::$app->params['jwtExpire'] ?? 3600));

        $payload = [
            'iss' => Yii::$app->request->hostInfo,
            'aud' => Yii::$app->request->hostInfo, 
            'iat' => $now,
            'nbf' => $now,
            'exp' => $expire,
            'sub' => $userId, 
        ];

        return JWT::encode($payload, $secret, 'HS256');
    }

    /* Retorna payload decodificado se válido, ou lança exceção.*/
    public static function validateToken(string $token)
    {
        $secret = self::getSecret();
        return JWT::decode($token, new Key($secret, 'HS256'));
    }
}
