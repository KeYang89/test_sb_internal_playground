<?php

namespace SBWebApplication\Feed;

class FeedFactory
{
    /**
     * @var string[]
     */
    protected $feeds = [
        Feed::ATOM => 'SBWebApplication\Feed\Feed\Atom',
        Feed::RSS1 => 'SBWebApplication\Feed\Feed\RSS1',
        Feed::RSS2 => 'SBWebApplication\Feed\Feed\RSS2'
    ];

    /**
     * Creates a feed.
     *
     * @param  string $type
     * @param  array  $elements
     * @return FeedInterface
     */
    public function create($type = null, array $elements = [])
    {
        $class = isset($this->feeds[$type]) ? $this->feeds[$type] : $this->feeds[Feed::RSS2];
        return (new $class)->addElements($elements);
    }

    /**
     * Registers a new feed type.
     *
     * @param string $type
     * @param string $class
     */
    public function register($type, $class)
    {
        if (!is_string($class) || !is_subclass_of($class, 'SBWebApplication\Feed\FeedInterface')) {
            throw new \InvalidArgumentException(sprintf('Given type class "%s" is not of type SBWebApplication\Feed\FeedInterface', (string) $class));
        }

        $this->feeds[$type] = $class;
    }
}
