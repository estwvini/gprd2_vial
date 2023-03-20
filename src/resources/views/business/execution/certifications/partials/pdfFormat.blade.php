@inject('Certification', 'App\Models\Business\Certification' )
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>{{ trans('certifications.pdf.title') }} </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="">
            <div class="panel-heading">
                <img src="{{ public_path('images/logo_login.png') }}" style="width: 220px; height: 80px">
            </div>
            <div class="">
                <div class="main-div dt-h5-show-certifications">
                    <h5>{{$provinceName}}</h5>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.Number_of_certification') }} </h5>
                        <p style="display: inline">{{ $entity->number }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.date') }} </h5>
                        <p style="display: inline">{{ date('Y-m-d H:i', strtotime($entity->created_at)) }}</p>
                    </div>
                    @foreach($entity->user->departments as $dep)
                        <div class="form-group">
                            <h5 style="display: inline">{{ trans('certifications.pdf.direction') }} </h5>
                            <p style="display: inline">{{ $dep->name}}</p>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.project') }} </h5>
                        <p style="display: inline">{{ $project->cup . ' - ' . $project->name }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.activity') }}</h5>
                        <p style="display: inline">{{ $entity->activity->code . ' ' . $entity->activity->name  }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.Objectify') }}</h5>
                        <p style="display: inline">{{ $entity->topic }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.total_amount') }}</h5>
                        @php $sum=0 @endphp
                        @foreach($entity->budgetItems as $item)
                            <p style="display: none">{{$sum+=$item->pivot->amount}}</p>
                            @if($loop->last)
                                <p style="display: inline">{{$sum}}</p>
                            @endif

                        @endforeach
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.program') }} </h5>
                        <p style="display: inline">{{ $project->subprogram->parent->code . ' - ' . $project->subprogram->parent->description  }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.subprogram') }} </h5>
                        <p style="display: inline">{{ $project->subprogram->code . ' - ' .  $project->subprogram->description }}</p>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.status') }} </h5>
                        <p style="display: inline">{{ trans('certifications.pdf.APPROVED') }} </p>
                    </div>
                    <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('budget_item.labels.budget_item') }}</th>
                                <th>{{ trans('reports.budget_card.certified') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($entity->budgetItems as $item)
                                <tr>
                                    <td class="text-center fw-b">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->code }}
                                        <br>
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-center">{{ number_format((float)$item->pivot->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="text-center"> {{ trans('reports.admin_activities_budget.no_info') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.message_certification') }} </h5>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <h5 style="display: inline">{{ trans('certifications.pdf.attentively') }} </h5>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <p>{{ $entity->user->first_name}}{{ $entity->user->last_name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
