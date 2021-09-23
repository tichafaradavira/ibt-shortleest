<?php

namespace Modules\Users\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class  SubscriptionSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync billing information with stripe.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function handle()
    {
        $anchor = Carbon::parse('first day of next month')->addMonth();
        $today = Carbon::now();
        $days = $today->diffInDays($anchor);

        $users = \Modules\Users\Models\User::query()->where('is_admin', false)
                                                     ->where('trial_ends_at', '<=',$today)
                                                    ->get();


        foreach ($users as $user){
            $paymentMethod = $user->defaultPaymentMethod();
            if ($user->hasDefaultPaymentMethod()) {
                $user->newSubscription('default', 'price_1JLuetIYDkw8EwvfudV1e86L')
                    ->anchorBillingCycleOn($anchor->startOfDay())
                    ->trialDays($days-1)
                    ->create($paymentMethod->id);
            }

        }
    }
}
