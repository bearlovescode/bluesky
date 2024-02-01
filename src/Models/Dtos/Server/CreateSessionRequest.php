<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Server;

    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateSessionRequest extends Dto
    {
        public string $identifier;
        public string $appPassword;
    }