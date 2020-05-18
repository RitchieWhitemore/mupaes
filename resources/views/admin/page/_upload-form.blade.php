<noscript
><input
        type="hidden"
        name="redirect"
        value="https://blueimp.github.io/jQuery-File-Upload/"
    /></noscript>
<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
<div class="row fileupload-buttonbar">
    <div class="col-lg-8 d-flex justify-content-between align-items-center mb-5">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button">
              <i class="fas fa-plus"></i>
              <span>Добавить файлы...</span>
              <input type="file" name="files[]" multiple id="fileupload"/>
            </span>
        <button type="submit" class="btn btn-primary start">
            <i class="fas fa-arrow-circle-up"></i>
            <span>Начать загрузку</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="fas fa-ban"></i>
            <span>Отменить загрузку</span>
        </button>
        <button type="button" class="btn btn-danger delete">
            <i class="fas fa-trash-alt"></i>
            <span>Удалить выбранные</span>
        </button>
        <input type="checkbox" class="toggle"/>
        <!-- The global file processing state -->
        <span class="fileupload-process"></span>
    </div>
    <!-- The global progress state -->
    <div class="col-lg-4 fileupload-progress fade">
        <!-- The global progress bar -->
        <div
            class="progress progress-striped active"
            role="progressbar"
            aria-valuemin="0"
            aria-valuemax="100"
        >
            <div
                class="progress-bar progress-bar-success"
                style="width: 0%;"
            ></div>
        </div>
        <!-- The extended global progress state -->
        <div class="progress-extended">&nbsp;</div>
    </div>
</div>
<!-- The table listing the files available for upload/download -->
<table role="presentation" class="table table-striped">
    <tbody class="files"></tbody>
</table>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                      <p class="name">{%=file.name%}</p>
                  {% } %}
                  <strong class="error text-danger"></strong>
              </td>
              <td>
                  <p class="size">Processing...</p>
                  <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
              </td>
              <td>
                  {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                    <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                        <i class="glyphicon glyphicon-edit"></i>
                        <span>Редактировать</span>
                    </button>
                  {% } %}
                  {% if (!i && !o.options.autoUpload) { %}
                      <button class="btn btn-primary start" disabled>
                          <i class="fas fa-arrow-circle-up"></i>
                          <span>Загрузить</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn btn-warning cancel">
                          <i class="fas fa-ban"></i>
                          <span>Отмена</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}


</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download fade">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                      <p class="name">
                          {% if (file.url) { %}
                              <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                          {% } else { %}
                              <span>{%=file.name%}</span>
                          {% } %}
                      </p>
                  {% } %}
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td class="d-flex justify-content-between align-items-center" style="width: 150px;">
                  {% if (file.deleteUrl) { %}
                      <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="fas fa-trash-alt"></i>
                          <span>Удалить</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn btn-warning cancel">
                          <i class="fas fa-ban"></i>
                          <span>Отмена</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}


</script>

@section('css')

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/admin/css/blueimp/jquery.fileupload.css"/>
    <link rel="stylesheet" href="/admin/css/blueimp/jquery.fileupload-ui.css"/>
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript
    >
        <link rel="stylesheet" href="/admin/css/blueimp/jquery.fileupload-noscript.css"
        />
    </noscript>
    <noscript
    >
        <link rel="stylesheet" href="/admin/css/blueimp/jquery.fileupload-ui-noscript.css"
        />
    </noscript>
@endsection

@section('js')
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/admin/js/blueimp/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="/admin/js/blueimp/tmpl.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="/admin/js/blueimp/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="/admin/js/blueimp/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    {{--<script src="js/jquery.blueimp-gallery.min.js"></script>--}}
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/admin/js/blueimp/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="/admin/js/blueimp/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    {{--<script src="js/demo.js"></script>--}}
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="/admin/js/blueimp/cors/jquery.xdr-transport.js"></script>
    <![endif]-->

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#fileupload').fileupload({
            url: "{{route('admin.page.upload', ['page' => $model])}}",
            dataType: 'json',
        })
            .on('fileuploaddestroy', function (e, data) {
                $('#fileupload').addClass('fileupload-processing');
            })
            .on('fileuploaddestroyed', function (e, data) {
                $('#fileupload').removeClass('fileupload-processing');
            })

        $('#fileupload').addClass('fileupload-processing');

        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: "{{route('admin.page.files', ['page' => $model])}}",
            dataType: 'json',
            context: $('#fileupload')[0]
        })
            .always(function () {
                $(this).removeClass('fileupload-processing');
            })
            .done(function (result) {
                $(this)
                    .fileupload('option', 'done')
                    // eslint-disable-next-line new-cap
                    .call(this, $.Event('done'), {result: result});
            });
    </script>

@stop
