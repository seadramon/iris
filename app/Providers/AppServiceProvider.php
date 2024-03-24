<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.sidemenu', function($view)
        {
            $menus = Menu::with(['childmenus' => function($sql){
                    $sql->whereHas('roles', function($sql){
                        $sql->where('grpid', session('TMP_ROLE'));
                    });
                    $sql->orderBy('seq', 'asc');
                    $sql->with(['childmenus' => function($sql){
                        $sql->whereHas('roles', function($sql){
                            $sql->where('grpid', session('TMP_ROLE'));
                        });
                        $sql->orderBy('seq', 'asc');
                    }]);
                }])
                ->whereHas('roles', function($sql){
                    $sql->where('grpid', session('TMP_ROLE'));
                })
                ->whereIn('level', [0, 1])
                ->orderBy('seq', 'asc')
                ->get();

            $generatedMenu = '';
            foreach ($menus as $menu) {
                if($menu->level == 0){
                    $generatedMenu .= $this->menu0($menu);
                }else{
                    $generatedMenu .= $this->generate($menu);
                }
            }
            $view->with('menus', $generatedMenu);
        });
    }

    private function menu0($menu)
    {
        return '<div class="menu-item">
            <a class="menu-link" href="' . route($menu->route_name) . '">
                <span class="menu-icon">
                    <i class="' . $menu->icon . '"></i>
                </span>
                <span class="menu-title">' . $menu->name . '</span>
            </a>
        </div>';
    }

    private function generate($menu)
    {
        if(in_array($menu->level, [1, 3])){
            $child = '';
            foreach ($menu->childmenus as $ch) {
                $child .= $this->generate($ch);
            }
            $parent = '<div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="' . $menu->icon . '"></i>
                    </span>
                    <span class="menu-title">' . $menu->name . '</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    ' . $child . '
                </div>
            </div>';
        }elseif (in_array($menu->level, [2, 4])) {
            $parent = '<div class="menu-item">
				<a class="menu-link" href="' . route($menu->route_name) . '">
                    <span class="menu-icon">
                        <i class="' . $menu->icon . '"></i>
                    </span>
					<span class="menu-title">' . $menu->name . '</span>
				</a>
			</div>';
        }
        return $parent;
    }
}
