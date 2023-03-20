<?php

namespace App\Http\Controllers\Business\UserTasks;

use App\Http\Controllers\Controller;
use App\Models\Business\UserTask;
use App\Models\System\Setting;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Throwable;

class UserTaskController extends Controller
{

    public function index(Request $request)
    {
        try {
            $date = $this->getDate($request);
            $tasks = UserTask::whereDate('date_at', $date)->orderBy('id', 'desc')->get();
            $date = DateTime::createFromFormat('!Y-m-d', $date)->format('d-m-Y');
            $response['view'] = view('business.user_tasks.index', compact('tasks', 'date'))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['date_at'] = DateTime::createFromFormat('!d-m-Y', $request->input('date_at'));
        $task = UserTask::create($data);
        return response()->json($task, 201);
    }

    public function update(Request $request, UserTask $task)
    {
        $task->update($request->all());
        $redirect = $request->input('redirect');
        $date = $this->getDate($request);
        if ($redirect) {
            $tasks = UserTask::whereDate('date_at', $date)->orderBy('id', 'desc')->get();
            $date = DateTime::createFromFormat('!Y-m-d', $date)->format('d-m-Y');
            $response['view'] = view('business.user_tasks.index', compact('tasks', 'date'))->render();
            return response()->json($response);
        }
        return response()->json($task);
    }

    public function delete(Request $request, UserTask $task)
    {
        $task->delete();

        $date = $this->getDate($request);
        $tasks = UserTask::whereDate('date_at', $date)->orderBy('id', 'desc')->get();
        $date = DateTime::createFromFormat('!Y-m-d', $date)->format('d-m-Y');
        $response['view'] = view('business.user_tasks.index', compact('tasks', 'date'))->render();

        return response()->json($response);
    }

    public function export(Request $request)
    {
        try {
            $from = $request->input('date_from');
            $to = $request->input('date_to');
            $tasks = UserTask::query()->when($from, function ($query) use ($from) {
                $query->whereDate('date_at', '>=', $from);
            })->when($to, function ($query) use ($to) {
                $query->whereDate('date_at', '<=', $to);
            })->get();

            $department = currentUser()->departments->first();
            $departmentName = $department ? $department->name : '';
            $name = currentUser()->fullName();
            $director = $department->managers->first() ? $department->managers->first()->fullName() : '';

            $pdf = PDF::loadView('business/user_tasks/report_pdf', compact('tasks', 'departmentName', 'name', 'director', 'from', 'to'))->setPaper('a4');
            return $pdf->download(trans('user_tasks.title') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    private function getDate(Request $request)
    {
        return $request->input('date') ? DateTime::createFromFormat('!d-m-Y', $request->input('date'))->format('Y-m-d') : now()->format('Y-m-d');
    }

}
