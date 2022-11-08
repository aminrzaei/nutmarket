<script src="https://cdn.tiny.cloud/1/oql49tbhbnr3t8kpxfyd4rqscs6wkuta5m5ca5okijsvtzfq/tinymce/4/tinymce.min.js"
  referrerpolicy="origin"></script>
<script>
  tinymce.init({
      selector: '#my-textarea',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern',
      ],
      toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
      relative_urls: false,
      file_browser_callback: function(field_name, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
          file: '/file-manager/tinymce',
          title: 'File Manager',
          width: window.innerWidth * 0.8,
          height: window.innerHeight * 0.8,
          resizable: 'yes',
          close_previous: 'no',
        }, {
          setUrl: function(url) {
            win.document.getElementById(field_name).value = url;
          },
        });
      },
    });
</script>