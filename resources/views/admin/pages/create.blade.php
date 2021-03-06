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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New page </h1>

                    @if ($errors->any())
                        <div class="alert alert-danger pt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" id="add_page_form" action="{{ route('pages.store') }}">
                                        @csrf
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group required">
                                                <label for="ar_title"> Title (Ar)</label>
                                                <input type="text" required name="ar_title" id="ar_title"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group required">
                                                <label for="en_title"> Title (En)</label>
                                                <input type="text" required name="en_title" id="en_title"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="cn_title">Title (Cn)</label>
                                                <input type="text" name="cn_title" id="cn_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ru_title"> Title (Ru)</label>
                                                <input type="text" name="ru_title" id="ru_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="tr_title">Title (Tr)</label>
                                                <input type="text" name="tr_title" id="tr_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="pr_title"> Title (Pr)</label>
                                                <input type="text" name="pr_title" id="pr_title" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="col-md-2 form-group required">
                                                <label for="ar_visits"> Visits For (Ar)</label>
                                                <input type="number" required name="ar_visits" id="ar_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group required">
                                                <label for="en_visits"> Visits For (En)</label>
                                                <input type="number" required name="en_visits" id="en_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="cn_visits"> Visits For (Cn)</label>
                                                <input type="number" name="cn_visits" id="cn_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="ru_visits"> Visits For (Ru)</label>
                                                <input type="number" name="ru_visits" id="ru_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="tr_visits">Visits For (Tr)</label>
                                                <input type="number" name="tr_visits" id="tr_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="pr_visits"> Visits For (Pr)</label>
                                                <input type="number" name="pr_visits" id="pr_visits"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group required">
                                                <label for="ar-editor">Content (Ar)</label>
                                                <div class="clearfix">
                                                    <div id="ar-toolbar">
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
                                                    <div id="ar-editor"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group required">
                                            <label for="en-editor">Content (En)</label>
                                            <div class="clearfix">
                                                <div id="en-toolbar">
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
                                                <div id="en-editor"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="cn-editor">Content (Cn)</label>
                                            <div class="clearfix">
                                                <div id="cn-toolbar">
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
                                                <div id="cn-editor"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="ru-editor">Content (Ru)</label>
                                            <div class="clearfix">
                                                <div id="ru-toolbar">
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
                                                <div id="ru-editor"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="tr-editor">Content (Tr)</label>
                                            <div class="clearfix">
                                                <div id="tr-toolbar">
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
                                                <div id="tr-editor"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="pr-editor">Content (Pr)</label>
                                            <div class="clearfix">
                                                <div id="pr-toolbar">
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
                                                <div id="pr-editor"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="slug">Slug</label>
                                                <input type="text" class="form-control" name="slug" id="slug">
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" id="meta_title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="sub_of">Type</label>
                                                <input type="text" class="form-control" name="sub_of" id="sub_of">
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="sort_id">Sort</label>
                                                <input type="text" class="form-control" name="sort_id" id="sort_id">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="8"></textarea>
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_keyword">Meta Keyword</label>
                                                <textarea class="form-control" name="meta_keyword" id="meta_keyword" cols="30" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="button" id="add_page_btn" class="btn btn-success">Save Page</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('pages.index') }}" type="button"
                                                class="btn btn-primary">Go Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @if(session()->has('feedback'))
    @include('admin.layouts.feedback')
    @endif
    @include('admin.layouts.scripts')
    <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
    <script src="{{ asset('js/add_page.js') }}"></script>
    <!-- footer is here -->
    @include('admin.layouts.footer')