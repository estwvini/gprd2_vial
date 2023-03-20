<?php

namespace App\Http\Controllers\App\Api;

use App\Models\App\Client;
use App\Models\App\VisitClient;
use App\Models\System\Setting;
use Carbon\Carbon;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class VisitClientController extends Controller
{

    public function getVisit($date)
    {

        try {
            $data = VisitClient::whereMonth('visit_at', Carbon::parse($date)->month)->get();
            if (count($data)) {
                $visit = [
                    'fecha' => $data[1]['visit_at'],
                    'numero' => count($data),

                ];
            } else {
                $visit = [];
            }
            return response()->json(['success' => 'visitas', 'data' => $visit], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json(['error' => 'visitas', 'msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getGroupClients()
    {
        $data = Client::get();
        $range = Setting::where('key', 'range_group')->first();
        $visit = [];
        $first = $range->value['first'];
        $end = $range->value['end'];
        $countYear = 0;

        do {
            foreach ($data as $key => $value) {

                if ($first == $end) {
                    if ($value->age >= $end) {
                        $countYear++;
                    }
                } else {
                    if ($value->age >= $first && $value->age < ($first + $range->value['range'])) {
                        $countYear++;
                    }
                }


            }

            if ($first == $end) {
                $visit[] = [
                    'rango' . $end => $countYear,
                ];
            } else {
                $visit[] = [
                    'rango' . $first . '-' . ($first + $range->value['range']) => $countYear,
                ];
            }


            $first = $first + $range->value['range'];
            $countYear = 0;


        } while ($first != $end + $range->value['range']);

        return response()->json(['success' => 'visitas', 'data' => $visit], Response::HTTP_OK);
    }

    public function getClientGender()
    {
        $data = Client::selectRaw('gender, count(*) as quantity')->groupBy('gender')->get();

        return $this->response($data->toArray());
    }
}
