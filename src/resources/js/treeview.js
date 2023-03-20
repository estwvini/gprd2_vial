/* Custom treeview  */

(function ($) {

    /**
     * Genera id para cada elemento del arbol
     *
     * @returns {string}
     */
    const generateId = () => {
        let text = ""
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"

        for (let i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length))

        return text
    }

    /**
     * Configuración por default del arbol
     *
     * @returns {{selectParents: boolean}}
     */
    const treeDefaults = () => {
        return {
            selectParents: false,
            onTileSelected: (event, element) => {
            },
            onTileUnselected: (event, element) => {
            }
        }
    }

    /**
     * Configuración por default de los elementos
     *
     * @returns {{element_id: string, actions: Array, status: {open: boolean}}}
     */
    const elementDefaults = () => {
        return {
            element_id: generateId(),
            actions: [],
            attributes: [],
            status: {
                open: false
            }
        }
    }

    $.fn.tree = function (params) {
        this.append(`<ul class="${'main-ul-tree-' + $(this).attr('id')} ul-tree"></ul>`)
        params = $.extend({}, treeDefaults(), params)

        generateList(`.${'main-ul-tree-' + $(this).attr('id')}`, 0, $.parseJSON(params.data.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t")), params)

        addTreeEvents()
        addCustomTooltips()

        return this;
    };

    /**
     * Genera la lista de elementos y sus acciones
     *
     * @param container
     * @param indentation
     * @param data
     * @param treeElement
     * @param params
     * @param parent
     */
    const generateList = (container, indentation, data = [], params, parent = null) => {

        if (data.length) {
            data.forEach((element) => {

                element = $.extend({}, elementDefaults(), element)

                $(container).append(addLi(element, parent, indentation))
                addActionEvents(element, params.selectParents)
                addTileEvents(element, params)
                generateList(container, indentation + 1, element.children, params, element)
            })
        }
    }

    /**
     * Agrega elementos al arbol a partir de la información enviada
     *
     * @param element
     * @param parent
     * @param indentation
     * @returns {string}
     */
    const addLi = (element, parent, indentation) => {
        let spans = ''

        if (element.children && element.children.length) {
            if (element.status.open) {
                spans += `<span role="button" class="treeview-buttons collapse-button glyphicon glyphicon-minus tab-${indentation}"></span>`
                spans += `<span role="button" style="display:none" class="treeview-buttons expand-button glyphicon glyphicon-plus tab-${indentation}"></span>`
            } else {
                spans += `<span role="button" style="display:none" class="treeview-buttons collapse-button glyphicon glyphicon-minus tab-${indentation}"></span>`
                spans += `<span role="button" class="treeview-buttons expand-button glyphicon glyphicon-plus tab-${indentation}"></span>`
            }
        } else {
            spans += `<span role="button" class="treeview-buttons tab-${indentation}"></span>`
        }

        let actions = ''
        let tile_width = 'col-lg-10 col-md-10 col-sm-10 col-xs-10';

        if (element.actions.length) {
            element.actions.forEach((action) => {

                if (element.id && action.action) {
                    let actionId = element.element_id + element.id + action.action

                    actions += `<a id="${actionId}" class="mr-2 pull-right treeview-action" role="button" data-toggle="tooltip" data-placement="top" data-original-title="${action.tooltip}">
                                    <i class="${action.icon}"></i>
                                </a>`
                }
            })
        } else {
            tile_width = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }

        return `<li id="${element.element_id}" parent-id="${(parent && parent.element_id) ? parent.element_id : 0}" class="tree-item row ${element.selectable ? `treeview-selectable` : ``}" ${element.selectable ? `role="button"` : ``}
            style="${(parent && !parent.status.open) ? 'display:none' : ''}">
                <div class="${tile_width} p-0 cut-text tree-item-tooltip" ${(element.tooltip) ? `data-toggle="tooltip" data-placement="top" data-original-title="${element.tooltip}"` : ``}>
                    ${spans}
                    ${element.icon ? `<i class="warn-icon ${element.icon.class || ''} mr-2"  ${element.icon.tooltip ? `data-toggle="tooltip" data-placement="top" data-original-title="${element.icon.tooltip || ''}` : ``}"></i>` : ``}<span class="p-0" >${element.text}</span>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-0">${actions}</div>
            </li>`

    };

    /**
     * Contrae elementos seleccionados del arbol
     *
     * @param parentId
     */
    const closeChildren = (parentId) => {
        $('[parent-id=' + parentId + ']').each((index, element) => {
            $(element).slideUp()

            $(element).children().children('.collapse-button').hide()
            $(element).children().children('.expand-button').show()

            closeChildren($(element).attr('id'))
        })
    }

    /**
     * Expande elementos seleccionados del arbol
     *
     * @param parentId
     */
    const openChildren = (parentId) => {
        $('[parent-id=' + parentId + ']').each((index, element) => {
            $(element).slideDown()
        })
    }

    /**
     * Agrega evento para expandir arbol
     *
     * @param target
     */
    const addExpandAction = (target) => {
        $(target).click((e) => {
            $(e.target).hide()
            $(e.target).parent().find('.collapse-button').show()
            const li = $(e.target).parent().parent('li')
            openChildren($(li).attr('id'))
        })
    }

    /**
     * Agrega evento para contraer arbol
     *
     * @param target
     */
    const addCollapseAction = (target) => {
        $(target).click((e) => {
            $(e.target).hide()
            $(e.target).parent().find('.expand-button').show()
            const li = $(e.target).parent().parent('li')
            closeChildren($(li).attr('id'))
        })
    }

    /**
     * Agrega acciones para contraer y expandir elementos del arbol
     */
    const addTreeEvents = () => {
        addCollapseAction($('.collapse-button'))
        addExpandAction($('.expand-button'))
    }

    /**
     * Agrega eventos a las acciones de cada elemento
     *
     * @param element
     * @param treeElement
     * @param selectParents
     */
    const addActionEvents = (element, selectParents = false) => {

        if (element.actions.length) {
            element.actions.forEach((action) => {

                if (element.id && action.action) {
                    let actionId = element.element_id + element.id + action.action
                    $('#' + actionId).click((e) => {
                        e.preventDefault();

                        if (action.clickAction) {
                            eval(action.clickAction)
                        }

                        const li = $(e.target).parent().parent()

                        if (selectParents) {
                            unselectTiles()
                            selectTiles(li)
                        }

                        if (action.confirm) {
                            confirmModal(action.confirm, function () {
                                pushRequest(action.url, action.target || null, function () {
                                    if (action.postAction) {
                                        eval(action.postAction)
                                    }
                                    if (action.reload && action.reload.url && action.reload.target) {
                                        pushRequest(action.reload.url, action.reload.target, function () {
                                        }, action.reload.method || 'GET', {'_token': action.token}, false);
                                    }
                                }, action.method || 'GET', {'_token': action.token || null}, false);
                            });
                        } else if (action.justify) {

                            let callback = (data, options) => {
                                pushRequest(action.url, action.target || null, function () {
                                    if (action.postAction) {
                                        eval(action.postAction)
                                    }
                                    if (action.reload && action.reload.url && action.reload.target) {
                                        pushRequest(action.reload.url, action.reload.target, function () {
                                        }, action.reload.method || 'GET', {'_token': action.token}, false);
                                    }
                                }, action.method || 'POST', data, false, options);
                            };

                            justificationModalMultiple(callback, {'_token': action.token}, action.message, action.description)

                        } else {
                            pushRequest(action.url, action.target || null, function () {

                            }, action.method || 'GET', {'_token': action.token || null}, false);
                        }
                    })
                }
            })
        }
    }
    /**
     * Agrega eventos para selección de nodos
     *
     * @param element
     * @param params
     */
    const addTileEvents = (element, params) => {
        if (element.selectable) {
            $("#" + element.element_id).click((e) => {
                if ($(e.currentTarget).hasClass('treeview-item-selected')) {
                    $(e.currentTarget).removeClass('treeview-item-selected')
                    params.onTileUnselected(e, element);
                } else {
                    $(e.currentTarget).addClass('treeview-item-selected')
                    params.onTileSelected(e, element);
                }
            })

            if (element.status.selected) {
                $("#" + element.element_id).addClass('treeview-item-selected')
            }
        }


    }

    /**
     * Agrega clases de selección a los elementos padre
     */
    const selectTiles = li => {
        $(li).addClass('treeview-item-selected')
        $(li).find('i').each((index, element) => {
            $(element).addClass('treeview-action-item-selected')
        })

        let parentId = $(li).attr('parent-id')

        if (parentId != '0') {
            selectTiles($(`#${parentId}`))
        }
    }

    /**
     * Elimina clases de selección en los elementos seleccionados
     */
    const unselectTiles = () => {
        $('li').each((index, element) => {
            $(element).removeClass('treeview-item-selected')
        })
        $('i').each((index, element) => {
            $(element).removeClass('treeview-action-item-selected')
        })
    }

    /**
     * Agrega tooltips dependiento del número de caracteres
     */
    const addCustomTooltips = () => {
        $('.tree-item-tooltip[data-toggle="tooltip"]').each((index, element) => {

            let title = $(element).attr('data-original-title')

            let size = 'tooltip-100'

            if (title.length <= 100) {
                size = 'tooltip-400'
            } else if (title.length > 100) {
                size = 'tooltip-700'
            }

            $(element).tooltip(
                {
                    placement: 'top',
                    template: `<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-head"></div><div class="tooltip-inner ${size}"></div></div>`
                });
        })

        $('.warn-icon').each((index, element) => {
            $(element).hover((e) => {
                $('#' + $(e.target).parent('div').attr('aria-describedby')).remove();
            })
        })

    }

})(jQuery);