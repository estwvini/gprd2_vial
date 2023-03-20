// Jquery validator custom methods
$.validator.addMethod('IP4Checker', function (value) {
    var ip = /^(?!0)(?!.*\.$)((1?\d?\d|25[0-5]|2[0-4]\d)(\.|$)){4}$/;
    return ip.test(value);
}, 'Por favor, escribe un ip v&aacute;lido.');

$.validator.addMethod("greaterThan", function (value, element, param) {
    return parseInt(value, 10) > parseInt($(param).val(), 10);
}, 'Por favor, ingrese un n&uacute;mero v&aacute;lido');

/* Locale datepicker */
var es_locale_datepicker = {
    "format": "DD-MM-YYYY",
    "separator": "-",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "Desde",
    "toLabel": "Hasta",
    "customRangeLabel": "Personalizado",
    "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
    ],
    "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ],
    "firstDay": 1
};

// get a random color
function randomColor() {

    var chars = '0123456789ABCDEF';
    var color = '#';

    for (var i = 0; i < 6; i++)
        color += chars[Math.floor(Math.random() * 16)];

    return color;
}

$jsgantt_es = {
    'january': 'Enero',
    'february': 'Febrero',
    'march': 'Marzo',
    'april': 'Abril',
    'maylong': 'Mayo',
    'june': 'Junio',
    'july': 'Julio',
    'august': 'Agosto',
    'september': 'Septiembre',
    'october': 'Octubre',
    'november': 'Noviembre',
    'december': 'Diciembre',
    'jan': 'Ene',
    'feb': 'Feb',
    'mar': 'Mar',
    'apr': 'Abr',
    'may': 'May',
    'jun': 'Jun',
    'jul': 'Jul',
    'aug': 'Ago',
    'sep': 'Sep',
    'oct': 'Oct',
    'nov': 'Nov',
    'dec': 'Dic',
    'sunday': 'Domingo',
    'monday': 'Lunes',
    'tuesday': 'Martes',
    'wednesday': 'Miércoles',
    'thursday': 'Jueves',
    'friday': 'Viernes',
    'saturday': 'Sábado',
    'sun': '	Dom',
    'mon': '	Lun',
    'tue': '	Mar',
    'wed': '	Mie',
    'thu': '	Jue',
    'fri': '	Vie',
    'sat': '	Sab',
    'resource': 'Responsable',
    'duration': 'Duración',
    'comp': '% Completado',
    'completion': 'Terminado',
    'startdate': 'Inicio',
    'planstartdate': 'Inicio Plan',
    'cost': 'Custo',
    'enddate': 'Fin',
    'planenddate': 'Plan Fin',
    'moreinfo': '+información',
    'notes': 'Notas',
    'format': 'Formato',
    'hour': 'Hora',
    'day': 'Dia',
    'week': 'Semana',
    'month': 'Mes',
    'quarter': 'Trimestre',
    'hours': 'Horas',
    'days': 'Días',
    'weeks': 'Semanas',
    'months': 'Meses',
    'quarters': 'Trimestres',
    'hr': 'Hr',
    'dy': 'Día',
    'wk': 'Sem',
    'mth': 'Mes',
    'qtr': 'Trim',
    'hrs': 'Hrs',
    'dys': 'Dias',
    'wks': 'Sems',
    'mths': 'Meses',
    'qtrs': 'Trims'
};

