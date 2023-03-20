@permission('plan.link.links.plans.plans_management')
<div class="page-title">
    <div class="title_left">
        <h3>
            <i id="backButton" role="button" page="1" class="btn btn-default glyphicon glyphicon-arrow-left mb-0" data-toggle="tooltip" data-placement="top"
               data-original-title={{ trans('app.labels.backward') }}>
            </i>{{ trans('plans.labels.link') }}
            <small>{{ trans('app.labels.administration') }}</small>
        </h3>
    </div>

    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">

            @permission('index.plans.plans_management')
            <li>
                <a href="{{ route('index.plans.plans_management') }}" class="ajaxify"> {{ trans('plans.title') }}</a>
            </li>
            @endpermission

            <li class="active"> {{ trans('app.labels.edit') }}</li>
        </ol>
    </div>
</div>

<div class="x_panel main-container col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15">
    <div class="plan_selected_container">
        <div id="plan_selected" class="x_title dashboard-title">
            <h2>{{ $plan->name }}</h2>

            <div class="clearfix"></div>
        </div>
    </div>
    <div id="plan_info" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">

    </div>
    <div id="hidden_plan">
        <div class="mb-3">{{ trans('plans.messages.info.selectGoal') }}</div>
        <div id="plan"></div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelIndex" href="{{ route('index.plans.plans_management') }}"
       class="btn btn-info ajaxify">
        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
    </a>
    <a id="cancelLinks" href="{{ route('plan.link.links.plans.plans_management', [ 'id' => $plan->id ]) }}"
       class="btn btn-info ajaxify">
        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
    </a>
    <a id="showLinks" href="{{ route('showplanlinks.plan.link.links.plans.plans_management', ['id' => $plan->id]) }}"
       class="btn btn-primary ajaxify">
        <i class="glyphicon glyphicon-eye-open"></i> {{ trans('links.labels.showLinks') }}
    </a>
    <button id="submitBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
    <button id="previewBtn" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('app.labels.preview') }}</button>
    <button id="removeLinksBtn" class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('links.labels.removeLinks') }}</button>
</footer>
<script>
    $(() => {
        $('#plan_info').hide()
        $('#backButton').hide()
        $('#submitBtn').hide()
        $('#previewBtn').hide()
        $('#cancelLinks').hide()
        $('#removeLinksBtn').hide()

        $('#plan').tree({
            data: '{!! $json !!}',
            onTileSelected: (event, element) => {

                pushRequest('{!! route('get_indicator_info.link.links.plans.plans_management') !!}', '#plan_info', () => {
                    $('#hidden_plan').slideUp()
                    $('#plan_info').slideDown()
                    $('#backButton').show()
                    $('#showLinks').hide()

                }, 'GET', {
                    '_token': '{{ csrf_token() }}',
                    'planType': element.attributes.plan_type,
                    'indicatorId': element.attributes.element_id,
                    'parentId': element.attributes.parent_id,
                    'childPlanName': '{{ $plan->name }}'
                });
            }
        });

        /**
         * Agrega evento para retroceder en las pantallas de articulación
         */
        $('#backButton').click(() => {
            if ($('#backButton').attr('page') == '1') {
                $('#submitBtn').hide()
                $('#backButton').hide()
                $('#previewBtn').hide()
                $('#showLinks').show()
                $('#removeLinksBtn').hide()

                $('#plan').find('li').each((index, element) => {
                    $(element).removeClass('treeview-item-selected')
                })
                $('#hidden_plan').slideDown()
                $('#plan_info').slideUp(400, () => {
                    $('#plan_info').empty();
                })

            } else {
                $('#submitBtn').hide()
                $('#previewBtn').hide()
                $('#removeLinksBtn').hide()

                $('#backButton').attr('page', 1)
                $('#plansSelector').slideDown()
                $('#loadLinks').slideUp()
            }
        })

        /**
         * Detecta scroll de la pantalla para fijar los elementos en la pantalla
         */
        $(window).scroll(() => {
            if ($('#info_panel').length || $('#plan_selected').length) {
                let scroll = $(window).scrollTop()
                if (scroll > 135) {
                    fixedInfoPanel()
                } else {
                    blockInfoPanel()
                }
            }
        })

        /**
         * Ajusta tamaño de los componentes cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            adjustWidth()
        })

        /**
         * Agrega los estilos necesarios para mantener los componentes de información fijos en la pantalla
         */
        const fixedInfoPanel = () => {
            adjustWidth()
            $('#plan_selected').addClass("fix-title")
            $('#info_panel').addClass("fix-info")
        }

        /**
         * Elimina los estilos de los componentes fijos en la pantalla
         */
        const blockInfoPanel = () => {
            adjustWidth()
            $('#plan_selected').removeClass("fix-title")
            $('#info_panel').removeClass("fix-info")
            $('.info_panel_container').removeAttr('style')
            $('.plan_selected_container').removeAttr('style')
        }

        /**
         * Ajusta alto y ancho de los elementos al cambiarse la posición a fixed
         */
        const adjustWidth = () => {
            if ($('#info_panel').length) {
                let width = $('#plan_info').width()
                let height = $('#info_panel').height()
                $('#info_panel').width(width - 36)
                $('.info_panel_container').height(height + 77)
                $('#plan_selected').width(width - 8)
            } else {
                let width = $('.main-container').width()
                let height = $('#plan_selected').height()
                $('.plan_selected_container').height(height + 15)
                $('#plan_selected').width(width - 8)
            }
        }
    });
</script>

@endpermission