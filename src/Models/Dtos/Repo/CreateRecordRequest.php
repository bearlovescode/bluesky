<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;


    use Bearlovescode\Bluesky\Models\IRequestData;
    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateRecordRequest extends Dto implements IRequestData
    {
        public string $repo;
        public string $collection = 'app.bsky.feed.post';
        public Post $record;
    }