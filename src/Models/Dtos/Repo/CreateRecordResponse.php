<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;

    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateRecordResponse extends Dto
    {
        public string $uri;
        public string $cid;
    }