<?php

$alert = '';

if(isset($_GET['action']) && isset($_GET['entity']) ){

  $alert = ucwords($_GET['entity']).' successfully '.$_GET['action'] ;

}

if(!empty($alert)){ ?>
    <div style="text-align: center;">
      <span class="customAlert" onClick="$(this).parent().fadeOut()">
        <?php echo $alert ; ?>. &nbsp;&nbsp;&nbsp;x
      </span>
  </div>
<?php }
