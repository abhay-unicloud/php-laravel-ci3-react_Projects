<?php
$mydata = $this->session->userdata('imported');
?>

<style>
    .content {
        padding-top: 20px; 
        padding-bottom: 20px; 
    }
</style>

<div class="content">
    <div class="container">
        <h2>Our Data From File</h2>
        <?php if ($mydata): ?>
            <h3>Imported Data:</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <!-- Displaying heading -->
                    <?php $heading = array_shift($mydata); ?>
                    <thead>
                        <tr>
                            <?php foreach ($heading as $values): ?>
                                <th scope="col"><?php echo htmlspecialchars($values) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mydata as $row): ?>
                            <tr>
                                <?php foreach ($row as $rowvalues): ?>
                                    <td><?php echo htmlspecialchars($rowvalues); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
      
            <button type="button" class="btn btn-primary" onclick="saveToDataBase()">Save To Database</button>
        <?php endif; ?>
    </div>
</div>


    <!-- Add Bootstrap JS and Popper.js -->
    <script>
         function saveToDataBase(){
            window.location.href="<?php echo base_url('import_ctrl/saveData'); ?>";
        }



    </script>
