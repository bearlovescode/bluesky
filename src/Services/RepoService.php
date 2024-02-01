<?php
    namespace Bearlovescode\Bluesky\Services;

    use Bearlovescode\Bluesky\Exceptions\ApiResponseException;
    use Bearlovescode\Bluesky\Models\Dtos\Repo\CreateRecordRequest;
    use Bearlovescode\Bluesky\Models\Dtos\Repo\CreateRecordResponse;
    use Bearlovescode\Bluesky\Models\Dtos\Repo\Post;

    class RepoService extends Service
    {

        public function listRecords()
        {

        }
        public function createRecord(Post $post): CreateRecordResponse
        {
            $nsid = 'com.atproto.repo.createRecord';

            $dto = new CreateRecordRequest([
                'repo' => $this->config->session->did,
                'record' => $post
            ]);

            $res = $this->handle($nsid, $dto);

            if ($res->getStatusCode() !== 200)
                throw new ApiResponseException($res->getReasonPhrase(), $res->getStatusCode());

            $data = json_decode($res->getBody()->getContents());

            return new CreateRecordResponse($data);
        }
    }