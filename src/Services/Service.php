<?php
    namespace Bearlovescode\Bluesky\Services;


    use Bearlovescode\Bluesky\Exceptions\BadQueryDataException;
    use Bearlovescode\Bluesky\Models\Dtos\Server\RefreshSessionRequest;
    use Bearlovescode\Bluesky\Models\IRequestData;
    use Bearlovescode\Bluesky\Models\Service\Configuration;
    use Bearlovescode\Bluesky\Models\Session;
    use Bearlovescode\Datamodels\Dto\Dto;
    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Psr7\Uri;
    use GuzzleHttp\Psr7\Utils;
    use Psr\Http\Message\ResponseInterface;

    abstract class Service
    {
        protected Client $client;
        protected ?Session $session = null;


        public function __construct(
            protected Configuration $config
        )
        {
            $this->client = new Client([
                'base_uri' => $config->baseUri
            ]);
        }

        public function setSession(Session $session): void
        {
            $this->session = $session;
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
        public function handle(string $nsid, IRequestData $data) : ResponseInterface
        {
            if (!$nsid || !isset($data))
                throw new BadQueryDataException();

            $refresh = ($data instanceof RefreshSessionRequest);

            $body = ($refresh) ? null : Utils::streamFor(json_encode($data->toArray()));

            $req = new Request('POST',
                $this->buildXrpcUrl($nsid),
                $this->buildHeaders($refresh),

            );

            return $this->client->send($req);
        }

        private function buildHeaders(bool $refresh = true): array
        {
            $headers = [
                'User-Agent' => 'bearlovescode Bluesky Client/1.0',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];

            $bearerToken = ($refresh) ? $this->session->refreshToken : $this->session->accessToken;

            if (!is_null($this->session))
                $headers['Authorization'] = sprintf('Bearer %s', $bearerToken);

            return $headers;

        }
        private function buildXrpcUrl(string $nsid): Uri
        {
            return new Uri(sprintf('%s/%s', $this->config->baseUri, $nsid));
        }
    }