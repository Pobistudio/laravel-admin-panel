<?php

namespace App\View\Components\app\main;

use App\Utils\SessionUtils;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $name = SessionUtils::get('name');
        $role = SessionUtils::get('role_name');
        return view('components.app.main.main-header', compact('name', 'role'));
    }
}
