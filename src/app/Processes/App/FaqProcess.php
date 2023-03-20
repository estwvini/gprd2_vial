<?php

namespace App\Processes\App;

use App\Models\App\Faq;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

/**
 * Clase FaqProcess
 * @package App\Processes\App
 */
class FaqProcess
{

    /**
     * Constructor de FaqProcess.
     */
    public function __construct()
    {
    }

    /**
     * Cargar información de faqs.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $actions = [];

        $actions['edit'] = [
            'route' => 'edit.faqs',
            'tooltip' => trans('app.labels.update')
        ];

        $actions['trash'] = [
            'route' => 'destroy.faqs',
            'tooltip' => trans('app.labels.delete'),
            'confirm_message' => trans('app/faqs.messages.confirm.delete'),
            'btn_class' => 'btn-danger',
            'method' => 'delete'
        ];

        return DataTables::of(Faq::all())
            ->setRowId('id')
            ->editColumn('publish', function ($entity) {
                $checked = $entity->publish ? 'checked' : '';

                return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                $actions['edit']['params'] = [
                    'faq' => $entity->id
                ];
                $actions['trash']['params'] = [
                    'faq' => $entity->id
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['publish', 'actions'])
            ->make(true);
    }
}
