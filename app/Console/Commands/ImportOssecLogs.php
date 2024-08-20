<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OssecLog;

class ImportOssecLogs extends Command
{
    protected $signature = 'logs:import';
    protected $description = 'Import OSSEC logs into the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $logFile = '/var/ossec/logs/alerts/alerts.log';
        
        // Check if the file is readable
        if (!is_readable($logFile)) {
            $this->error('Log file is not readable or does not exist.');
            return;
        }

        $fileHandle = fopen($logFile, 'r');

        if ($fileHandle) {
            while (($line = fgets($fileHandle)) !== false) {
                // Check if the log entry already exists in the database
                if (!OssecLog::where('log_entry', $line)->exists()) {
                    OssecLog::create([
                        'log_entry' => $line
                    ]);
                }
            }
            fclose($fileHandle);
            $this->info('Log import completed successfully.');
        } else {
            $this->error('Failed to open the log file.');
        }
    }
}
