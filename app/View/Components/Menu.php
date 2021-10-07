<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $nama;
    public $active;

    public function __construct($nama, $active)
    {
        $this->nama = $nama;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data = [
            'minuman',
            'makanan',
            'tas'
        ];
        return view('components.menu', ['list' => $data, 
                                        'nama' => $this->nama, 
                                        'active' => $this->active] );
    }
}
