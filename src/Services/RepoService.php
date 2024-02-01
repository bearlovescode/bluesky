<?php
    namespace Bearlovescode\Bluesky\Services;

    use Bearlovescode\Bluesky\Exceptions\ApiResponseException;

    class RepoService extends Service
    {

        public function listRecords()
        {

        }
        public function createRecord()
        {
            $res = $this->handle($nsid, $req);

            if ($res->getStatusCode() !== 200)
                throw new ApiResponseException($res->getReasonPhrase(), $res->getStatusCode());

            $data = json_decode($res->getBody()->getContents());
        }
    }