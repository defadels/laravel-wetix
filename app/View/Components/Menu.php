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

    public $active;

    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.menu', ['active' => $this->active] );
    }

    public function list() {
        return [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer-alt'
            ],
            [  
                'label' => 'Movies',
                'route' => 'dashboard.movies',
                'icon' => 'fas fa-video'
            ],
            [
                'label' => 'Theater',
                'route' => 'dashboard.theater',
                'icon' => 'fas fa-university'
            ],
            [
                'label' => 'Ticket',
                'route' => 'dashboard.ticket',
                'icon' => 'fas fa-ticket-alt'
            ],
            [
                'label' => 'User',
                'route' => 'dashboard.users',
                'icon' => 'fas fa-user'
            ]
        ];
    }

    public function isActive($label) {
        return $label === $this->active;
    }
}
