<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class ResetAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all tables and recreates them in the specified order';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Disable foreign key verification
        Schema::disableForeignKeyConstraints();

        // Delete all tables in reverse order of creation to avoid conflicts
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('images');

        // Reactivate foreign key verification
        Schema::enableForeignKeyConstraints();

        // Execute migrations to recreate tables
        $migrations = [
            'database/migrations/2024_07_31_092624_users.php',
            'database/migrations/2024_07_31_092717_category.php',
            'database/migrations/2024_07_31_092839_products.php',
            'database/migrations/2024_07_31_092757_orders.php',
            'database/migrations/2024_07_31_092735_order_items.php',
            'database/migrations/2024_07_31_092851_reviews.php',
            'database/migrations/2024_07_31_092916_wishlists.php',
            'database/migrations/2024_07_31_092820_payments.php',
            'database/migrations/2024_07_31_092648_address.php',
            'database/migrations/2024_07_31_092648_logs.php',
            'database/migrations/2024_07_31_092648_images.php',
            'database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php',
            'database/migrations/2019_08_19_000000_create_failed_jobs_table.php',
            'database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php',
        ];

        foreach ($migrations as $migration) {
            Artisan::call('migrate', [
                '--path' => $migration,
                '--force' => true,
            ]);
        }

        $this->info('All tables have been removed and recreated correctly.');

        return 0;
    }
}
