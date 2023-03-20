@permission('showplanlinks.plan.link.links.plans.plans_management')
@inject('Plan', '\App\Models\Business\Plan')
<div class="page-title">
    <div class="title_left">
        <h3>{{ trans('links.title') }}
            <small>{{ trans('app.labels.administration') }}</small>
        </h3>
    </div>

    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">

            @permission('index.plans.plans_management')
            <li>
                <a href="{{ route('plan.link.links.plans.plans_management', ['id' => $plan->id]) }}" class="ajaxify"> {{ trans('links.title') }}</a>
            </li>
            @endpermission

            <li class="active"> {{ trans('app.labels.details') }}</li>
        </ol>
    </div>
</div>

<div class="clearfix"></div>

<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    @foreach($tabs as $index => $tab)
        <li class="nav-item">
            <a id="tab_{{ $index }}" class="nav-link" role="tab" data-toggle="tab" href="#panel_{{ $index }}" aria-controls="panel_{{ $index }}">
                {{ \Illuminate\Support\Str::limit($plan->name, 15, '...') }}
                <i class="fa fa-arrow-right"></i>
                {{ \Illuminate\Support\Str::limit($tab['linkedPlan']->name, 15, '...') }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach($tabs as $index => $tab)
        <div class="x_content tab-pane mb-15" role="tabpanel" id="panel_{{ $index }}">
            <table class="table report-table">
                <thead>
                <tr>
                    <th class="planLinkColor" align="center" colspan="@if(!in_array($plan->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL])) 4 @else 3 @endif"><b>{{ $plan->name }}</b></th>
                    <th class="linkedPlanColor" align="center" colspan="@if(!in_array($tab['linkedPlan']->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL, $Plan::TYPE_ODS])) 4 @else 3 @endif"><b>{{ $tab['linkedPlan']->name }}</b></th>
                </tr>
                <tr>
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.vision') }}</b></th>
                    @if(!in_array($plan->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL]))
                        <th class="planLinkColor" align="center"><b>{{ trans('links.labels.thrust') }}</b></th>
                    @endif
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.objective') }}</b></th>
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.goal') }}</b></th>

                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.goal') }}</b></th>
                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.objective') }}</b></th>
                    @if(!in_array($tab['linkedPlan']->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL, $Plan::TYPE_ODS]))
                        <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.thrust') }}</b></th>
                    @endif
                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.vision') }}</b></th>
                </tr>
                </thead>
                <tbody>
                @if($tab['rows']->count())
                    @foreach($tab['rows'] as $row)
                        <tr>
                            @foreach($row as $column)
                                <td width="12.5%" rowspan="{{ $column['rowspan'] }}">{!! $column['text'] !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td width="100%" align="center" colspan="8"> {{ trans('links.messages.info.noLinks') }} </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('plan.link.links.plans.plans_management', [ 'id' => $plan->id ]) }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        $('#tab_0').tab('show')
    })
</script>

@endpermission
