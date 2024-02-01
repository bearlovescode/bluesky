<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;


    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateRecordRequest extends Dto
    {
        public string $repo;
        public string $collection = 'app.bsky.feed.post';
        public Post $record;
    }