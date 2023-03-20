<?php

namespace App\Exports;

use App\Models\Business\Roads\GeneralCharacteristicsOfTrackHdm4;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewRoadsExport implements FromView
{

    public function view(): View
    {

        $excelReports = GeneralCharacteristicsOfTrackHdm4::all();

        return view('business.roads.general_characteristics_of_track.modifyFile', [
            'excelReports' => $excelReports
        ]);
    }
}