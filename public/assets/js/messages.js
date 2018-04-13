(function($){
    $(function( ){

        $('.messages-list-toggle').click(function(ev){
            ev.preventDefault();
            $(this).closest('.messages-container').toggleClass('open-list');
            return false;
        });
    });
}(jQuery));
