<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name = 'guest',
        public string $email = 'guest@gmail.com',
        public string $image = 'https://cdn-icons-png.flaticon.com/512/149/149071.png',
    ) {
        //
        $this->name = $name;
        $this->email = $email;
        $this->image = $image;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.navbar');
    }
}
