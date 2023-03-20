<?php

namespace App\Http\ViewComposers;


use App\Models\System\Menu;
use App\Repositories\Repository\Configuration\MenuRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * @var Collection
     */
    protected $menus;

    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * Create a new permissions composer.
     *
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->menus = $this->menuRepository->findMenuTree();
    }

    private function _fillMenu($menu)
    {

        $result = [];
        $children = $this->menus->where('parent_id', '=', $menu->id)
            ->whereNotIn('slug', Menu::HIDDEN);
         

        if (count($children) == 0) {

            if (null != $menu->slug) {
                $explodeRoute = explode('.', $menu->slug);

                if (((currentUser()->can($menu->slug) && $this->checkRole($menu)) || ($explodeRoute[1] === 'app' && !currentUser()->isDeveloper()))) {
                    
                    $result[$menu->id] = [
                        'label' => $menu->label,
                        'slug' => $menu->slug
                    ];

                    if (null != $menu->icon) {
                        $result[$menu->id]['icon'] = $menu->icon;
                    }
                }
            }

        } else {

            $resultChildren = [];
            foreach ($children as $child) {
                $resultChildren += $this->_fillMenu($child);
            }

            if (count($resultChildren) > 0) {
                $result[$menu->id] = [
                    'label' => $menu->label,
                    'children' => $resultChildren
                ];

                if (null != $menu->icon) {
                    $result[$menu->id]['icon'] = $menu->icon;
                }
            }
        }            
        return $result;
    }

    /**
     * @param $menu
     *
     * @return bool
     */
    public function checkRole($menu): bool
    {        
        if (isset($menu->role)) {
            $roles = explode('|', $menu->role);           
            foreach ($roles as $index => $role) {
                if ($role === 'default') {
                    return true;
                }
            }
            return false;
        }

        return true;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $result = [];
        $parents = $this->menus->where('parent_id', '=', null);
        foreach ($parents as $parent) {
            $result += $this->_fillMenu($parent);
        }

        $view->with('menus', $result);
    }
}
