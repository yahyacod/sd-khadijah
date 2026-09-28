<?php

namespace App\Providers;

use App\Models\NavGroup;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share data menu navigasi ke SEMUA halaman yang pakai layout utama.
        // Grup menu dikelola penuh dari admin (Filament resource "Grup
        // Navigasi") — halaman baru otomatis muncul di menu begitu admin
        // memilih grup yang sesuai di field "Grup Menu" pada form Halaman.
        View::composer('layouts.app', function ($view) {
            $navGroups = NavGroup::with(['pages' => function ($query) {
                $query->where('status', 'publish')
                    ->whereNull('parent_id') // anak halaman muncul lewat relasi children, bukan di sini
                    ->orderBy('menu_order')
                    ->with(['children' => function ($q) {
                        $q->where('status', 'publish')->orderBy('menu_order');
                    }]);
            }])
                ->orderBy('sort_order')
                ->get();

            $view->with('navGroups', $navGroups);
        });
    }
}
