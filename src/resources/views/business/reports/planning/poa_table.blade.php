@inject('BudgetItem', '\App\Models\Business\BudgetItem')

<table class="table" id="poa_tb">
    <thead>
    <tr>
        <th colspan="39" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ trans('reports.poa.title_planning') }}</th>
    </tr>
    <tr>
        <th colspan="39"></th>
    </tr>
    <tr>
        <th colspan="6" style="text-align: center; background-color: #6FB4F6">{{ trans('reports.poa.programmatic_structure') }}</th>
        <th colspan="5" style="text-align: center; background-color: #f6ffb3">{{ trans('reports.poa.alignment_budget_item') }}</th>
        <th rowspan="2" style="background-color: #46f7ff">{{ trans('reports.poa.competence') }}</th>
        <th colspan="4" style="text-align: center; background-color: #ded3f6">{{ trans('reports.poa.alignment_orientation') }}</th>
        <th colspan="3" style="text-align: center; background-color: #d093f6">{{ trans('reports.poa.alignment_location') }}</th>
        <th rowspan="2" style="width: 20px; text-align: center; background-color: #b9b5ab">{{ trans('reports.poa.source') }}</th>
        <th rowspan="2" style="width: 30px; background-color: #b9b5ab">{{ trans('reports.poa.institution') }}</th>
        <th rowspan="2" style="width: 55px; text-align: center; background-color: #6463b9; color: #FFFFFF">{{ trans('reports.poa.budget_item') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.total_amount') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.jan') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.feb') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.mar') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.t1') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.apr') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.may') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.jun') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.t2') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.jul') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.aug') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.sep') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.t3') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.oct') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.nov') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.dec') }}</th>
        <th rowspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 12px">{{ trans('reports.poa.t4') }}</th>
    </tr>
    <tr>
        <th style="width: 15px; background-color: #6FB4F6">{{ trans('reports.poa.area') }}</th>
        <th style="width: 40px; background-color: #6FB4F6">{{ trans('reports.poa.program') }}</th>
        <th style="width: 40px; background-color: #6FB4F6">{{ trans('reports.poa.subprogram') }}</th>
        <th style="width: 40px; background-color: #6FB4F6">{{ trans('reports.poa.project') }}</th>
        <th style="width: 20px; background-color: #6FB4F6">{{ trans('reports.poa.executing_unit') }}</th>
        <th style="width: 40px; background-color: #6FB4F6">{{ trans('reports.poa.activity') }}</th>
        <th style="text-align: center;background-color: #f6ffb3">{{ trans('reports.poa.nature') }}</th>
        <th style="text-align: center;background-color: #f6ffb3">{{ trans('reports.poa.group') }}</th>
        <th style="text-align: center;background-color: #f6ffb3">{{ trans('reports.poa.subgroup') }}</th>
        <th style="width: 30px;background-color: #f6ffb3">{{ trans('reports.poa.item') }}</th>
        <th style="width: 55px; background-color: #f6ffb3">{{ trans('reports.poa.description') }}</th>
        <th style="text-align: center;background-color: #ded3f6">{{ trans('reports.poa.orientation') }}</th>
        <th style="text-align: center;background-color: #ded3f6">{{ trans('reports.poa.direction') }}</th>
        <th style="text-align: center;background-color: #ded3f6">{{ trans('reports.poa.category') }}</th>
        <th style="width: 20px; background-color: #ded3f6">{{ trans('reports.poa.sub_category') }}</th>
        <th style="text-align: center;background-color: #d093f6">{{ trans('reports.poa.province') }}</th>
        <th style="text-align: center;background-color: #d093f6">{{ trans('reports.poa.canton') }}</th>
        <th style="width: 20px; background-color: #d093f6">{{ trans('reports.poa.parish') }}</th>
    </tr>
    </thead>

    @foreach($rows as $entity)
        <tr>
            <td>
                @if($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->area->code . ' - ' . $entity->activityProjectFiscalYear->area->area}}
                @elseif($entity->operationalActivity)
                    {{ $entity->operationalActivity->subprogram->parent->area->code . ' - ' . $entity->operationalActivity->subprogram->parent->area->area}}
                @else
                    ''
                @endif
            </td>
            <td>
                @if ($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->component->project->subprogram->parent->code . ' - ' .
                       $entity->activityProjectFiscalYear->component->project->subprogram->parent->description }}
                @elseif ($entity->operationalActivity)
                    {{ $entity->operationalActivity->subprogram->parent->code . ' - ' . $entity->operationalActivity->subprogram->parent->name }}
                @else
                    ''
                @endif
            </td>
            <td>
                @if ($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->component->project->subprogram->code . ' - ' .
                       $entity->activityProjectFiscalYear->component->project->subprogram->description }}
                @elseif ($entity->operationalActivity)
                    {{ $entity->operationalActivity->subprogram->code . ' - ' . $entity->operationalActivity->subprogram->name }}
                @else
                    ''
                @endif
            </td>
            <td>
                @if ($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->component->project->cup . ' - ' . $entity->activityProjectFiscalYear->component->project->name }}
                @else
                    {{ $BudgetItem::CODE_999 }}
                @endif
            </td>
            <td>
                @if ($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->component->project->executingUnit->code . ' - ' .
                       $entity->activityProjectFiscalYear->component->project->executingUnit->name}}
                @elseif ($entity->operationalActivity)
                    {{ $entity->operationalActivity->executingUnit->code . ' - ' . $entity->operationalActivity->executingUnit->name}}
                @else
                    ''
                @endif
            </td>
            <td>
                @if ($entity->activityProjectFiscalYear)
                    {{ $entity->activityProjectFiscalYear->code . ' - ' . $entity->activityProjectFiscalYear->name }}
                @elseif ($entity->operationalActivity)
                    {{ $entity->operationalActivity->code . ' - ' . $entity->operationalActivity->name }}
                @else
                    ''
                @endif
            </td>
            <td>{{ explode('.', $entity->budgetClassifier->full_code)[0] }}</td>
            <td>{{ explode('.', $entity->budgetClassifier->full_code)[1] }}</td>
            <td>{{ explode('.', $entity->budgetClassifier->full_code)[2] }}</td>
            <td>{{ $entity->budgetClassifier->code . ' - ' .  $entity->budgetClassifier->title}}</td>
            <td style="width: 15px;">{{ $entity->description }}</td>
            <td>
                @if($entity->competence)
                    {{ $entity->competence->code . ' - ' . $entity->competence->name }}
                @else

                @endif
            </td>
            <td>{{ explode('.', $entity->spendingGuide->full_code)[0] }}</td>
            <td>{{ explode('.', $entity->spendingGuide->full_code)[1] }}</td>
            <td>{{ explode('.', $entity->spendingGuide->full_code)[2] }}</td>
            <td>{{ $entity->spendingGuide->code . ' - ' .  $entity->spendingGuide->description}}</td>
            <td>{{ explode('.', $entity->geographicLocation->getFullCode())[0] }}</td>
            <td>{{ explode('.', $entity->geographicLocation->getFullCode())[1] }}</td>
            <td>{{ $entity->geographicLocation->code . ' - ' . $entity->geographicLocation->description }}</td>
            <td>{{ $entity->source->code . ' - ' . $entity->source->description }}</td>
            <td>
                @if($entity->institution)
                    {{ $entity->institution->code . ' - ' . $entity->institution->name }}
                @else

                @endif
            </td>
            <td>{{ $entity->code }}</td>
            <td style="background-color: #6463b9; color: #FFFFFF">{{ number_format($entity->amount, 2, '.', '') }}</td>
            <td>{{ number_format($entity->jan, 2, '.', '') }}</td>
            <td>{{ number_format($entity->feb, 2, '.', '') }}</td>
            <td>{{ number_format($entity->mar, 2, '.', '') }}</td>
            <td style="background-color: #6463b9; color: #FFFFFF">{{ number_format($entity->jan + $entity->feb + $entity->mar, 2, '.', '') }}</td>
            <td>{{ number_format($entity->apr, 2, '.', '') }}</td>
            <td>{{ number_format($entity->may, 2, '.', '') }}</td>
            <td>{{ number_format($entity->jun, 2, '.', '') }}</td>
            <td style="background-color: #6463b9; color: #FFFFFF">{{ number_format($entity->apr + $entity->may + $entity->jun, 2, '.', '') }}</td>
            <td>{{ number_format($entity->jul, 2, '.', '') }}</td>
            <td>{{ number_format($entity->aug, 2, '.', '') }}</td>
            <td>{{ number_format($entity->sep, 2, '.', '') }}</td>
            <td style="background-color: #6463b9; color: #FFFFFF">{{ number_format($entity->jul + $entity->aug + $entity->sep, 2, '.', '') }}</td>
            <td>{{ number_format($entity->oct, 2, '.', '') }}</td>
            <td>{{ number_format($entity->nov, 2, '.', '') }}</td>
            <td>{{ number_format($entity->december, 2, '.', '') }}</td>
            <td>{{ number_format($entity->oct + $entity->nov + $entity->december, 2, '.', '') }}</td>
        </tr>
    @endforeach
</table>

