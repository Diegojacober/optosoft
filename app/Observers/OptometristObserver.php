<?php

namespace App\Observers;

use App\Models\Optometrist;
use Illuminate\Support\Str;
class OptometristObserver
{
    /**
     * Handle the Optometrist "created" event.
     *
     * @param  \App\Models\Optometrist  $optometrist
     * @return void
     */
    public function creating(Optometrist $optometrist)
    {
        $optometrist->uuid = Str::uuid();
        $optometrist->pago = 0;
    }

    /**
     * Handle the Optometrist "updated" event.
     *
     * @param  \App\Models\Optometrist  $optometrist
     * @return void
     */
    public function updated(Optometrist $optometrist)
    {
        //
    }

    /**
     * Handle the Optometrist "deleted" event.
     *
     * @param  \App\Models\Optometrist  $optometrist
     * @return void
     */
    public function deleted(Optometrist $optometrist)
    {
        //
    }

    /**
     * Handle the Optometrist "restored" event.
     *
     * @param  \App\Models\Optometrist  $optometrist
     * @return void
     */
    public function restored(Optometrist $optometrist)
    {
        //
    }

    /**
     * Handle the Optometrist "force deleted" event.
     *
     * @param  \App\Models\Optometrist  $optometrist
     * @return void
     */
    public function forceDeleted(Optometrist $optometrist)
    {
        //
    }
}
