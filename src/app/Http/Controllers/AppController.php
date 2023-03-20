<?php

namespace App\Http\Controllers;

use App\Processes\AppProcess;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Laverix\Acl\Models\Eloquent\Module;
use Throwable;

class AppController extends Controller
{

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var AppProcess
     */
    protected $appProcess;

    /**
     * Constructor de AppController.
     *
     * @param SettingRepository $settingRepository
     * @param AppProcess $appProcess
     */
    public function __construct(SettingRepository $settingRepository, AppProcess $appProcess)
    {
        $this->middleware('auth');
        $this->settingRepository = $settingRepository;
        $this->appProcess = $appProcess;
    }

    /**
     * Renderizar la vista de selección de módulos.
     *
     * @return Factory|View
     */
    public function indexModules()
    {
        try {

            if (currentUser()->hasRole('developer')) {
                return self::index();
            }

            $modules = $this->appProcess->getUserModules(currentUser());
            $logos = $this->settingRepository->findByKey('ui_logos');
            $labels = $this->settingRepository->findByKey('ui_project_labels');

            if ($modules->count() === 1) {
                return self::index($modules->first());
            }

            return view('layout.modules.index', [
                'modules' => $modules,
                'logos' => $logos->value,
                'labels' => $labels->value
            ]);

        } catch (Throwable $e) {
            return view('errors.403');
        }
    }

    /**
     * Render app index
     *
     * @param Module|null $module
     *
     * @return Factory|View
     */
    public function index(Module $module = null)
    {
        try {

            if (!currentUser()->hasRole('developer') && isset($module)) {
                $modules = $this->appProcess->getUserModules(currentUser());

                if (isset($module) && $modules->contains('id', $module->id)) {
                    if (session()->has('module')) {
                        session()->forget('module');
                    }
                    session()->put('module', $module);
                } else {
                    if (!session()->has('module')) {
                        return redirect()->route('index_modules.app');
                    }
                }
            }

            $menuStyles = $this->settingRepository->findByKey('ui_menu_styles');
            $logos = $this->settingRepository->findByKey('ui_logos');
            $labels = $this->settingRepository->findByKey('ui_project_labels');
            $gad = $this->settingRepository->findByKey('gad');

            return view('layout.index', [
                'menuStyles' => $menuStyles->value,
                'logos' => $logos->value,
                'labels' => $labels->value,
                'gad' => $gad->value,
                'defaultRoute' => defaultRoute()
            ]);

        } catch (Throwable $e) {
            return view('layout.index');
        }
    }

    /**
     * Render app dashboard
     *
     * @return Factory|View
     */
    public function dashboard()
    {
        try {
            $response['view'] = view('dashboard')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Render view for unauthorized action
     *
     * @return JsonResponse
     */
    public function unauthorized()
    {
        try {
            $response = [
                'view' => view('errors.403')->render(),
                'message' => [
                    'type' => 'warning',
                    'text' => trans('app.messages.warning.unauthorized'),
                    'title' => trans('app.labels.deny')
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * @return string
     * @throws Throwable
     */
    public function confirmedEmail()
    {
        return view('business.products.email.confirmed_data')->render();
    }

    /**
     * Render temp blade to show an option in the menu
     *
     * @return Factory|View
     */
    public function defaultPage()
    {
        try {
            $response['view'] = view('system.default_page')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
