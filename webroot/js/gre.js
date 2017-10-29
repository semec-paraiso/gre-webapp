
/**
 * Configurações da linguagem português do plugin Bootstrap Datepicker
 * 
 */
$.fn.datepicker.dates['pt'] = {
    format: 'dd/mm/yyyy',
    days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
    daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
    daysMin: ["D", "S", "T", "Q", "Q", "S", "S"],
    months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
    today: "Hoje",
    clear: "Limpar",
};

$(document).ready(function(){
    
    // Datepicker plugin
    $('input[plugin="datepicker"]').datepicker({
        'language': 'pt',
    });
    
    // Inputmask plugin
    $('input[mask="date"]').inputmask('99/99/9999');
});
