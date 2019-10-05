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

    public function testSingleton()
    {
        // create
        $stopwatch = Stopwatch::singleton();
        $this->assertInstanceOf(Stopwatch::class, $stopwatch);
        // from static cached
        $stopwatch = Stopwatch::singleton();
        $this->assertInstanceOf(Stopwatch::class, $stopwatch);
    }

    public function testEvent()
    {
        $eventName = 'onesecond';

        $stopwatch = new Stopwatch();

        $stopwatch->start($eventName);
        sleep(1);
        $stopwatch->stop($eventName);

        $duration = $stopwatch->duration($eventName);
        $this->assertTrue($duration >= 1.0 && $duration <= 1.1);
    }

    public function testLaps()
    {
        $eventName = 'onesecond';

        $stopwatch = new Stopwatch([
            'precision' => true,
        ]);

        $stopwatch->start($eventName);
        sleep(1);
        $stopwatch->lap($eventName);
        sleep(1);
        $stopwatch->lap($eventName);
        sleep(1);
        $stopwatch->stop($eventName);

        $duration = $stopwatch->duration($eventName);
        $this->assertTrue($duration >= 3.0 && $duration <= 3.1);

        $periods = $stopwatch->duration($eventName);
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
    }
}
