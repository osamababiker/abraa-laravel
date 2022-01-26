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

                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit page </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" id="edit_page_form" action="{{ route('pages.update') }}">
                                        @csrf
                                        <input type="hidden" id="page_id" name="page_id" value="{{ $page->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group required">
                                                <label for="ar_title"> Title (Ar)</label>
                                                <input type="text" value="{{ $page->ar_title }}" required name="ar_title" id="ar_title"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group required">
                                                <label for="en_title"> Title (En)</label>
                                                <input type="text" value="{{ $page->en_title }}" required name="en_title" id="en_title"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="cn_title">Title (Cn)</label>
                                                <input type="text" value="{{ $page->cn_title }}" name="cn_title" id="cn_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ru_title"> Title (Ru)</label>
                                                <input type="text" value="{{ $page->ru_title }}" name="ru_title" id="ru_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="tr_title">Title (Tr)</label>
                                                <input type="text" value="{{ $page->tr_title }}" name="tr_title" id="tr_title" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="pr_title"> Title (Pr)</label>
                                                <input type="text" value="{{ $page->pr_title }}" name="pr_title" id="pr_title" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="col-md-2 form-group required">
                                                <label for="ar_visits"> Visits For (Ar)</label>
                                                <input type="number" value="{{ $page->ar_visits }}" required name="ar_visits" id="ar_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group required">
                                                <label for="en_visits"> Visits For (En)</label>
                                                <input type="number" value="{{ $page->en_visits }}" required name="en_visits" id="en_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="cn_visits"> Visits For (Cn)</label>
                                                <input type="number" value="{{ $page->cn_visits }}" name="cn_visits" id="cn_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="ru_visits"> Visits For (Ru)</label>
                                                <input type="number" value="{{ $page->ru_visits }}" name="ru_visits" id="ru_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="tr_visits">Visits For (Tr)</label>
                                                <input type="number" value="{{ $page->tr_visits }}" name="tr_visits" id="tr_visits"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="pr_visits"> Visits For (Pr)</label>
                                                <input type="number" value="{{ $page->pr_visits }}" name="pr_visits" id="pr_visits"
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
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="slug">Slug</label>
                                                <input type="text" value="{{ $page->slug }}" class="form-control" name="slug" id="slug">
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" value="{{ $page->meta_title }}" class="form-control" name="meta_title" id="meta_title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="sub_of">Type</label>
                                                <input type="text" value="{{ $page->sub_of }}" class="form-control" name="sub_of" id="sub_of">
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="sort_id">Sort</label>
                                                <input type="text" value="{{ $page->sort_id }}" class="form-control" name="sort_id" id="sort_id">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="8">{{ $page->meta_description }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="meta_keyword">Meta Keyword</label>
                                                <textarea class="form-control" name="meta_keyword" id="meta_keyword" cols="30" rows="8">{{ $page->meta_keyword }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="button" id="edit_page_btn" class="btn btn-success">Save Changes</button>
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
    <script type="text/javascript">
        var csrf_token = "<?= csrf_token() ?>";
        var page_id = "{{ $page->id }}";
    </script>
    <script src="{{ asset('js/edit_page.js') }}"></script>
    <!-- footer is here -->
    @include('admin.layouts.footer')