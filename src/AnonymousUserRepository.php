<?php 

/**
 * Anonymous Grant User Repository
 *
 * @author      Andreas Pfurtscheller <hello@aplr.me>
 * @copyright   Copyright (c) Andreas Pfurtscheller
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/andreas.pfurtscheller
 */

namespace Aplr\LaravelPassportAnonymous;

use RuntimeException;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

use Laravel\Passport\Bridge\User;

class AnonymousUserRepository implements UserRepositoryInterface {
    
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $provider = config('auth.guards.api.provider');
        
        if (is_null($model = config("auth.providers.{$provider}.model"))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }
        
        if (method_exists($model, 'findByAuthId')) {
            $user = (new $model)->findByAuthId($username);
        } else {
            $user = (new $model)->where('auth_id', $username)->first();
        }
        
        if (is_null($user)) {
            return;
        }

        if (method_exists($model, 'isAnonymousAllowed') && !$user->isAnonymousAllowed()) {
            return;
        }
        
        return new User($user->getAuthIdentifier());
    }
    
}