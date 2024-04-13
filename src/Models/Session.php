<?php
    namespace Bearlovescode\Bluesky\Models;

    use Bearlovescode\Datamodels\Auth\AccessToken;
    use Bearlovescode\Datamodels\Auth\RefreshToken;
    use Bearlovescode\Datamodels\Dto\Dto;
    use Carbon\Carbon;

    class Session extends Dto
    {
        public ?AccessToken $accessToken;
        public ?RefreshToken $refreshToken;
        public string $did;
        public string $handle;
        public Carbon $createdAt;

        public function __construct(mixed $data = null)
        {
            parent::__construct($data);

            $this->createdAt = Carbon::now();
        }
    }