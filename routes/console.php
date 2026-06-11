<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Override built-in serve command (fix for Windows process launch issue)
Artisan::command('serve {--port=8000 : Port to serve on} {--host=127.0.0.1 : Host to serve on}', function () {
    $host = $this->option('host');
    $port = $this->option('port');
    $public = base_path('public');

    $this->info("Server running on [http://{$host}:{$port}].");
    $this->comment('  Press Ctrl+C to stop the server');
    $this->newLine();

    $command = sprintf(
        '"%s" -S %s:%d -t "%s" "%s"',
        PHP_BINARY,
        $host,
        (int) $port,
        $public,
        base_path('server.php')
    );

    passthru($command, $exitCode);
    return $exitCode;
})->purpose('Serve the application on the PHP development server');
