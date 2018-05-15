<?php 

/**
 * Anonymous Grant ServiceProvider.
 *
 * @author      Andreas Pfurtscheller <hello@aplr.me>
 * @copyright   Copyright (c) Andreas Pfurtscheller
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/andreas.pfurtscheller
 */

namespace Aplr\LaravelPassportAnonymous;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Bridge\RefreshTokenRepository;

use Aplr\LaravelPassportAnonymous\AnonymousGrant;
use Aplr\LaravelPassportAnonymous\AnonymousUserRepository;

class ServiceProvider extends LaravelServiceProvider {
        
    public function boot()
    {
        $this->app->resolving(AuthorizationServer::class, function ($server, $app) {
            $server->enableGrantType(
                $this->makeAnonymousGrant(), Passport::tokensExpireIn()
            );
        });
    }
    
    protected function makeAnonymousGrant()
    {
        $grant = new AnonymousGrant(
            $this->app->make(AnonymousUserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );
        
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
        
        return $grant;
    }
    
}