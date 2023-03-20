@permission('load.plan.link.links.plans.plans_management')

<div class="x_title dashboard-title">
    <h2 class="align-center">{{ $plan->name }}</h2>

    <div class="clearfix"></div>
</div>

<div class="mb-5">
    <h5>{{ trans('links.messages.info.selectTargetGoals', [ 'plan' => $plan->name ]) }}</h5>
</div>

<div id="links"></div>

<script>
    $(() => {

        $('#submitBtn').show()
        $('#previewBtn').show()

        let parentIds = [{{ $parentLinks }}]
        $('#links').tree({
            data: '{!! $json !!}',
            onTileSelected: (event, element) => {
                parentIds.push(element.attributes.element_id)
            },
            onTileUnselected: (event, element) => {
                let index = parentIds.indexOf(element.attributes.element_id);

                if (index > -1) {
                    parentIds.splice(index, 1);
                }
            }
        });

        if (parentIds.length) {
            $('#removeLinksBtn').show()
        }

        $('#submitBtn').unbind("click");
        $('#previewBtn').unbind("click");
        $('#removeLinksBtn').unbind("click");

        $('#submitBtn').click(() => {
            if (parentIds.length) {
                pushRequest('{!! route('save.links.plans.plans_management') !!}', null, null, 'POST', {
                    '_token': '{{ csrf_token() }}',
                    'child_indicator': {{ $indicatorId }},
                    'parent_indicators': parentIds
                });
            } else {
                notify('{{ trans('links.messages.validation.selectGoals') }}', 'warning', '{{ trans('app.labels.warning') }}');
            }
        })

        $('#previewBtn').click(() => {
            pushRequest('{!! route('preview.link.links.plans.plans_management') !!}', null, null, 'GET', {
                '_token': '{{ csrf_token() }}',
                'childIndicator': {{ $indicatorId }},
                'parentIndicators': parentIds,
                'objectiveId': {{ $objectiveId }},
                'childPlanName': '{{ $childPlanName }}'
            });
        })

        $('#removeLinksBtn').click(() => {
            confirmModal('{{ trans('links.messages.confirm.deleteLinks', ['plan' => $plan->name]) }}', () => {
                pushRequest('{!! route('destroy.links.plans.plans_management') !!}', null, null, 'DELETE', {
                    '_token': '{{ csrf_token() }}',
                    'childIndicator': {{ $indicatorId }},
                    'targetPlan': {{ $plan->id }}
                });
            });
        })

    });
</script>

@endpermission