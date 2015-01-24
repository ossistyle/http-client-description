<?php
namespace Vws\Credentials;

use Vws\Exception\CredentialsException;

class Provider
{
    const ENV_USERNAME = 'VWS_USERNAME';
    const ENV_PASSWORD = 'VWS_PASSWORD';
    const ENV_SUBSCRIPTION_TOKEN = 'VWS_SUBSCRIPTION_TOKEN';

    public static function resolve(callable $provider)
    {
        if (!$result = $provider()) {
            throw new CredentialsException('Could not load credentials.');
        }

        return $result;
    }

    public static function chain()
    {
        $providers = func_get_args();
        return function () use ($providers) {
            foreach ($providers as $provider) {
                $result = $provider();
                if ($result instanceof CredentialsInterface) {
                    return $result;
                }
            }
            return null;
        };
    }

    public static function env()
    {
        return function () {
            // Use credentials from environment variables, if available
            $key = getenv(self::ENV_USERNAME);
            $secret = getenv(self::ENV_PASSWORD);
            $token = getenv(self::ENV_SUBSCRIPTION_TOKEN);
            return $key && $secret && $token
                ? new Credentials($key, $secret, $token)
                : null;
        };
    }

    public static function defaultProvider(array $config = [])
    {
        return self::chain(
            self::env()
        );
    }
}
