@permission('create.prioritization.plans_management')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('prioritization.title') }}
                <small>{{ trans('app.labels.projects') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.prioritization.plans_management')
                <li>
                    <a class="ajaxify" href="{{ route('index.prioritization.plans_management') }}"> {{ trans('prioritization.title') }}</a>
                </li>
                @endpermission

                <li class="active">{{ trans('prioritization.labels.create') }}</li>
            </ol>
        </div>
    </div>

    <div class="row mb-16">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-crosshairs"></i> {{ trans('prioritization.labels.scope') . ' - ' . trans('prioritization.labels.project', ['cup' => $project->cup, 'name' => $project->name]) }}
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.prioritization.plans_management') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form role="form" method="post" class="form-horizontal form-label-left" id="prioritization_fm">

                        @csrf

                        @foreach($template->scopes() as $scope)
                            @if($rows)
                                <div class="row">
                                    @endif
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel well-lg">
                                            <div class="x_title">
                                                <h2>{{ $scope->scope }}</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">

                                                @foreach($scope->criteria as $criteria)
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-5 col-sm-5 col-xs-12">{{ $criteria->question }}</label>
                                                        <div class="col-md-7 col-sm-7 col-xs-12">

                                                            <div class="input-group">
                                                                <select class="form-control select2" data-scope="{{ $scope->id }}" data-weight="{{ $scope->weight }}"
                                                                        data-criteria="{{ $criteria->id }}">
                                                                    <option value=""></option>
                                                                    @foreach($criteria->answers as $answer)
                                                                        <option value="{{ $answer->value }}">
                                                                            {{ $answer->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="input-group-addon clear-selection"
                                                                      data-toggle="tooltip"
                                                                      data-placement="right"
                                                                      data-original-title="{{ trans('app.labels.clear_selection') }}">
                                                                <span class="glyphicon glyphicon-erase"></span>
                                                            </span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="tile-stats prioritization-total">
                                                    <div class="tile_stats_count tile_stats_count_margin pr-5 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="count_top_height"><span class="count_top"><i class="fa fa-crosshairs"></i> {{ $scope->scope . ' (' .trans('prioritization.labels.total') . ')' }}</span>
                                                        </div>
                                                        <div id="scope_{{ $scope->id }}" class="count"></div>
                                                        <span class="count_bottom">{{ trans('prioritization.labels.weight') }} <i class="green">{{ $scope->weight }}</i></span>
                                                    </div>
                                                    <div class="tile_stats_count pl-5 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="count_top_height"><span class="count_top"><i class="fa fa-calculator"></i> {{ trans('prioritization.labels.score') }}</span>
                                                        </div>
                                                        <div id="score_{{ $scope->id }}" class="count"></div>
                                                        <span class="count_bottom"><i class="green">{{ trans('prioritization.labels.formula') }}</i></span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @if($rows = !$rows)
                                </div>
                            @endif
                        @endforeach

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="navbar-default navbar-fixed-bottom text-center">
        <div>
            <div class="tile-stats prioritization-total mb-4 prioritization_index">
                <span class="count_bottom">{{ trans('prioritization.labels.priority') }}: <b><i class="green" id="index_value"></i></b></span>
            </div>
        </div>
        <div>
            <a href="{{ route('index.prioritization.plans_management') }}" class="btn btn-info ajaxify">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </a>
            <button id="btnPrioritize" name="btnPrioritize" class="btn btn-success" type="button">
                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
            </button>
        </div>
    </footer>

</div>

<script>
    $(() => {

        let prioritizeButton = $('#btnPrioritize')
        let selectInputs = $('.select2')
        let prioritizationIndex = $('#index_value')

        // Initialize selects
        selectInputs.select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select_simple')) }}",
            minimumResultsForSearch: -1
        })

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelect = $(element).find('select')
            let criterionClearButton = $(element).find('span.input-group-addon')

            criterionClearButton.on('click', () => {
                criterionSelect.val(null).trigger('change')
            })
        })

        // Initialize scope total preview elements with zero
        $('[id^=scope_]').each((index, element) => {
            $(element).text((0).toFixed(1))
        })

        // Initialize score preview elements with zero
        $('[id^=score_]').each((index, element) => {
            $(element).text((0).toFixed(1))
        })

        // Initialize prioritization index with zero
        prioritizationIndex.text(0)

        /**
         * Verificar si la priorización tiene al menos un valor
         *
         * @returns {boolean}
         */
        let isPrioritized = () => {

            let prioritized = false

            selectInputs.each((index, criteria) => {
                if ($(criteria).val()) {
                    prioritized = true
                    return false;
                }
            })

            prioritized ? prioritizeButton.prop('disabled', false) : prioritizeButton.prop('disabled', true)

            return prioritized
        };

        /**
         * Crear el objeto tipo JSON con la información de priorización
         *
         * @returns {string}
         */
        let createPrioritizationObject = () => {

            let prioritization = {}

            selectInputs.each((index, criteria) => {
                if (!prioritization[$(criteria).attr('data-scope')]) {
                    prioritization[$(criteria).attr('data-scope')] = {}
                }
                prioritization[$(criteria).attr('data-scope')][$(criteria).attr('data-criteria')] = $(criteria).val() || null
            })

            return prioritization
        }

        /**
         * Calcular el total de la priorización del proyecto
         *
         * @returns {number}
         */
        let calculatePrioritizationTotal = () => {

            let total = 0

            selectInputs.each((index, criteria) => {

                let scopeWeight = parseFloat($(criteria).attr('data-weight')) || 0

                total += (parseInt($(criteria).val()) * scopeWeight) || 0
            })

            return total.toFixed(2)
        }

        // Update scope total preview elements with the selected values
        selectInputs.change((e) => {
            isPrioritized()

            let criteriaSelect = $(e.target)
            let previewElement = $('#scope_' + criteriaSelect.attr('data-scope'))
            let scoreElement = $('#score_' + criteriaSelect.attr('data-scope'))
            let scopeSum = 0

            $('[data-scope=' + criteriaSelect.attr('data-scope') + ']').each((index, criteria) => {
                scopeSum += parseInt($(criteria).val()) || 0
            })

            previewElement.text(scopeSum)
            scoreElement.text((scopeSum * criteriaSelect.attr('data-weight')).toFixed(1))
            prioritizationIndex.text(calculatePrioritizationTotal())
        })

        prioritizeButton.on('click', () => {

            if (!isPrioritized()) {
                return false
            }

            let confirmMessage = '{{ trans('prioritization.messages.confirm.create', ['total' => '__TOTAL__']) }}'.replace('__TOTAL__', '<b>' + calculatePrioritizationTotal() + '</b>')

            confirmModal(confirmMessage, () => {

                let url = '{{ route('store.create.prioritization.plans_management', ['id' => $projectFiscalYear->id]) }}'

                pushRequest(url, null, null, 'POST', {
                    _token: '{{ csrf_token() }}',
                    configuration: createPrioritizationObject()
                });
            });
        })

        isPrioritized()
    });
</script>

@else
    @include('errors.403')
    @endpermission
