var tables = [];
var cont = 0;

$(document).ready(function(){

    $("input[name='check_tables']").click(function(){
        /*
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
        }*/
        if ($(this).is(":checked")){
            cont++;
            if($(this).val()=="todos"){
                for (i = 0; i <= $("input[name='check_tables']").length; i++){
                    $("input[name='check_tables']").prop("disabled",true);
                    $("input[name='check_tables']").prop("checked",false);
                    $(this).prop("disabled",false);
                    $(this).prop("checked",true);
                    tables= [];
                    cont = 1;
                }
            }
            if (cont > 0){ $("#exportar").prop("disabled",false);}
            tables.push($(this).val());
            //alert(tables);
        }else{
            cont --;
            if($(this).val()=="todos"){
                for (i = 0; i <= $("input[name='check_tables']").length; i++){
                    $("input[name='check_tables']").prop("disabled",false);   
                }
            }
            for (i = 0; i < tables.length; i++){
                if (tables[i] == $(this).val()){tables.splice(i,1)}
            }
            if (cont == 0){$("#exportar").prop("disabled",true);}
        }
    });
    
    $("#exportar").click(function(){
        if($("#tablas_export").val() != "todos"){
            
            var tablesJson = JSON.stringify(tables);

            $("#tablas_export").val(tablesJson);
        }else{
            $("#tablas_export").val("todos");
        }

        $(function(){
            $("#modal_export").modal('toggle');
        });
        cont = 0;
        tables = [];
        $("input[name='check_tables']").prop("disabled",false);
        $("input[name='check_tables']").prop("checked",false);
    });
});