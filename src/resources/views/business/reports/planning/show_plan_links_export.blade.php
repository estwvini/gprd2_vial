@inject('Plan', '\App\Models\Business\Plan')
<table class="table report-table">
    <thead>
    <tr>
        <th colspan="7" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{$nameReport}}</th>
    </tr>
    <tr>
        <th colspan="7"></th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; color: #ffffff; background-color: #1ABB9C !important">{{ $plans[0]->name }}</th>
        <th colspan="4" style="text-align: center; color: #ffffff; background-color: #00527F !important">{{ $tabs[0]['linkedPlan']->name }}</th>
    </tr>
    <tr>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #1ABB9C !important">{{ trans('links.labels.vision') }}</th>
        @if(!in_array($plans[0]->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL]))
            <th style="width: 50px; text-align: center; color: #ffffff; background-color: #1ABB9C !important">{{ trans('links.labels.thrust') }}</th>
        @endif
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #1ABB9C !important">{{ trans('links.labels.objective') }}</th>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #1ABB9C !important">{{ trans('links.labels.goal') }}</th>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #00527F !important;">{{ trans('links.labels.goal') }}</th>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #00527F !important;">{{ trans('links.labels.objective') }}</th>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #00527F !important;">{{ trans('links.labels.thrust') }}</th>
        <th style="width: 50px; text-align: center; color: #ffffff; background-color: #00527F !important;">{{ trans('links.labels.vision') }}</th>
    </tr>
    </thead>
    @if($tabs[0]['rows']->count())
        @foreach($tabs[0]['rows'] as $row)
            <tr>
                @foreach($row as $column)
                    <td style="height: 100px;" @if ($column['rowspan']!='') rowspan="{{  $column['rowspan'] }}" @endif>{!! $column['text'] !!}</td>
                @endforeach
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8"> {{ trans('links.messages.info.noLinks') }} </td>
        </tr>
    @endif
</table>
