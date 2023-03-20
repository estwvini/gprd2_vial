<?php

namespace App\Http\ViewComposers;

use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\View\View;

/**
 * Clase DefaultPageComposer
 * @package App\Http\ViewComposers
 */
class DefaultPageComposer
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * Constructor de DefaultPageComposer.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Enlazar datos a la vista.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $logos = $this->settingRepository->findByKey('ui_logos');
        $labels = $this->settingRepository->findByKey('ui_project_labels');

        $view->with('logos', $logos->value);
        $view->with('labels', $labels->value);
    }
}