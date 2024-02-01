<?php
    namespace Bearlovescode\Bluesky\Models\Service;


    use Bearlovescode\Bluesky\Models\Session;
    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Psr7\Uri;

    class Configuration extends Dto
    {
            public readonly Uri $baseUri;
            public Session $session;

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