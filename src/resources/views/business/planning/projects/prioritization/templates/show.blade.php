@permission('show.prioritization_templates')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('prioritization_templates.title') }}
                <small>{{ trans('app.labels.projects') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.prioritization_templates')
                <li>
                    <a class="ajaxify" href="{{ route('index.prioritization_templates') }}"> {{ trans('prioritization_templates.title') }}</a>
                </li>
                @endpermission

                <li class="active">{{ trans('prioritization_templates.labels.show') }}</li>
            </ol>
        </div>
    </div>

    <div class="row mb-16">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-recycle"></i> {{ trans('prioritization_templates.title') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.prioritization_templates') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form role="form" method="post" class="form-horizontal form-label-left" id="create_template_fm">

                        @isset($template->fiscalYear)
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fiscal_year_id">
                                {{ trans('prioritization_templates.labels.fiscal_year') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="fiscal_year_id" name="fiscal_year_id" disabled class="form-control" value="{{ $template->fiscalYear->year }}">
                            </div>
                        </div>
                        @endisset

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('app.headers.description') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" disabled
                                          class="form-control vertical"
                                          placeholder="{{ trans('prioritization_templates.placeholders.description') }}">{{ $template->description }}</textarea>
                            </div>
                        </div>

                        <div id="scopes_div" class="mt-4"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="navbar-default navbar-fixed-bottom text-center">
        <div>
            <div class="tile-stats prioritization-total mb-4 prioritization_index">
                <span class="count_bottom">{{ trans('prioritization_templates.labels.total_weight') }}: <b><i class="green" id="total_weight"></i></b></span>
            </div>
        </div>
        <div>
            <a href="{{ route('index.prioritization_templates') }}" class="btn btn-info ajaxify">
                <i class="fa fa-times"></i> {{ trans('app.labels.exit') }}
            </a>
        </div>
    </footer>

</div>

<script>
    $(() => {
        let wrapper = $('#scopes_div')
        let totalWeight = $('#total_weight')

        /**
         * Calcular el peso total (suma del peso de cada ámbito)
         */
        const calculateTotalWeight = () => {
            let weightSum = 0
            $('[id^=weight_]').each((index, element) => {
                weightSum += parseInt($(element).val()) || 0
            })

            totalWeight.text(weightSum)
        }

        // Load template scopes, criteria, questions, answers and values
        const loadTemplateInfo = () => {
            let scopes = JSON.parse('{!! json_encode($template->scopes()) !!}')
            let appendItem = ''

            wrapper.empty()

            $.each(scopes, ( scopeIndex, scope ) => {
                appendItem += '<div class="row">'
                appendItem += '    <div class="col-lg-9 col-md-10 col-sm-11 col-xs-12">'
                appendItem += '        <div class="dashboard-title title_left col-lg-8 col-md-8 col-sm-12 col-xs-12">'
                appendItem += '            <h3><a class="template-accordion" data-toggle="collapse" href="#scope_' + scope.id + '"><i class="fa fa-plus pl-2 pr-2"></i><i class="fa fa-minus hidden pl-2 pr-2"></i></a> ' + scope.scope + '</h3>'
                appendItem += '        </div>'
                appendItem += '        <div class="item form-group text-center col-lg-4 col-md-4 col-sm-12 col-xs-12 pt-2 mt-2">'
                appendItem += '            <label class="col-md-4 col-sm-4 col-xs-4 pt-2 col-xs-offset-1">{{ trans('prioritization_templates.labels.weight') }} <span class="text-danger">*</span></label>'
                appendItem += '            <div class="col-md-6 col-sm-6 col-xs-4">'
                appendItem += '                <input disabled id="weight_' + scope.id + '" required data-scope="' + scope.id + '" data-type="weight" type="number" min="0" max="100" maxlength="3" value="' + parseInt(scope.weight * 100) + '" class="form-control required-answer" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">'
                appendItem += '            </div>'
                appendItem += '        </div>'
                appendItem += '        <div class="x_content mb-4 collapse" id="scope_' + scope.id + '">'

                $.each(scope.criteria, ( criterionIndex, criterion ) => {
                    appendItem += '        <div class="x_title mb-4">'
                    appendItem += '            <h2>' + criterion.question + '</h2>'
                    appendItem += '            <div class="clearfix"></div>'
                    appendItem += '        </div>'

                    $.each(criterion.answers, ( answerIndex, answer ) => {
                        appendItem += '        <div class="item form-group">'
                        appendItem += '            <div class="col-md-4 col-sm-6 col-xs-8 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">'
                        appendItem += '                <label class="control-label col-md-4 col-sm-4 col-xs-4">' + answer.name + ' <span class="text-danger">*</span></label>'
                        appendItem += '                <div class="col-md-6 col-sm-6 col-xs-6">'
                        appendItem += '                    <input disabled data-type="option" data-scope="' + scope.id + '" data-criteria="' + criterion.id + '" data-option="' + answer.name +'"'
                        appendItem += '                           type="number" min="0" max="10" maxlength="2" required value="' + parseInt(answer.value) + '" class="form-control required-answer" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">'
                        appendItem += '                </div>'
                        appendItem += '            </div>'
                        appendItem += '        </div>'
                    })
                })

                appendItem += '        </div>'
                appendItem += '    </div>'
                appendItem += '</div>'
            })

            wrapper.append(appendItem)

            // Initiliaze accordion expand and collapse actions
            $('.template-accordion').on('click', (e) => {
                $(e.currentTarget).find('i').each((index, element) => {
                    $(element).hasClass('hidden') ? $(element).removeClass('hidden') : $(element).addClass('hidden')
                })
            })

            calculateTotalWeight()
        }

        loadTemplateInfo()
    })
</script>

@else
    @include('errors.403')
    @endpermission