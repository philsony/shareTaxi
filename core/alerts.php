<?php

$alert = '';

if(isset($_GET['action']) && isset($_GET['entity']) ){

  $alert = $_GET['entity'].' successfully '.$_GET['action'] ;

}

if(!empty($alert)){ ?>
      <div class="customAlert">
         <p>
           <?php echo $alert ; ?>
        </p>
      </div>
<?php }
