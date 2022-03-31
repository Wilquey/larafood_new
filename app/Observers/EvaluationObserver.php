<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Evaluation;

class EvaluationObserver
{
    /**
     * Handle the evaluation "creating" event.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return void
     */
    public function creating(Evaluation $evaluation)
    {
        // $evaluation->uuid = Str::uuid();
    }

    /**
     * Handle the evaluation "updating" event.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return void
     */
    public function updating(Evaluation $evaluation)
    {
        
    }
    /**
     * Handle the evaluation "deleted" event.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return void
     */
    public function deleted(Evaluation $evaluation)
    {
        //
    }

    /**
     * Handle the evaluation "restored" event.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return void
     */
    public function restored(Evaluation $evaluation)
    {
        //
    }

    /**
     * Handle the evaluation "force deleted" event.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return void
     */
    public function forceDeleted(Evaluation $evaluation)
    {
        //
    }
}
