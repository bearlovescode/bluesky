<?php
    namespace Bearlovescode\Bluesky\Services;

    use Bearlovescode\Bluesky\Models\Auth\Credentials;
    use Bearlovescode\Bluesky\Models\RequestData;

    class SessionService extends Service
    {
        public function createSession(
            string $identifier,
            string $appPassword
        ) : Credentials
        {
            $nsid = 'com.atproto.server.createSession';

            $data = new RequestData([
                'identifier' => $identifier,
                'password' => $appPassword
            ]);

            $res = $this->handle($nsid, $data);

            if ($res->getStatusCode() !== 200)
            {

            }

        }

        public function refreshSession()
        {

        }
    }