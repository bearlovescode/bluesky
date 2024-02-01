<?php
    namespace Bearlovescode\Bluesky\Services;


    use Bearlovescode\Bluesky\Exceptions\BadQueryDataException;
    use Bearlovescode\Bluesky\Models\Service\Configuration;
    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Client;
    use Psr\Http\Message\ResponseInterface;

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

            return $this->client->get($nsid, [
                'query' => $data->toArray()
            ]);
        }

        /**
         * @param string $nsid
         * @param Dto $data
         * @return ResponseInterface
         * @throws BadQueryDataException
         * @throws \GuzzleHttp\Exception\GuzzleException
         */
        public function handle(string $nsid = '', Dto $data) : ResponseInterface
        {
            if (!$nsid || !isset($data))
                throw new BadQueryDataException();

            $defaultHeaders = [
                'Accept' => 'application/json'
            ];

            $headers = array_merge($defaultHeaders, []);

            return $this->client->post($nsid, [
                'headers' => $headers,
                'json' => $data->toArray()
            ]);
        }
    }