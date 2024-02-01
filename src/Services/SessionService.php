<?php
    namespace Bearlovescode\Bluesky\Services;

    use Bearlovescode\Bluesky\Models\Auth\Credentials;
    use Bearlovescode\Bluesky\Models\RequestData;

    class SessionService
    {
        public function createSession() : Credentials
        {
            $nsid = 'com.atproto.server.createSession';

            $data = new RequestData([
                'identifier' => $this->config->identifer,
                'password' => $this->config->appPassword
            ]);

            $res = $this->query($nsid, $data);
        }

        public function refreshSession()
        {

        }
    }