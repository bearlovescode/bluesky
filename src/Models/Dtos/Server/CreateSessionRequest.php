<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Server;

    use Bearlovescode\Bluesky\Models\IRequestData;
    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateSessionRequest extends Dto implements IRequestData
    {
        public string $identifier;
        public string $password;
        public \DateTime $createdAt;
    }