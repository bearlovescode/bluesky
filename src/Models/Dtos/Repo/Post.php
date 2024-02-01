<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;

    use Bearlovescode\Datamodels\Dto\Dto;

    class Post extends Dto
    {
        public string $type = 'app.bsky.feed.post';
        public string $text;
        public \DateTime $createdAt;
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