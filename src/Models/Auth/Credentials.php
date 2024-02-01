<?php
    namespace Bearlovescode\Bluesky\Models\Auth;

    use Bearlovescode\Datamodels\Auth\RefreshToken;
    use Bearlovescode\Datamodels\Auth\AccessToken;

    class Credentials
    {
        public ?AccessToken $accessToken;
        public ?RefreshToken $refreshToken;

    }