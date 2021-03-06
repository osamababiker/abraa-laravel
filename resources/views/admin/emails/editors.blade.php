@include('admin.layouts.header')


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
  <div class="wrapper">

    <!-- main sidebar here -->
    @include('admin.layouts.sidebar')

    <div class="main">

      <!-- main nav here -->
      @include('admin.layouts.nav')

      <main class="content">
        <div class="container-fluid p-0">


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <form action="">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title"><i class="fa fa-envelope"></i> Send new message</h5>
                      </div>
                      <div class="card-body">
                        <div class="clearfix">
                          <div id="quill-toolbar">
                            <form action="" method="post">
                              <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                              </span>
                              <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select> 
                              </span>
                              <span class="ql-formats">
                                <button class="ql-script" value="sub"></button>
                                <button class="ql-script" value="super"></button>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                              </span>
                              <span class="ql-formats">
                                <button class="ql-clean"></button>
                              </span>
                            </div>
                            <div class="quill-editor"></div>
                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                          </form>
                        </div>
                      </div> 
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </main>

      <!-- footer is here -->
      @include('admin.layouts.footer')