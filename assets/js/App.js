$(document).ready(function(){ 	
    var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
    })();
    
    $('#vendorcode').keyup(function() {

        $.get('/requests/delete', function(res) {
            $('#request').html(res);
        });

        if ($(this).val().length == 0) {
            $('#description').hide();
        } else {
          $('#description').show();
        }
        
    }).keyup();

    $.get('/requests/index_html', function(res) {
          $('tbody.item').html(res);
    });

    $('form.search').submit(function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('tbody.item').html(res);
        });
        return false;
    });

    $(document).on('keyup', 'form.search input', function(){
        var form = $(this).parent();
        delay(function(){
            $(form).submit();
        }, 100 );
    });

    
    $.get('/requests/to_request', function(res) {
        $('#request').html(res);
    });

    $(document).on('submit', 'form.requested_item', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('#request').html(res);
        });
        return false;
    });

    var delayqty = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
    })();

    $(document).on('submit', 'form.input_qty', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('#request').html(res);
        });
        return false;
    });

    $(document).on('change', 'form.input_qty input.editqty', function(){
        var form = $(this).parent();
        delayqty(function(){
            $(form).submit();
            
            return false;
        }, 1000 );
    });

    $(document).on('submit', 'form.inlide_del', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('#request').html(res);
        });
        return false;
    });
    
});