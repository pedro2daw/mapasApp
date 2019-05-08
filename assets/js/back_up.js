
var table_selected;

$(document).ready(function(){

    $("input[name='check_tables']").change(function(){
        if ($(this).is(":checked")){
            table_selected = $(this).val();
            $("#exportar").prop("disabled",false);
            for (i = 0; i <= $("input[name='check_tables']").length; i++){
                
                $("input[name='check_tables']").prop("disabled",true);
                $(this).prop("disabled",false);
                
            }
        }else{
                $("input[name='check_tables']").prop("disabled",false);
                $("#exportar").prop("disabled",true);
        }
    });

    $("#exportar").click(function(){
        $(function(){
            $("#modal_export").modal('toggle');
        });
        $("input[name='check_tables']").prop("disabled",false);
        $("input[name='check_tables']").prop("checked",false);
        $("#tablas_export").val(table_selected);
    });
});