<?php

namespace SBWebApplication\View\Asset;

class UrlAsset extends Asset
{
    /**
     * {@inheritdoc}
     */
    public function hash($salt = '')
    {
        return hash('crc32b', $this->source . $salt);
    }
}
