<?php
    namespace Bearlovescode\Bluesky\Models;

    use Bearlovescode\Datamodels\Auth\AccessToken;
    use Bearlovescode\Datamodels\Auth\RefreshToken;
    use Bearlovescode\Datamodels\Dto\Dto;

    class Session extends Dto
    {
        public ?AccessToken $accessToken;
        public ?RefreshToken $refreshToken;
        public string $did;
        public string $handle;
    }