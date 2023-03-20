<!--
Layout for Datatables actions. The usage of each variable will be:

1. $actions. For each $action:

Each action’s key, will represent the icon ($icon) of the button. Use Font Awesome icons.

$action[‘route’] : (Mandatory) defines the URL that will be called when user clicks the button.
$action[‘method’]: (Optional) If not sent, the default will be GET.
$action[‘confirm_message’] : (Optional) If sent, a confirmation modal will be raised with the sent message.
$action[‘tooltip’]: (Optional) If sent, the button icon will have a tooltip.
$action[‘btn_class’]: (Optional) If sent, the link of the button will have a CSS class, to work with.
$action[‘post_action’]: (Optional) If sent, a Javascript callback can be sent to be executed after the Back-end sends a response. Example  ‘$(“#publish_vacants_tb”).DataTable().draw();’
$action['params']: (Optional) If sent, the route will send the specified params
$action['no_ajax']: (Optional) If sent, the route will be open in a new blank tab without ajax

2. $entity

The database object that represents the entity that will be manipulated with the current actions.


To hide the actions and show them on mouse hover, add an "actions" class on the very first div of this file.
-->

<div>
    @foreach($actions as $icon => $action)
        <a
            @if(isset($entity->gid))
                id="{{ explode('.',$action['route'])[0].$entity->gid . '-' . explode('.',$action['route'])[1].$entity->gid  }}" class="btn btn-xs @if(isset($action['btn_class'])) {{ $action['btn_class'] }} @else btn-primary @endif {{ explode('.',$action['route'])[0].$entity->gid . '-' . explode('.',$action['route'])[1].$entity->gid }}"
            @elseif(isset($entity->codigo))
                id="{{ explode('.',$action['route'])[0].$entity->codigo . '-' . explode('.',$action['route'])[1].$entity->codigo  }}" class="btn btn-xs @if(isset($action['btn_class'])) {{ $action['btn_class'] }} @else btn-primary @endif {{ explode('.',$action['route'])[0].$entity->codigo . '-' . explode('.',$action['route'])[1].$entity->codigo }}"
            @else
                id="{{ explode('.',$action['route'])[0].$entity->id . '-' . explode('.',$action['route'])[1].$entity->id }}" class="btn btn-xs @if(isset($action['btn_class'])) {{ $action['btn_class'] }} @else btn-primary @endif {{ explode('.',$action['route'])[0].$entity->id . '-' . explode('.',$action['route'])[1].$entity->id }}"
            @endif
            role="button" data-toggle="tooltip" data-placement="top" data-original-title="{{ $action['tooltip'] ?? '' }}"
            @isset($action['ajaxify']) data-ajaxify="{{ $action['ajaxify'] }}" @endisset
            @isset($action['no_ajax']) target="_blank"
                @if(isset($action['params']))
                    @if(isset($entity->gid))
                        url = '{!! route ($action['route'], array_merge($action['params'], ['gid' => $entity->gid] ) ) !!}';
                    @elseif(isset($entity->codigo))
                        url = '{!! route ($action['route'], array_merge($action['params'], ['codigo' => $entity->codigo] ) ) !!}';
                    @else
                        url = '{!! route ($action['route'], array_merge($action['params'], ['id' => $entity->id] ) ) !!}';
                    @endif
                @else
                    @if(isset($entity->gid))
                        href = '{!! route ($action['route'], ['gid' => $entity->gid] ) !!}';
                    @elseif(isset($entity->codigo))
                        href = '{!! route ($action['route'], ['codigo' => $entity->codigo] ) !!}';
                    @else
                        href = '{!! route ($action['route'], ['id' => $entity->id] ) !!}';
                    @endif
                @endif
            @endisset>
            <i class="fa fa-{{ $icon }}"></i>
        </a>

        @if(!isset($action['no_ajax']))
            <script>
                @if(isset($entity->gid))
                    let class_id = '{!! explode('.',$action['route'])[0].$entity->gid . '-' . explode('.',$action['route'])[1].$entity->gid !!}';
                @elseif(isset($entity->codigo))
                    let class_id = '{!! explode('.',$action['route'])[0].$entity->codigo . '-' . explode('.',$action['route'])[1].$entity->codigo !!}';
                @else
                    let class_id = '{!! explode('.',$action['route'])[0].$entity->id . '-' . explode('.',$action['route'])[1].$entity->id !!}';
                @endif
                $('.' + class_id).on('click', (e) => {
                    if (e.isDefaultPrevented()) {
                        return;
                    }
                    e.preventDefault();
                    $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
                    let url = "";
                    @if(isset($action['params']))
                        @if(isset($entity->gid))
                            url = '{!! route ($action['route'], array_merge($action['params'], ['gid' => $entity->gid] ) ) !!}';
                        @elseif(isset($entity->codigo))
                            url = '{!! route ($action['route'], array_merge($action['params'], ['codigo' => $entity->codigo] ) ) !!}';
                        @else
                            url = '{!! route ($action['route'], array_merge($action['params'], ['id' => $entity->id] ) ) !!}';
                        @endif
                    @else
                        @if(isset($entity->gid))
                            url = '{!! route ($action['route'], ['gid' => $entity->gid]) !!}';
                        @elseif(isset($entity->codigo))
                            url = '{!! route ($action['route'], ['codigo' => $entity->codigo]) !!}';
                        @else
                            url = '{!! route ($action['route'], ['id' => $entity->id]) !!}';
                        @endif
                    @endif
                    let method = '{!! isset($action['method']) ? $action['method'] : null !!}';
                    let data_ajaxify = '{!! isset($action['ajaxify']) ? $action['ajaxify'] : null !!}';
                    @if(isset($action['confirm_message']))
                        let confirmMessage = '{!! $action['confirm_message'] !!}';
                        confirmModal(confirmMessage, () => {
                            pushRequest(url, data_ajaxify, () => {
                                @if(isset($action['post_action']))
                                {!! $action['post_action'] !!}
                                @endif
                            }, method, {'_token': '{{ csrf_token() }}'}, {{ isset($action['scroll-top']) ? $action['scroll-top'] : null }});
                        });
                    @else
                        pushRequest(url, data_ajaxify, () => {
                            @if(isset($action['post_action']))
                            {!! $action['post_action'] !!}
                            @endif
                        }, method, {'_token': '{{ csrf_token() }}'}, {{ isset($action['scroll-top']) ? $action['scroll-top'] : null }} );
                    @endif
                });
            </script>
        @endif
    @endforeach
</div>