<?php
    namespace Bearlovescode\Bluesky\Services;


    use Bearlovescode\Bluesky\Exceptions\BadQueryDataException;
    use Bearlovescode\Bluesky\Models\RequestData;
    use Bearlovescode\Bluesky\Models\Service\Configuration;
    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Psr7\Uri;
    use GuzzleHttp\Psr7\Utils;
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

        public function setAccessToken(mixed $token)
        {
            $this->config->token = $token;
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



            $req = new Request('POST',
                $this->buildXrpcUrl($nsid),
                $this->buildHeaders(),
                Utils::streamFor(json_encode($data->toArray()))
            );

            return $this->client->send($req);
        }

        private function buildHeaders(): array
        {
            $headers = [
                'User-Agent' => 'bearlovescode Bluesky Client/1.0',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            if (isset($config->accessToken))
                $headers['Authorization'] = sprintf('Bearer: %s', $config->accessToken);

            return $headers;

        }
        private function buildXrpcUrl(string $nsid): Uri
        {
            return new Uri(sprintf('%s/%s', $this->config->baseUri, $nsid));
        }
    }