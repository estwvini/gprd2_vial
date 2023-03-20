<?php

namespace App\Processes\Configuration;

use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Http\Request;

class UIProcess
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * UIProcess constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Configuration\UIProcess';
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function edit()
    {
        $settings = $this->settingRepository->all();
        if (count($settings) == 0)
            throw new \Exception(trans('configuration.ui.messages.exceptions.not_settings'), 1000);

        $menuStyles = '';
        $logos = '';
        $labels = '';

        foreach ($settings as $setting) {
            if ($setting->key == 'ui_menu_styles')
                $menuStyles = $setting->value;
            elseif ($setting->key == 'ui_logos')
                $logos = $setting->value;

            elseif ($setting->key == 'ui_project_labels')
                $labels = $setting->value;
        }

        $response['view'] = view('configuration.ui.update', [
            'menuStyles' => $menuStyles,
            'logos' => $logos,
            'labels' => $labels
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function update(Request $request)
    {
        $entities = $this->settingRepository->all();

        foreach ($entities as $entity) {
            $this->settingRepository->updateUIFromArray($request->all(), $entity);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.ui.messages.success.updated')
            ]
        ];

        return $response;
    }
}