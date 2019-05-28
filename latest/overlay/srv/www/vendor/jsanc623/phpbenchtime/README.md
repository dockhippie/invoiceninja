PHPBenchTime v2.1.0
===================

[![Latest Stable Version](https://poser.pugx.org/jsanc623/phpbenchtime/version.svg)](https://packagist.org/packages/jsanc623/phpbenchtime)
[![Total Downloads](https://poser.pugx.org/jsanc623/phpbenchtime/downloads.svg)](https://packagist.org/packages/jsanc623/phpbenchtime)
[![Monthly Downloads](https://poser.pugx.org/jsanc623/phpbenchtime/d/monthly.png)](https://packagist.org/packages/jsanc623/phpbenchtime)
[![License](https://poser.pugx.org/jsanc623/phpbenchtime/license.svg)](https://packagist.org/packages/jsanc623/phpbenchtime)
[![Build Status](https://travis-ci.org/jsanc623/PHPBenchTime.svg)](https://travis-ci.org/jsanc623/PHPBenchTime)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/76e521f6-4935-4b06-b545-aae76d149421/small.png)](https://insight.sensiolabs.com/projects/76e521f6-4935-4b06-b545-aae76d149421)

A light benchmark timer class for PHP. PHPBenchTime v2.0.0 is quite simple to use and is loaded with more functionality
than the previous version - including more detailed summary data, more readable source, a central lap system and
(finally) pause and unpause functionality. This version is a complete rewrite of PHPBenchTime.

On Packagist
============
https://packagist.org/packages/jsanc623/phpbenchtime

Methods
=======
```
public start()
public end()
public reset()
public lap()
public summary()
public pause()
public unPause()
private endLap()
private setRunningPaused()
private getCurrentTime()
```

Properties
==========
```
private startTime
private endTime
private pauseTime
private totalTime
private laps
private isRunning
private isPaused
private lapCount
```


Usage
=====

You should see the Usage.php file in source for the best how to documentation. However, here's an overview:

Load and initiate the PHPBenchTime Timer:
```
require('PHPBenchTime.php');
use PHPBenchTime\Timer;
$T = new Timer;
```


That was easy! Now lets start a new timer:

```
$T->start();
```

Then lets just sleep for 3 seconds:
```
sleep(3);
```

Now, lets end the timer, and put results in $time:
```
$time = $T->end();
```

When we end a timer, we receive an array back, containing the start time,
end time and difference between start and end times:
```
Array (
    [running] => false
    [start] => 1406146951.9998
    [end] => 1406146952.0638
    [total] => 0.0019998550415039
    [paused] => 0
    [laps] => Array (
        [0] => Array (
            [name] => start
            [start] => 1406146951.9998
            [end] => 1406146952.0018
            [total] => 0.0019998550415039
        )
    )
)
```

Advanced Usage : Laps
=====================

PHPBenchTime also allows you to set laps between code execution, which allows 
you to determine what part of your code is causing a bottleneck.

Let's sleep for a couple of seconds between laps:
```
sleep(1);
$T->lap();
sleep(2);
$T->lap();
```

Now, let's end the timer:
```
$time = $T->end();
```

Let's see the results:
```
Array (
    [running] => false
    [start] => 1406146951.9998
    [end] => 1406146952.0638
    [total] => 0.063999891281128
    [paused] => 0.041000127792358
    [laps] => Array (
        [0] => Array (
            [name] => start
            [start] => 1406146951.9998
            [end] => 1406146952.0018
            [total] => 0.0019998550415039
        )
        [1] => Array (
            [name] => 1
            [start] => 1406146952.0018
            [end] => 1406146952.0028
            [total] => 0.0010001659393311
        )
        [2] => Array (
            [name] => 2
            [start] => 1406146952.0028
            [end] => 1406146952.0128
            [total] => 0.0099999904632568
        )
    )
)
```

Advanced Usage
==============
PHPBenchTime allows you to do named laps, as well as to pause and unpause the timer (say you want to make a network
call or a call out to the database, but don't want to include that time in your benchmark - pause and then unpause after
you receive the network/database data).

HISTORY
=======

* v1.0.0: Static Birth! 
* v1.1.0: Static Namespaces! 
* v1.2.0: Non-Static Namespaces! 
* v1.3.0: Laps! Laps! Laps! 
* v2.0.0: Complete rewrite, adds pause, unpause, central lap system and more detailed summary
* v2.1.0: Performance enhancements, unit tests, etc
