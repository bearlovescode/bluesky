<?php
    namespace Bearlovescode\Bluesky\Exceptions;

    class BadQueryDataException extends \Exception
    {
        public function __construct()
        {
            parent::__construct("Bad data supplied for querying",
                null,
                null);
        }
    }