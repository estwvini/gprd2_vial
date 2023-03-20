<?php

namespace App\Processes\App;

use App\Models\App\Client;
use App\Models\App\Review;
use App\Models\System\User;
use Exception;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ReviewProcess
 * @package App\Processes\App
 */
class ReviewProcess
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
    public function data()
    {
        $actions = [];

        $actions['mail-reply'] = [
            'route' => 'create.reviews',
            'tooltip' => trans('app.labels.create')
        ];

        $query = Review::ofClients()->filterBySubjectResponsible();

        return DataTables::of(Review::filterByProjectResponsible()->union($query)->with(['location', 'reviewable'])->orderBy('created_at', 'desc'))
            ->setRowId('id')
            ->editColumn('author', function ($entity) {
                if ($entity->author instanceof Client) {
                    return $entity->author->full_name;
                }
                if ($entity->author instanceof User) {
                    return $entity->author->fullName();
                }
                return '';
            })
            ->editColumn('location', function ($entity) {
                return $entity->location ? $entity->location->description : '';
            })
            ->addColumn('subject', function ($entity) {
                return $entity->reviewable->name;
            })
            ->addColumn('rating', function ($entity) {
                return view('app.reviews.rating', ['rating' => $entity->rating]);
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'rating'])
            ->make(true);
    }
}