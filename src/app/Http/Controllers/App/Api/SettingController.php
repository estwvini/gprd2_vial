<?php

namespace App\Http\Controllers\App\Api;

use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Retrieve a collection of departments.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $ethnicity = json_decode($this->settingRepository->findByKey('app_ethnicity'))->value;
        $contact = json_decode($this->settingRepository->findByKey('app_contact'))->value;
        return $this->response([
            'ethnicity' => $ethnicity,
            'contact' => $contact,
        ]);
    }
}
