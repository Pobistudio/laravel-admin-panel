<?php

namespace App\View\Components\badge;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoleBadge extends Component
{
     // Properti yang diterima dari pemanggilan component
    public string $role;
    public string $classColor;

    /**
     * Create a new component instance.
     *
     * @param string $role ID status (contoh: 'Super Admin', 'Admin')
     */
    public function __construct(string $role)
    {
        $this->role = $role;

        // Atur warna berdasarkan ID status
        $this->classColor = $this->mapColor($role);
    }

    /**
     * Peta warna untuk setiap ID status. (Menggunakan Tailwind CSS classes)
     */
    private function mapColor(string $id): string
    {
        $id = strtolower($id);
        return match ($id) {
            'super admin' => 'bg-purple-100 text-purple-800 border border-purple-400', // Warna spesial
            'admin' => 'bg-indigo-100 text-indigo-800',
            default => 'bg-gray-100 text-gray-800', // Warna default untuk peran lainnya
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.badge.role-badge');
    }
}
