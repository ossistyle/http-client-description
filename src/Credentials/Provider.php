<?php
namespace Vws\Credentials;

use Vws\Exception\CredentialsException;

class Provider
{
    const ENV_USERNAME = 'VWS_USERNAME';
    const ENV_PASSWORD = 'VWS_PASSWORD';
    const ENV_SUBSCRIPTION_TOKEN = 'VWS_SUBSCRIPTION_TOKEN';
    const ENV_PROFILE = 'VWS_PROFILE';

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

    public static function ini($profile = null, $filename = null)
    {
        $filename = $filename ?: (self::getWorkingDir() . '/.vws/credentials');
        $profile = $profile ?: ('default');

        return function () use ($profile, $filename) {
            if (!file_exists($filename)) {
                return null;
            }
            if (!is_readable($filename)) {
                throw new CredentialsException("Cannot read credentials from $filename");
            }
            if (!($data = parse_ini_file($filename, true))) {
                throw new CredentialsException("Invalid credentials file: {$filename}");
            }
            if (!isset($data[$profile]['vws_username'])
                || !isset($data[$profile]['vws_password'])
                || !isset($data[$profile]['vws_subscription_token'])
            ) {
                return null;
            }
            return new Credentials(
                $data[$profile]['vws_username'],
                $data[$profile]['vws_password'],
                $data[$profile]['vws_subscription_token']
            );
        };
    }

    private static function getWorkingDir()
    {
        if ($homeDir = getcwd()) {
            return $homeDir;
        }
    }

    public static function defaultProvider(array $config = [])
    {
        return self::chain(
            self::env(),
            self::ini()
        );
    }
}
