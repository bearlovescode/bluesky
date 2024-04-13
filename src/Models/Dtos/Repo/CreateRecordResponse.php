<?php
    namespace Bearlovescode\Bluesky\Models\Dtos\Repo;

    use Bearlovescode\Bluesky\Models\IResponseData;
    use Bearlovescode\Datamodels\Dto\Dto;

    class CreateRecordResponse extends Dto implements IResponseData
    {
        public string $uri;
        public string $cid;
    }