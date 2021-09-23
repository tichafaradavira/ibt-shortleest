<?php

namespace Modules\Users\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class BillingSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:sync';

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
        $users = \Modules\Users\Models\User::query()->where('is_admin', false)->get();

        foreach ($users as $user){
            $user->createAsStripeCustomer([
                "name" => $user->first_name." ".$user->last_name,
                "email" => $user->email,
                "description" => "Real estate agent billing",
            ]);
        }
    }
}
