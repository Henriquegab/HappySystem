<?php

namespace App\Listeners;

use App\Events\Estoque;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AtualizarEstoque
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Estoque  $event
     * @return void
     */
    public function handle(Estoque $event)
    {
        //
    }
}
