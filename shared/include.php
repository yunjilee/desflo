<?php
  function validGetAttr($attr) {
    if ( isset($_GET[$attr]) && !empty($_GET[$attr]) ) {
    	return true;
    }
  }
  function validPostAttr($attr) {
    if ( isset($_POST[$attr]) && !empty($_POST[$attr]) ) {
    	return true;
    }
  }
  function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
  }
?>
<script src="//code.jquery.com/jquery-3.3.1.js"></script>
