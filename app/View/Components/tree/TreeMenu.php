<?php

namespace App\View\Components\Tree;

use App\Utils\MenuUtils;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TreeMenu extends Component
{
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $menus = MenuUtils::getPreviewTreeMenu();
        return view('components.tree.tree-menu', compact('menus'));
    }
}
