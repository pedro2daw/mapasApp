<script>

    $(document).ready(function(){
        
        $('#upload_file').on('click',function(e){
        var csv_file = $("#csv_file").val();
        var formData = {
                'csv' : csv_file
            };

            $.ajax({
                type     : "POST",
                cache    : false,
                url      : "<?php echo base_url(); ?>index.php/Csv/upload_file",
                data     : formData,
                dataType : 'json',
                encode : true
                })
                .done(function(data) {
                    
                    console.log(data);
                    
                });

        e.preventDefault();
        });
    });
        
            
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12"> 
            <?php
            echo form_open('Csv/upload_file',"");
            echo "<input type='file' id='csv_file' name='csv'>";
            echo form_submit('submit', 'Aplicar cambios',"id='upload_file' class='btn btn-primary'");
            echo form_close();
            ?>
        </div>
    </div>
</div> <!-- fin container fluid -->




