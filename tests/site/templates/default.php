<?php

echo 'EVENT DURATION' . PHP_EOL;
site()->stopwatch()->start('myevent');
usleep(500);
site()->stopwatch()->stop('myevent');
echo site()->stopwatch()->duration('myevent') . PHP_EOL;  // float | int

echo 'EVENT WITH LAPS' . PHP_EOL;
$eventName = 'my event with laps';
$stopwatch = site()->stopwatch();
$stopwatch->start($eventName);
foreach ([random_int(100,500),random_int(100,500),random_int(100,500)] as $time) {
    usleep($time);
    $stopwatch->lap($eventName);
}
usleep(100);
$stopwatch->stop($eventName);
$totalDuration = $stopwatch->duration($eventName); // float | int
echo $totalDuration . PHP_EOL;
foreach ($stopwatch->getEvent($eventName)->getPeriods() as $period) {
    echo $period->getDuration() . PHP_EOL;  // float | int
}
