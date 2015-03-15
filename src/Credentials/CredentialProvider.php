<?php
namespace Vws\Credentials;

use Vws\Exception\CredentialsException;
use Vws\Exception\UnresolvedCredentialsException;
use Vws\Utils;

/**
 * Credential providers are functions that create credentials and can be
 * composed to create credentials using conditional logic that can create
 * different credentials in different environments.
 *
 * A credential provider is a function that accepts no arguments and returns
 * {@see CredentialsInterface} object on success or NULL if no credentials can
 * be created. Note: exceptions MAY be thrown in credential providers if
 * necessary though this should only be the result of an error (e.g., malformed
 * file, bad permissions, etc.) and not the result of missing credentials.
 *
 * You can wrap your calls to a credential provider with the
 * {@see CredentialProvider::resolve} function to ensure that a credentials
 * object is created. If a credentials object is not created, then the
 * resolve() function will throw a {@see Vws\Exception\UnresolvedCredentialsException}.
 *
 *     use Vws\Credentials\CredentialProvider;
 *     $provider = CredentialProvider::defaultProvider();
 *     // Returns a CredentialsInterface or NULL.
 *     $creds = $provider();
 *     // Returns a CredentialsInterface or throws.
 *     $creds = CredentialProvider::resolve($provider);
 */
class CredentialProvider
{
    const ENV_USERNAME = 'VWS_USERNAME';
    const ENV_PASSWORD = 'VWS_PASSWORD';
    const ENV_SUBSCRIPTION_TOKEN = 'VWS_SUBSCRIPTION_TOKEN';
    const ENV_PROFILE = 'VWS_PROFILE';

    /**
     * Invokes a credential provider and ensures that the provider returns a
     * CredentialsInterface object.
     *
     * @param callable $provider Credential provider function
     *
     * @return CredentialsInterface
     * @throws CredentialsException
     */
    public static function resolve(callable $provider)
    {
        $result = $provider();
        if ($result instanceof CredentialsInterface) {
            return $result;
        }

        throw new UnresolvedCredentialsException('Could not load credentials');
    }

    /**
     * Provider that creates credentials from environment variables
     * VWS_USERNAME, VWS_PASSWORD, and VWS_SUBSCRIPTION_TOKEN.
     *
     * @return callable
     */
    public static function env()
    {
        return function () {
            // Use credentials from environment variables, if available
            $username = getenv(self::ENV_USERNAME);
            $password = getenv(self::ENV_PASSWORD);
            $subcriptionToken = getenv(self::ENV_SUBSCRIPTION_TOKEN);

            return $username
                    && $password
                    && $subcriptionToken
                ? new Credentials($username, $password, $subcriptionToken)
                : null;
        };
    }

    /**
     * Credentials provider that creates credentials using an ini file stored
     * in the current user's home directory.
     *
     * @param string|null $profile  Profile to use. If not specified will use
     *                              the "default" profile.
     * @param string|null $filename If provided, uses a custom filename rather
     *                              than looking in the home directory for the
     *
     * @return callable
     */
    public static function ini($profile = null, $filename = null)
    {
        //$filename = $filename ?: (self::getHomeDir() . '/.Vws/credentials');
        $filename = $filename ?: (self::getWorkingDir() . '/.vws/credentials');
        $profile = $profile ?: (getenv(self::ENV_PROFILE) ?: 'default');

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

    /**
     * Create a default credential provider that first checks for environment
     * variables, then checks for the "default" profile in ~/.Vws/credentials,
     * and finally checks for credentials using EC2 instance profile
     * credentials.
     *
     * @param array $config Optional array of instance profile credentials
     *                      provider options.
     * @return callable
     */
    public static function defaultProvider(array $config = [])
    {
        return Utils::orFn(
            self::env(),
            self::ini()
        );
    }

    private static function getWorkingDir()
    {
        if ($homeDir = getcwd()) {
            return $homeDir;
        }
    }

    /**
     * Gets the environment's HOME directory if available.
     *
     * @return null|string
     */
    private static function getHomeDir()
    {
        // On Linux/Unix-like systems, use the HOME environment variable
        if ($homeDir = getenv('HOME')) {
            return $homeDir;
        }

        // Get the HOMEDRIVE and HOMEPATH values for Windows hosts
        $homeDrive = getenv('HOMEDRIVE');
        $homePath = getenv('HOMEPATH');

        return ($homeDrive && $homePath) ? $homeDrive . $homePath : null;
    }
}
