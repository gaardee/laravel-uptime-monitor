<?php

return [

    /*
     * You can get notified when specific events occur. Out of the box you can use 'mail'
     * and 'slack'. Of course you can also specify your own notification classes.
     */
    'notifications' => [

        'notifications' => [
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckFailed::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckRecovered::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckSucceeded::class => [],

            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckFailed::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateExpiresSoon::class => ['slack'],
            \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckSucceeded::class => [],
        ],

        /*
         * The location from where you are running this Laravel application. This location will be
         * mentioned in all notifications that will be sent.
         */
        'location' => '',

        /*
         * To keep reminding you that a site is down, notifications
         * will be resent every given number of minutes. Value can
         * be either an integer to send at a fixed interval, or
         * an array where key is minutes since down and value
         * is minutes between notifications
         */
        'resend_uptime_check_failed_notification_every_minutes' => 60,

        // 'resend_uptime_check_failed_notification_every_minutes' => [
        //     0 => 15, // Start by notifying every 15 minutes
        //     6* 60 => 30, // After 6 hours notify every 30 minutes
        //     24 * 60 => 60, // After 24 hours notify every 60 minutes
        //     3 * 24 * 60 => 4 * 60, // After 3 days notify every 4 hours
        //     7 * 24 * 60 => 24 * 60 // After 7 days notify every 24 hours
        // ],

        'mail' => [
            'to' => ['your@email.com'],
        ],

        'slack' => [
            'webhook_url' => env('UPTIME_MONITOR_SLACK_WEBHOOK_URL'),
        ],

        /*
         * Here you can specify the notifiable to which the notifications should be sent. The default
         * notifiable will use the variables specified in this config file.
         */
        'notifiable' => \Spatie\UptimeMonitor\Notifications\Notifiable::class,

        /*
         * The date format used in notifications.
         */
        'date_format' => 'd/m/Y',
    ],

    'uptime_check' => [

        /*
         * When the uptime check could reach the url of a monitor it will pass the response to this class
         * If this class determines the response is valid, the uptime check will be regarded as succeeded.
         *
         * You can use any implementation of Spatie\UptimeMonitor\Helpers\UptimeResponseCheckers\UptimeResponseChecker here.
         */
        'response_checker' => Spatie\UptimeMonitor\Helpers\UptimeResponseCheckers\LookForStringChecker::class,

        /*
         * An uptime check will be performed if the last check was performed more than the
         * given number of minutes ago. If you change this setting you have to manually
         * update the `uptime_check_interval_in_minutes` value of your existing monitors.
         *
         * When an uptime check fails we'll check the uptime for that monitor every time `monitor:check-uptime`
         * runs regardless of this setting.
         */
        'run_interval_in_minutes' => 5,

        /*
         * To speed up the uptime checking process the package can perform the uptime check of several
         * monitors concurrently. Set this to a lower value if you're getting weird errors
         * running the uptime check.
         */
        'concurrent_checks' => 10,

        /*
         * The uptime check for a monitor will fail if the url does not respond after the
         * given number of seconds.
         */
        'timeout_per_site' => 10,

        /*
         * Because networks can be a bit unreliable the package can make three attempts
         * to connect to a server in one uptime check. You can specify the time in
         * milliseconds between each attempt.
         */
        'retry_connection_after_milliseconds' => 100,

        /*
         * If you want to change the default Guzzle client behaviour, you can do so by
         * passing custom options that will be used when making requests.
         */
        'guzzle_options' => [
            // 'allow_redirects' => false,
        ],

        /*
         * Fire `Spatie\UptimeMonitor\Events\MonitorFailed` event only after
         * the given number of uptime checks have consecutively failed for a monitor.
         */
        'fire_monitor_failed_event_after_consecutive_failures' => 2,

        /*
         * When reaching out to sites this user agent will be used.
         */
        'user_agent' => 'spatie/laravel-uptime-monitor uptime checker',

        /*
         * When reaching out to the sites these headers will be added.
         */
        'additional_headers' => [],
    ],

    'certificate_check' => [

        /*
         * The `Spatie\UptimeMonitor\Events\SslExpiresSoon` event will fire
         * when a certificate is found whose expiration date is in
         * the next number of given days.
         */
        'fire_expiring_soon_event_if_certificate_expires_within_days' => 10,
    ],

    /*
     * To add or modify behaviour to the Monitor model you can specify your
     * own model here. The only requirement is that it should extend
     * `Spatie\UptimeMonitor\Models\Monitor`.
     */
    'monitor_model' => Spatie\UptimeMonitor\Models\Monitor::class,
];
