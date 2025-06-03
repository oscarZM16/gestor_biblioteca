<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Evento;

class EventosCarousel extends Component
{
    public $eventos;

    public function __construct()
    {
        $this->eventos = Evento::all();
    }

    public function render()
    {
        return view('components.eventos-carousel');
    }
}


