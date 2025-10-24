<?php

namespace App\View\Components\badge;

use App\Utils\MenuUtils;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TreeMenu extends Component
{
    public function __construct()
    {
        //
        $menus = MenuUtils::getTreeMenu();
        dd($menus);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $menus = MenuUtils::getTreeMenu();
        dd($menus);
        return view('components.tree.tree-menu', compact('menus'));
    }
}
