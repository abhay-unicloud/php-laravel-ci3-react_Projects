
<h2>Excel Reader</h2>
    <?php if (isset($error) && $error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <div class="container " id="inputs">
    <form method="post" class="form-group" enctype="multipart/form-data" action="<?php echo base_url('excel_ctrl/readExcel'); ?>">
        <label for="excel_file">Choose Excel File:</label>
        <input type="file" name="excel_file" class="form-control" id="excel_file" accept=".xlsx, .xls">
        <br>
        <button type="Submit" class="btn btn-primary" >Read Excel</button>
    </form>
    </div>

