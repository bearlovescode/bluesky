<?php
    namespace Bearlovescode\Bluesky\Services;


    use Bearlovescode\Bluesky\Exceptions\BadQueryDataException;
    use Bearlovescode\Bluesky\Models\Service\Configuration;
    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Client;

    abstract class Service
    {
        protected Client $client;


        public function __construct(
            protected Configuration $config
        )
        {
            $this->client = new Client([
                'base_uri' => $config->baseUri
            ]);
        }



        public function query(string $nsid = '', Dto $data = null)
        {
            if (!$nsid || !$data)
                throw new BadQueryDataException();

            $res = $this->client->get($nsid, [
                'query' => $data->toArray()
            ]);
        }

        public function handle(string $nsid = '', Dto $data)
        {

    }
    }