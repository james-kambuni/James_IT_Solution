<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   public function handle()
{
    \App\Models\OrderItem::truncate();
    \App\Models\Order::truncate();

    $this->info('All orders cleared successfully.');
}

}
