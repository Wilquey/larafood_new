<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Table;

class TableObserver
{
    /**
     * Handle the table "creating" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function creating(Table $table)
    {
        $table->uuid = Str::uuid();
    }

    /**
     * Handle the table "updating" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function updating(Table $table)
    {
        
    }
    /**
     * Handle the table "deleted" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function deleted(Table $table)
    {
        //
    }

    /**
     * Handle the table "restored" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function restored(Table $table)
    {
        //
    }

    /**
     * Handle the table "force deleted" event.
     *
     * @param  \App\Models\Table  $table
     * @return void
     */
    public function forceDeleted(Table $table)
    {
        //
    }
}
