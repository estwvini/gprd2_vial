<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>{{ trans('reports.executive_summary.title') }}</title>
    <link rel="stylesheet" href="{{ mix('css/report_pdf.css') }}" media="all"/>
</head>
<body>

@foreach($projectFiscalYears['projectFiscalYears'] as $projectFiscalYear)
    <h3 class="align-center strong">{{ trans('reports.executive_summary.title') }}</h3>
    <table width="100%" class="table">
        <colgroup>
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
            <col width="50px">
        </colgroup>
        <tbody>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.name') }} {{ $projectFiscalYear->project->name }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.sector') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.status') }} {{ trans('projects.status.' . strtolower($projectFiscalYear->status)) }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.institution') }} {{ trans('reports.executive_summary.project_GAD') }} {{ $projectFiscalYears['gadName'] }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.responsible') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_responsible_name') }} {{ count($projectFiscalYear->project->leaders) ? $projectFiscalYear->project->leaders[0]->first_name : '' }} {{ count($projectFiscalYear->project->leaders) ? $projectFiscalYear->project->leaders[0]->last_name : '' }}
                </h4>
            </td>
            <td colspan="5">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_responsible_phone') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_responsible_email') }} {{ count($projectFiscalYear->project->leaders) ? $projectFiscalYear->project->leaders[0]->email : '' }}
                </h4>
            </td>
            <td colspan="5">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_responsible_position') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_information') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_general_objective') }} {{ $projectFiscalYear->project->purpose }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_specific_objective') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_results') }}</h4>
                <table width="100%" class="table margin-10">
                    <tr>
                        <td style="width:25px;">
                            <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_number') }}</h4>
                        </td>
                        <td style="width:450px;">
                            <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_results_components') }}</h4>
                        </td>
                    </tr>
                    @foreach($projectFiscalYear->project->components as $component)
                        <tr>
                            <td>
                                <h4 class="padding-left-10 black-font">{{ $loop->iteration }}</h4>
                            </td>
                            <td>
                                <h4 class="padding-left-10 black-font">{{ $component->name }}</h4>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_duration_time') }} {{ $projectFiscalYear->project->month_duration }} {{ trans('reports.executive_summary.project_months') }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_location') }}
                </h4>

                <h4 class="alignright black-font padding-right-10">
                    {{ $projectFiscalYear->project->zone }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background strong">
                <h4 class="padding-left-10 black-font">{{ trans('reports.executive_summary.project_beneficiaries') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="gray-background-clear">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_beneficiaries_direct') }}</h4>
            </td>
            <td colspan="3">
            </td>
            <td colspan="2">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_beneficiaries_indirect') }}</h4>
            </td>
            <td colspan="3">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="gray-background-clear">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_market') }}</h4>
            </td>
            <td colspan="8">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_local_market') }}</h4>
                <br>
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_international_market_potential') }}</h4>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_amount') }}
                </h4>
            </td>
            <td colspan="7">
                <h4 class="padding-left-10 black-font">
                    {{ $projectFiscalYear->project->referential_budget }}
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="gray-background-clear">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_cooperative_amount') }}</h4>
            </td>
            <td colspan="2">
            </td>
            <td colspan="3" class="gray-background-clear">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_contribution') }}</h4>
            </td>
            <td colspan="2">
            </td>
        </tr>
        <tr>
            <td colspan="3" class="gray-background-clear">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_other_contribution') }}</h4>
            </td>
            <td colspan="7">
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_required_operation') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_studies') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_infrastructure') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_index') }}
                </h4>
                <br>
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_TIR') }} {{ $projectFiscalYear->project->tir }}
                </h4>
                <br>
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_VAN') }} {{ $projectFiscalYear->project->van }}
                </h4>
                <br>
                <h4 class="padding-left-10 black-font strong">
                    {{ trans('reports.executive_summary.project_recuperation') }}
                </h4>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_benefits') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_observations') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="gray-background">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_address') }}</h4>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_city_firm') }}</h4>
                <br>
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_line_firm') }}</h4>
                <br>
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_name_firm') }}</h4>
                <br>
                <h4 class="padding-left-10 black-font strong">{{ trans('reports.executive_summary.project_responsible_position') }}</h4>
            </td>
        </tr>
        </tbody>
    </table>
    @if(!$loop->last)
        <div class="page_break"></div>
    @endif
@endforeach

</body>
</html>
