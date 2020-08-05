<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bnomei\Stopwatch;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Stopwatch\StopwatchPeriod;

final class StopwatchTest extends TestCase
{
    public function testConstructs()
    {
        $stopwatch = new Stopwatch();
        $this->assertInstanceOf(Stopwatch::class, $stopwatch);
    }

    public function testEvent()
    {
        $eventName = 'onesecond';

        $stopwatch = new Stopwatch  ([
            'precision' => false,
        ]);

        $stopwatch->start($eventName);
        usleep(1);
        $stopwatch->stop($eventName);

        $duration = $stopwatch->duration($eventName);
        $this->assertTrue($duration == 0);
    }

    public function testLaps()
    {
        $eventName = 'onesecond';

        $stopwatch = new Stopwatch([
            'precision' => true,
        ]);

        $stopwatch->start($eventName);
        usleep(500);
        $stopwatch->lap($eventName);
        usleep(300);
        $stopwatch->lap($eventName);
        usleep(200);
        $stopwatch->stop($eventName);

        $duration = $stopwatch->duration($eventName);
        $this->assertTrue($duration >= 1.0 && $duration <= 2.0);

        $periods = $stopwatch->getEvent($eventName)->getPeriods();
        $this->assertCount(3, $periods);
        $this->assertInstanceOf(StopwatchPeriod::class, $periods[0]);
    }

    public function testOption()
    {
        $stopwatch = new Stopwatch([
            'precision' => true,
        ]);

        $this->assertIsArray($stopwatch->option());
        $this->assertTrue($stopwatch->option('precision'));

        $stopwatch = new Stopwatch([
            'precision' => false,
        ]);

        $this->assertFalse($stopwatch->option('precision'));
    }

    public function testSingleton()
    {
        // create
        $stopwatch = Stopwatch::singleton();
        $this->assertInstanceOf(Stopwatch::class, $stopwatch);
        // from static cached
        $stopwatch = Stopwatch::singleton();
        $this->assertInstanceOf(Stopwatch::class, $stopwatch);
    }
}
