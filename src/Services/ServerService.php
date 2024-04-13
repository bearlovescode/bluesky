<?php
    namespace Bearlovescode\Bluesky\Services;

    use Bearlovescode\Bluesky\Exceptions\ApiResponseException;
    use Bearlovescode\Bluesky\Models\Dtos\Server\CreateSessionRequest;
    use Bearlovescode\Bluesky\Models\Dtos\Server\RefreshSessionRequest;
    use Bearlovescode\Bluesky\Models\Session;
    use Bearlovescode\Datamodels\Auth\AccessToken;
    use Bearlovescode\Datamodels\Auth\RefreshToken;

    class ServerService extends Service
    {
        public function createSession(
            string $identifier,
            string $appPassword
        ) : Session
        {
            $nsid = 'com.atproto.server.createSession';

            $req = new CreateSessionRequest([
                'identifier' => $identifier,
                'password' => $appPassword
            ]);

            $res = $this->handle($nsid, $req);

            if ($res->getStatusCode() !== 200)
                throw new ApiResponseException($res->getReasonPhrase(), $res->getStatusCode());

            $data = json_decode($res->getBody()->getContents());

            return new Session([
                'accessToken' => new AccessToken($data->accessJwt),
                'refreshToken' => new RefreshToken($data->refreshJwt),
                'did' => $data->did,
                'handle' => $data->handle ?? null,
            ]);

        }

        public function refreshSession(): Session
        {
            $nsid = 'com.atproto.server.refreshSession';

            $req = new RefreshSessionRequest();
            $res = $this->handle($nsid, $req);
            $data = json_decode($res->getBody()->getContents());
            return new Session([
                'accessToken' => new AccessToken($data->accessJwt),
                'refreshToken' => new RefreshToken($data->refreshJwt),
                'did' => $data->did,
                'handle' => $data->handle ?? null,
            ]);
        }
    }