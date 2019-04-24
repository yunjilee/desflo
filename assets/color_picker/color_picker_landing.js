<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/color_picker/bootstrap-colorpicker-v3.1.1-dist/js/bootstrap-colorpicker.js"></script>
<script>
  // var $default_color = '<?php echo DEFAULT_COLOR; ?>';

  $(function () {
    $('#color-id').colorpicker(); // instantiation

    $('#color-id').on('colorpickerChange', function(event) {
      var $color = event.color.toString();
      $('#color-id').css('background-color', $color);
      $('#color-id').css('color', $color);
      $('#color-id').val($color);
    });
  });
</script>
