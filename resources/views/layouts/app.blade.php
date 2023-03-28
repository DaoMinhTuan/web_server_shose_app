<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from seantheme.com/studio/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Mar 2023 05:07:30 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Studio | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/blueimp-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" />
    
    
</head>

<body>

    <div id="app" class="app">

        <div id="header" class="app-header">

            <div class="mobile-toggler">
                <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="brand">
                <div class="desktop-toggler">
                    <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </button>
                </div>
                <a href="#" class="brand-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" height="20" />
                </a>
            </div>


            <div class="menu">
                <form class="menu-search" method="POST" name="header_search_form">
                    <div class="menu-search-icon"><i class="fa fa-search"></i></div>
                    <div class="menu-search-input">
                        <input type="text" class="form-control" placeholder="Search menu..." />
                    </div>
                </form>
                <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-bell nav-icon"></i></div>
                        <div class="menu-label">3</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-notification">
                        <h6 class="dropdown-header text-dark mb-1">Notifications</h6>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <i class="fa fa-receipt fa-lg fa-fw text-success"></i>
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Your store has a new order for 2 items totaling $1,299.00</div>
                                <div class="time">just now</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <i class="far fa-user-circle fa-lg fa-fw text-muted"></i>
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">3 new customer account is created</div>
                                <div class="time">2 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <img src="{{ asset('assets/img/icon/android.svg') }}" alt="" width="26" />
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Your android application has been approved</div>
                                <div class="time">5 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <img src="{{ asset('assets/img/icon/paypal.svg') }}" alt="" width="26" />
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Paypal payment method has been enabled for your store</div>
                                <div class="time">10 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <div class="p-2 text-center mb-n1">
                            <a href="#" class="text-dark text-opacity-50 text-decoration-none">See all</a>
                        </div>
                    </div>
                </div>
                <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-img online">
                            <img src="{{ asset('assets/img/user/user.jpg') }}" alt=""
                                class="ms-100 mh-100 rounded-circle" />
                        </div>
                        <div class="menu-text"><span class="__cf_email__"
                                data-cfemail="">{{ Auth::user()->email ?? 'tài khoản người dùng' }}</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right me-lg-3">
                        <a class="dropdown-item d-flex align-items-center" href="profile.html">Edit Profile <i
                                class="fa fa-user-circle fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <a class="dropdown-item d-flex align-items-center" href="email_inbox.html">Inbox <i
                                class="fa fa-envelope fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <a class="dropdown-item d-flex align-items-center" href="calendar.html">Calendar <i
                                class="fa fa-calendar-alt fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <a class="dropdown-item d-flex align-items-center" href="settings.html">Setting <i
                                class="fa fa-wrench fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">Log Out <i
                                class="fa fa-toggle-off fa-fw ms-auto text-dark text-opacity-50"></i></a>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.slide_bar.slide_bar')

        @yield('content')


        <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>


        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i
                    class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="theme-orange"
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Orange" data-original-title=""
                            title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow"
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Yellow" data-original-title=""
                            title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-teal" data-theme="theme-teal" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Teal" data-original-title="" title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body"
                            data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-blue" data-theme=""
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Default" data-original-title=""
                            title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="theme-purple"
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Purple" data-original-title=""
                            title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo"
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Indigo" data-original-title=""
                            title="">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-gray-600" data-theme="theme-gray-600"
                            data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-container="body" data-bs-title="Gray" data-original-title=""
                            title="">&nbsp;</a></li>
                </ul>
                <hr class="mb-0" />
                <div class="row mt-10px pt-3px">
                    <div class="col-9 control-label text-dark fw-bold">
                        <div>Dark Mode <span class="badge bg-primary ms-1 position-relative py-4px px-6px"
                                style="top: -1px">NEW</span></div>
                        <div class="lh-14 fs-13px">
                            <small class="text-dark opacity-50">
                                Adjust the appearance to reduce glare and give your eyes a break.
                            </small>
                        </div>
                    </div>
                    <div class="col-3 d-flex">
                        <div class="form-check form-switch ms-auto mb-0 mt-2px">
                            <input type="checkbox" class="form-check-input" name="app-theme-dark-mode"
                                id="appThemeDarkMode" value="1" />
                            <label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
    </script>
    <script src="{{ asset('assets/js/vendor.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>


    <script src="{{ asset('assets/plugins/apexcharts/dist/apexcharts.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/demo/dashboard.demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-tmpl/js/tmpl.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-load-image/js/load-image.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js') }}"></script>
    <script src="{{ asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}" defer=""></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote-lite.min.js') }}"></script>
    <script  src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"></script>
    <script>
        $('#fileupload').fileupload({
          url: '--- your url here ---',
          dataType: 'json',
          sequentialUploads: true,
          done: function(e, data) {
            //console.log(data.result);
          }
        });
        $('#fileupload').on('fileuploadadd', function (e, data) {
          data.submit();
        });
      </script> --}}

      

<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px"></span>
			</td>
			<td>
				<p class="name mb-1">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td>
				<p class="size mb-2">Processing...</p>
				<div class="progress progress-sm mb-0 h-10px progress-striped active"><div class="progress-bar progress-bar-primary" style="min-width: 2em; width:0%;"></div></div>
			</td>
			<td nowrap>
				{% if (!i && !o.options.autoUpload) { %}
					<button class="btn btn-primary btn-sm d-block w-100 start" disabled>
						<span>Start</span>
					</button>
				{% } %}
				{% if (!i) { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel mt-2">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>


<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td nowrap>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-danger btn-sm btn-block delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<span>Delete</span>
					</button>
					<div class="form-check mt-2">
						<input type="checkbox" id="{%=file.deleteUrl%}" name="delete" value="1" class="form-check-input toggle" />
						<label for="{%=file.deleteUrl%}" class="form-check-label"></label>
					</div>
				{% } else { %}
					<button class="btn btn-default btn-sm d-block w-100 cancel">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>


<script src="assets/js/vendor.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/js/app.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>


<script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/moment/min/moment.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/bootstrap-slider/dist/bootstrap-slider.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/tag-it/js/tag-it.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-tmpl/js/tmpl.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-load-image/js/load-image.all.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/summernote/dist/summernote-lite.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/select-picker/dist/picker.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/plugins/%40highlightjs/cdn-assets/highlight.min.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/js/demo/highlightjs.demo.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>
<script src="assets/js/demo/form-plugins.demo.js" type="3d10fa42bb1888bfad37ca38-text/javascript"></script>

<script src="../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="3d10fa42bb1888bfad37ca38-|49" defer=""></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7a5b6e03cad3e692","version":"2023.2.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}' crossorigin="anonymous"></script>


</body>

<!-- Mirrored from seantheme.com/studio/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Mar 2023 05:07:31 GMT -->

</html>
