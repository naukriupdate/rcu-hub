<?php

namespace App\Console\Commands;

use App\Services\RcuNoticeSyncService;
use Illuminate\Console\Command;

class SyncRcuNotices extends Command
{
    protected $signature = 'rcu:sync-notices';
    protected $description = 'Synchronize latest official notices from RCU WordPress REST API';

    public function handle(RcuNoticeSyncService $syncService): int
    {
        $this->info('Connecting to official RCU WordPress portal...');
        $result = $syncService->sync();

        if ($result['success']) {
            $this->info($result['message']);
            return Command::SUCCESS;
        }

        $this->warn($result['message']);
        return Command::FAILURE;
    }
}
