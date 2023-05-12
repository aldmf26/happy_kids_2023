<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class BtnAldi extends Component
{
    public $teks;
    public function __construct($teks = '')
    {
        $this->teks = $teks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-aldi',[
            'user' => Auth::user()->role
        ]);
    }
}
