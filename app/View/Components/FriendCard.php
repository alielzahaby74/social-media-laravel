<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FriendCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $f_request;
    public function __construct($f_req)
    {
        $this->f_request = $f_req;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.friend-card');
    }
}
