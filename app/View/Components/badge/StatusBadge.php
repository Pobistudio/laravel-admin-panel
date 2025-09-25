<?php

namespace App\View\Components\badge;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
     // Properti yang diterima dari pemanggilan component
    public string $status;
    public string $classColor;

    /**
     * Create a new component instance.
     *
     * @param string $status ID status (contoh: 'active', 'deleted')
     */
    public function __construct(string $status)
    {
        $this->status = $status;

        // Atur warna berdasarkan ID status
        $this->classColor = $this->mapColor($status);
    }

    /**
     * Peta warna untuk setiap ID status. (Menggunakan Tailwind CSS classes)
     */
    private function mapColor(string $id): string
    {
        $id = strtolower($id);
        return match ($id) {
            'active' => 'bg-green-100 text-green-800',
            'registered', 'changed password' => 'bg-yellow-100 text-yellow-800',
            'inactive' => 'bg-blue-100 text-blue-800',
            'deleted' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.badge.status-badge');
    }
}
