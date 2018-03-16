(function($) {
    $(function( ) {

        $('.time-picker-group').each(function() {
            var time_start = $(this).find('.time-picker-start');
            var time_end= $(this).find('.time-picker-end');
            time_start.datetimepicker({
                format: 'LT'
            });
            time_end.datetimepicker({
                format: 'LT',
                useCurrent: false //Important! See issue #1075
            });
            time_start.on("dp.change", function(e){
                time_end.data("DateTimePicker").minDate(e.date);
            });
            time_end.on("dp.change", function(e){
                time_start.data("DateTimePicker").maxDate(e.date);
            });
        });

    });
}(jQuery));