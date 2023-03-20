<div class="modal-content" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> {{ trans('reports.config.audit.details') }}</h4>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt>{{ trans('reports.config.audit.date') }}</dt>
                <dd>{{ \Carbon\Carbon::parse($entity->created_at)->format('d-m-Y H:i A') }}</dd>
                <dt>{{ trans('reports.config.audit.ip') }}</dt>
                <dd>{{ $entity->ip_address }}</dd>
                <dt>{{ trans('reports.config.audit.username') }}</dt>
                <dd>{{ $entity->user->username }}</dd>
                <dt>{{ trans('reports.config.audit.full_name') }}</dt>
                <dd>{{ $entity->user->fullName() }}</dd>
                <dt>{{ trans('reports.config.audit.action') }}</dt>
                <dd>{{ $entity->event }}</dd>
                <dt>{{ trans('reports.config.audit.table') }}</dt>
                <dd>{{ $entity->recordable()->getModel()->getTable() }}</dd>
                <dt>{{ trans('reports.config.audit.url') }}</dt>
                <dd>{{ $entity->url }}</dd>
                <dt>{{ trans('reports.config.audit.user_agent') }}</dt>
                <dd>{{ $entity->user_agent }}</dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="all"></div>
        </div>
        <div class="col-md-6">
            <div id="changes"></div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let editorAll = new JSONEditor(document.getElementById('all'), {
            history: true,
            mode: 'view',
            schema: {
                type: 'object',
                properties: {
                    'allowed': {
                        type: 'boolean'
                    },
                    'label': {
                        type: 'string'
                    },
                    'inner': {
                        type: 'object'
                    }
                }
            }
        });

        editorAll.set({!! json_encode($details[0]) !!});

        let editorChanges = new JSONEditor(document.getElementById('changes'), {
            history: true,
            mode: 'view',
            schema: {
                type: 'object',
                properties: {
                    'allowed': {
                        type: 'boolean'
                    },
                    'label': {
                        type: 'string'
                    },
                    'inner': {
                        type: 'object'
                    }
                }
            }
        });

        editorChanges.set({!! json_encode($details[1]) !!});
    });
</script>