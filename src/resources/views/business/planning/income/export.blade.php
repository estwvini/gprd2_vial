<table>
    <thead>
    <tr>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">item_presupuestario</th>
        <th style="width: 19px; background-color: #B3B3B3; font-weight: bold;">fuente_financiamiento</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">codigo_distribuidor</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">nombre_distribuidor</th>
        <th style="width: 18px; background-color: #B3B3B3; font-weight: bold;">organismo</th>
        <th style="width: 50px; background-color: #B3B3B3; font-weight: bold;">detalle_ingreso</th>
        <th style="width: 13px; background-color: #B3B3B3; font-weight: bold;">valor</th>
    </tr>
    </thead>
    @foreach($rows as $row)
        <tr>
            <td>{{ $row->budget_classifier->full_code }}</td>
            <td>{{ $row->financing_source->code }}</td>
            <td>{{ $row->distributor_code }}</td>
            <td>{{ $row->distributor_name }}</td>
            <td>{{ $row->institution ? $row->institution->code : '' }}</td>
            <td>{{ $row->justification ?? $row->budget_classifier->title }}</td>
            <td>{{ $row->value }}</td>
        </tr>
    @endforeach
</table>