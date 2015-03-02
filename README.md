Schedule
========
[![Build Status](https://travis-ci.org/timothy-r/Schedule.png)](https://travis-ci.org/timothy-r/Schedule)

A PHP5 schedule handling library.

Currently Handles parsing a CronTab formatted string.
Extendable to handle single date time instances and date ranges, eg calendar entries.

Examples:

Create an Entry object and validate a standard cron schedule string

    /**
     * First obtain a Ace\Schedule\Factory instance as $factory, eg. from an injected service
     * Then call its create method
     */
    $entry = $factory->create("5 * * * *", "cron");

To do the same for a calendar string, (any string that php's date_parse() will accept)

    /**
    * For a Job that will run every day at 10:10 in the morning
    */
    $entry = $factory->create("10:10am", "calendar");