<table>
    <thead>
    <tr>
        <th style="width: 10px; background-color: #B3B3B3; font-weight: bold;">area</th>
        <th style="width: 19px; background-color: #B3B3B3; font-weight: bold;">nombre_programa</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">cod_sub_programa</th>
        <th style="width: 19px; background-color: #B3B3B3; font-weight: bold;">nombre_sub_programa</th>
        <th style="width: 17px; background-color: #B3B3B3; font-weight: bold;">unidad_responsable</th>
        <th style="width: 17px; background-color: #B3B3B3; font-weight: bold;">unidad_ejecutora</th>
        <th style="width: 17px; background-color: #B3B3B3; font-weight: bold;">cod_act_operativa</th>
        <th style="width: 50px; background-color: #B3B3B3; font-weight: bold;">nombre_act_operativa</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">item_presupuestario</th>
        <th style="width: 50px; background-color: #B3B3B3; font-weight: bold;">nombre</th>
        <th style="width: 50px; background-color: #B3B3B3; font-weight: bold;">descripcion</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">valor</th>
        <th style="width: 17px; background-color: #B3B3B3; font-weight: bold;">codigo_parroquia</th>
        <th style="width: 20px; background-color: #B3B3B3; font-weight: bold;">fuente_financiamiento</th>
        <th style="width: 20px; background-color: #B3B3B3; font-weight: bold;">codigo_orientador_gasto</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">codigo_institucion</th>
        <th style="width: 15px; background-color: #B3B3B3; font-weight: bold;">compra_publica</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">enero</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">febrero</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">marzo</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">abril</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">mayo</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">junio</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">julio</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">agosto</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">septiembre</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">octubre</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">noviembre</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">diciembre</th>
    </tr>
    </thead>
    @foreach($rows as $row)
        <tr>
            <td>{{ $row->operationalActivity->subprogram->parent->area->code }}</td>
            <td>{{ $row->operationalActivity->subprogram->parent->name }}</td>
            <td>{{ $row->operationalActivity->subprogram->code }}</td>
            <td>{{ $row->operationalActivity->subprogram->name }}</td>
            <td>{{ $row->operationalActivity->responsibleUnit->code }}</td>
            <td>{{ $row->operationalActivity->executingUnit->code }}</td>
            <td>{{ $row->operationalActivity->code }}</td>
            <td>{{ $row->operationalActivity->name }}</td>
            <td>{{ $row->budgetClassifier->full_code }}</td>
            <td>{{ $row->name ?? $row->budgetClassifier->title }}</td>
            <td>{{ $row->description }}</td>
            <td>{{ $row->amount }}</td>
            <td>{{ $row->geographicLocation->code }}</td>
            <td>{{ $row->source->code }}</td>
            <td>{{ $row->spendingGuide->full_code }}</td>
            <td>{{ $row->institution ? $row->institution->code : '' }}</td>
            <td>{{ $row->is_public_purchase ? 'Si' : 'No' }}</td>

            <td>{{ $row->budgetPlannings->where('month', 1)->first()->assigned ?? '' }}</td>
            <td>{{ $row->budgetPlannings->where('month', 2)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 3)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 4)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 5)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 6)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 7)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 8)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 9)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 10)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 11)->first()->assigned ?? ''}}</td>
            <td>{{ $row->budgetPlannings->where('month', 12)->first()->assigned ?? ''}}</td>
        </tr>
    @endforeach
</table>