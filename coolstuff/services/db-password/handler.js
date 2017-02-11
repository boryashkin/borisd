var debug;
$(function(){
    $('form').submit(function(e){
        e.preventDefault();

        var $p_input = $(this).find('input[name="password"]');
        if (!$p_input.val()) {
            $p_input.css('border-color', 'red');
            return false;
        } else {
            $p_input.css('border-color', '');
        }

        $p_input.css('border-color', 'yellow');

        var fname = $(this).attr('name');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            complete: function(resp){
                var data = $.parseJSON(resp.responseText);

                for(var k in data) {
                    $('#' + fname + '-' + k).text(data[k]);
                    $('#' + fname + '-' + k).css('color', 'green');
                }

                $p_input.css('border-color', '');
            }
        });
        return true;
    });
});
