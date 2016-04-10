# xREL Provider for OAuth 2.0 Client
[![Latest Version](https://img.shields.io/github/release/xrelease/oauth2-xrel.svg?style=flat-square)](https://github.com/xrelease/oauth2-xrel/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/xrelease/oauth2-xrel/master.svg?style=flat-square)](https://travis-ci.org/xrelease/oauth2-xrel)
[![HHVM Status](https://img.shields.io/hhvm/xrelease/oauth2-xrel.svg?style=flat-square)](http://hhvm.h4cc.de/package/xrelease/oauth2-xrel)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/xrelease/oauth2-xrel.svg?style=flat-square)](https://scrutinizer-ci.com/g/xrelease/oauth2-xrel/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/xrelease/oauth2-xrel.svg?style=flat-square)](https://scrutinizer-ci.com/g/xrelease/oauth2-xrel)
[![Dependency Status](https://img.shields.io/versioneye/d/php/xrelease:oauth2-xrel/1.0.0.svg?style=flat-square)](https://www.versioneye.com/php/xrelease:oauth2-xrel/1.0.0)
[![Total Downloads](https://img.shields.io/packagist/dt/xrelease/oauth2-xrel.svg?style=flat-square)](https://packagist.org/packages/xrelease/oauth2-xrel)
This package provides xREL OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require xrelease/oauth2-xrel
```

## Usage

Usage is the same as The League's OAuth client, using `\xREL\OAuth2\Client\Provider\xREL` as the provider.

### Authorization Code Flow

```php
<?php
$provider = new \xREL\OAuth2\Client\Provider\xREL([
    'clientId'          => '{xrel-client-id}',
    'clientSecret'      => '{xrel-client-secret}',
    'redirectUri'       => 'https://example.com/callback-url',
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        printf('Hello %s!', $user->getName());

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/xrelease/oauth2-xrel/blob/master/CONTRIBUTING.md) for details.


## Credits

- [xREL](https://github.com/xrelease)
- [All Contributors](https://github.com/xrelease/oauth2-xrel/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/xrelease/oauth2-xrel/blob/master/LICENSE) for more information.
