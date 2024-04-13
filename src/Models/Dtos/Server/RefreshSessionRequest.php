<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Server;

    use Bearlovescode\Bluesky\Models\IRequestData;

    class RefreshSessionRequest implements IRequestData
    {
        public function toArray(): array
        {
            return [];
        }
    }