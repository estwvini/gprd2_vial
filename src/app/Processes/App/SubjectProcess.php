<?php

namespace App\Processes\App;

use App\Models\App\Subject;
use Exception;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase SubjectProcess
 * @package App\Processes\App
 */
class SubjectProcess
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
            'route' => 'edit.subjects',
            'tooltip' => trans('app.labels.update')
        ];

        $actions['trash'] = [
            'route' => 'destroy.subjects',
            'tooltip' => trans('app.labels.delete'),
            'confirm_message' => trans('app/subjects.messages.confirm.delete'),
            'btn_class' => 'btn-danger',
            'method' => 'delete'
        ];

        return DataTables::of(Subject::with('responsible')->get())
            ->setRowId('id')
            ->editColumn('responsible_id', function ($entity) {
                return $entity->responsible ? $entity->responsible->fullName() : '';
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                $actions['edit']['params'] = [
                    'subject' => $entity->id
                ];
                $actions['trash']['params'] = [
                    'subject' => $entity->id
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
