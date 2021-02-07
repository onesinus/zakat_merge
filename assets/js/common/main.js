$(window).ready(function() {
    setTimeout(() => {
        $('#loading').hide();
        $('#main').show();

        $('select').select2();

        $('select[multiple]').on('change', function(evt) {
            const totalSelected = $(this).select2('data').length;
            const idx = $(this).attr("idx");
            $("#TotalMustahik"+idx).val(totalSelected);
        });
        
        $(".chkall").click(function(){
            const idx = $(this).attr("idx")
            if($(this).is(':checked')){
                $('#Mustahik' + idx + ' > option').attr("selected", "selected");
                $('#Mustahik' + idx).trigger("change");
            } else {
                $('#Mustahik' + idx + ' > option').removeAttr("selected");
                $('#Mustahik' + idx).trigger("change");
            }
        });
    }, 500);    
});
