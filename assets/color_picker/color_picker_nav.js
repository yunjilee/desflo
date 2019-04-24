<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/color_picker/bootstrap-colorpicker-v3.1.1-dist/js/bootstrap-colorpicker.js"></script>
<script>
  $(function () {
    $('.mini-color').colorpicker(); // instantiation

    $('.mini-color').on('colorpickerChange', function(event) {
      var $color = event.color.toString();
      $('.mini-color').css('background-color', $color);
      $('.mini-color').css('color', $color);
      $('.mini-color').val($color);
    });
  });

  function setColor($color) {
    $('.mini-color').css('background-color', $color);
    $('.mini-color').css('color', $color);
    $('.mini-color').val($color);
  }
</script>

<?php
  // Init to searched color
  if(isset($color_hashed) && !empty($color_hashed)) {
    echo "<script> setColor('" . $color_hashed . "'); </script>";
  }
?>
