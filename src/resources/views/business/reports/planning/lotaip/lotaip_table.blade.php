<table style="table-layout: fixed; border: 0;">
    <thead>
    <tr>
        <th style="border: 1px solid #000000; color: #ffffff; background-color: #16365C;font-size: 16.0pt; font-weight: 700; text-align: center; vertical-align: middle;
        white-space:normal; height: 50px"
            colspan="6">{{ trans('reports.lotaip.text_1') }}
        </th>
    </tr>
    <tr>
        <th style="border: 1px solid #000000; color: #ffffff; background-color: #16365C;font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle;
        white-space:normal; height: 50px"
            colspan="6">{{ trans('reports.lotaip.text_2') }}
        </th>
    </tr>
    <tr>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px" colspan="4">
            {{ trans('reports.lotaip.text_3') }}
        </th>
        <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; white-space:normal; height: 50px" colspan="2"></th>

    </tr>
    <tr>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px" colspan="4">
            {{ trans('reports.lotaip.text_4') }}
        </th>
        <th colspan="2" style="border: 1px solid #000000;"></th>
    </tr>
    <tr>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px" colspan="4">
            {{ trans('reports.lotaip.text_5') }}
        </th>
        <th colspan="2" style="border: 1px solid #000000;"></th>
    </tr>
    <tr>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_1') }}
        </th>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_2') }}
        </th>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_3') }}
        </th>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_4') }}
        </th>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_5') }}
        </th>
        <th style="border: 1px solid #000000; background-color: #DCE6F1; font-size: 12.0pt; font-weight: bold; text-align: center; vertical-align: middle; white-space:normal;
        height: 50px">
            {{ trans('reports.lotaip.col_6') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            <td style="width: 20px; border: 1px solid #000000"></td>
            <td style="width: 50px; border: 1px solid #000000">{{ $row->procedure->name }}</td>
            <td style="width: 70px; border: 1px solid #000000">{{ $row->cpcClassifier->description }}</td>
            <td style="width: 30px; border: 1px solid #000000;  text-align: center">{{ $row->amount }}</td>
            <td style="width: 50px; border: 1px solid #000000"></td>
            <td style="width: 80px; border: 1px solid #000000"></td>
        </tr>
    @endforeach
    <tr>
        <td style="height: 50px; font-weight: bold; font-size: 14pt; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_6') }}
        </td>
        <td style="height: 50px; border: 1px solid #000000"></td>
        <td style="height: 50px; font-weight: bold; font-size: 14pt; border: 1px solid #000000; text-align: center">{{ trans('reports.lotaip.text_7') }}</td>
        <td style="height: 50px; border: 1px solid #000000"></td>
    </tr>
    <tr>
        <td style="height: 50px; font-weight: bold; font-size: 18.0pt; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_8') }}
        </td>
        <td style="height: 50px; border: 1px solid #000000; text-align: center; font-weight: bold">$ {{ $rows->sum('amount') }}</td>
        <td style="height: 50px; border: 1px solid #000000" colspan="2"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_9') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_10') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_11') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_12') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_13') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    <tr>
        <td style="height: 50px; border: 1px solid #000000" colspan="3">
            {{ trans('reports.lotaip.text_14') }}
        </td>
        <td style="height: 50px; text-align: center; border: 1px solid #000000" colspan="3"></td>
    </tr>
    </tbody>
</table>