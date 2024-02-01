<?php
    namespace Bearlovescode\Bluesky\Models\Service;


    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Psr7\Uri;

    class Configuration extends Dto
    {
            public readonly Uri $baseUri;

            public function __construct(mixed $data = null)
            {
                if (isset($data['baseUri']))
                {
                    $this->baseUri = new Uri($data['baseUri']);
                    unset($data['baseUri']);
                }

                parent::__construct($data);
            }


    }