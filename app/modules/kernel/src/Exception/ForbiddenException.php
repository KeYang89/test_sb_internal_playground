<?php

namespace SBWebApplication\Kernel\Exception;

class ForbiddenException extends HttpException
{
    /**
     * {@inheritdoc}
     */
    public function __construct($message = null, $previous = null, $code = 403)
    {
        parent::__construct($message ?: 'Forbidden', $previous, $code);
    }
}
