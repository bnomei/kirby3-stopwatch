<?php

declare(strict_types=1);

namespace Bnomei;

use Kirby\Toolkit\A;
use Symfony\Component\Stopwatch\Stopwatch as SymStopwatch;

final class Stopwatch extends SymStopwatch
{
    /**
     * @var array
     */
    private $options;

    /**
     * Stopwatch constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $defaults = [
            'precision' => option('bnomei.stopwatch.precision', true),
        ];
        $this->options = array_merge($defaults, $options);

        parent::__construct($this->options['precision']);
    }

    /**
     * @param string|null $key
     *
     * @return array
     */
    public function option(?string $key = null)
    {
        if ($key) {
            return A::get($this->options, $key);
        }
        return $this->options;
    }

    /**
     * @param string $eventName
     *
     * @return float|int
     */
    public function duration(string $eventName)
    {
        return $this->getEvent($eventName)->getDuration();
    }

    /**
     * @var Bnomei\Stopwatch
     */
    private static $singleton;

    /**
     * @param array $options
     *
     * @return Stopwatch
     */
    public static function singleton(array $options = []): Stopwatch
    {
        // @codeCoverageIgnoreStart
        if (! self::$singleton) {
            self::$singleton = new self($options);
        }
        // @codeCoverageIgnoreEnd

        return self::$singleton;
    }
}
