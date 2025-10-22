<?php

namespace App\View\Components\badge;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $type;
    public string $name;
    public string $classColor;

    /**
     * Create a new component instance.
     *
     * @param string $role ID status (contoh: 'Super Admin', 'Admin')
     */
    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;

        // Atur warna berdasarkan ID status
        $this->classColor = $this->mapColor($type, $name);
    }

    /**
     * Peta warna untuk setiap Name.
     */
    private function mapColor(string $type, string $name): string
    {
        $name = strtolower($name);
        if ($type === 'status') {
            return match ($name) {
                'active' => 'bg-green-100 text-green-800',
                'registered', 'changed password' => 'bg-yellow-100 text-yellow-800',
                'inactive' => 'bg-blue-100 text-blue-800',
                'deleted' => 'bg-red-100 text-red-800',
                default => 'bg-gray-100 text-gray-800',
            };

        } else if ($type === 'is_active') {
            return match ($name) {
                'active' => 'bg-green-100 text-green-800',
                'inactive' => 'bg-slate-100 text-slate-800',
                default => 'bg-green-100 text-green-800',
            };
        } else {
            return match ($name) {
                'super admin' => 'bg-purple-100 text-purple-800 border border-purple-400',
                'admin' => 'bg-indigo-100 text-indigo-800',
                default => 'bg-gray-100 text-gray-800',
            };
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.badge.badge');
    }
}
