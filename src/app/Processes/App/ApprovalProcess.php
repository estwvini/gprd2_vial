<?php

namespace App\Processes\App;

use App\Models\App\Review;
use App\Models\System\User;
use Exception;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ApprovalProcess
 * @package App\Processes\App
 */
class ApprovalProcess
{

    /**
     * Constructor de FaqProcess.
     */
    public function __construct()
    {
    }

    /**
     * Cargar información de comentarios.
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $data)
    {
        $actions = [];

        $actions['edit'] = [
            'route' => 'edit.approvals.reviews',
            'tooltip' => trans('app.labels.edit')
        ];

        $query = Review::responses()->with(['parent.location', 'reviewable'])
            ->when(isset($data['status']) && $data['status'] == 'on', function ($query) {
                $query->where('approved', 1);
            }, function ($query) {
                $query->where('approved', 0);
            })->orderBy('parent_id');

        return DataTables::of($query)
            ->setRowId('id')
            ->addColumn('bulk_action', function ($entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}'/>";
            })
            ->editColumn('author', function ($entity) {
                if ($entity->author instanceof User) {
                    return $entity->author->fullName();
                }
                return '';
            })
            ->editColumn('location', function ($entity) {
                return $entity->parent->location ? $entity->parent->location->description : '';
            })
            ->addColumn('subject', function ($entity) {
                return $entity->reviewable->name;
            })
            ->addColumn('parent_comment', function ($entity) {
                return $entity->parent->comment;
            })
            ->addColumn('rating', function ($entity) {
                return view('app.reviews.rating', ['rating' => $entity->parent->rating]);
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'rating', 'bulk_action'])
            ->make(true);
    }

    public function bulkApprove(array $ids)
    {
        $entities = Review::whereIn('id', $ids)->get();

        foreach ($entities as $entity) {
            $entity->approved = 1;
            $entity->save();
        }
    }
}