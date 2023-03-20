<table class="table report-table" id="annual_budget_planning_tb">
    <thead>
    <tr>
        <th>{{ trans('reports/planning/ppi.labels.header.objective_description') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.program_name') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.project_name') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.executing_unit') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.component') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.activity') }}</th>
        <th>{{ trans('reports/planning/ppi.labels.header.referential_budget') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->projectFiscalYear->project->subprogram->parent->parent->description }}</td>
            <td>{{ $entity->projectFiscalYear->project->subprogram->parent->code . ' - ' . $entity->projectFiscalYear->project->subprogram->parent->description }}</td>
            <td>{{ $entity->projectFiscalYear->project->cup . ' - ' . $entity->projectFiscalYear->project->name }}</td>
            <td>{{ $entity->projectFiscalYear->project->executingUnit->name }}</td>
            <td>{{ $entity->component->name }}</td>
            <td>{{ $entity->name }}</td>
            <td>{{ number_format($entity->budgetItems->sum('amount'), 2, '.', '') }}</td>
        </tr>
    @endforeach
    <tfoot>
    <tr>
        <th colspan="6">{{ trans('reports/planning/ppi.labels.footer.total_budget') }}</th>
        <th>{{ number_format($totalBudget, 2, '.', '') }}</th>
    </tr>
    </tfoot>
</table>