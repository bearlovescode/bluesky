<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;

    use Bearlovescode\Bluesky\Helpers\DateFormatHelper;
    use Bearlovescode\Datamodels\Dto\Dto;

    class Post extends Dto
    {
        public string $type = 'app.bsky.feed.post';
        public string $text;
        public string $createdAt;
        public function toArray(): array
        {
            return array_merge(
                parent::toArray(),
                [
                    '$type' => $this->type
                ]
            );
        }
    }