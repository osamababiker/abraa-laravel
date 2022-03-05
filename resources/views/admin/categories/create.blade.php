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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Category </h1>

                    
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
                                    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 required form-group">
                                                <label for="sub_of">Category Parent</label>
                                                <select required name="sub_of" id="sub_of" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="$category->id">{{ $category->en_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="slug">Category Slug</label>
                                                <input type="text" required name="slug" class="form-control" id="slug">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="ar_title">Title (AR)</label>
                                                <input type="text" required name="ar_title" class="form-control" id="ar_title">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="en_title">Title (EN)</label>
                                                <input type="text" required name="en_title" class="form-control" id="en_title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="cn_title">Title (CN)</label>
                                                <input type="text" name="cn_title" class="form-control" id="cn_title">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ru_title">Title (RU)</label>
                                                <input type="text" name="ru_title" class="form-control" id="ru_title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="tr_title">Title (TR)</label>
                                                <input type="text" name="tr_title" class="form-control" id="tr_title">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="pr_title">Title (PR)</label>
                                                <input type="text" name="pr_title" class="form-control" id="pr_title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 required form-group">
                                                <label for="ar_description">Category Description (AR)</label>
                                                <textarea required name="ar_description" id="ar_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 required form-group">
                                                <label for="en_description">Category Description (EN)</label>
                                                <textarea required name="en_description" id="en_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="cn_description">Category Description (CN)</label>
                                                <textarea name="cn_description" id="cn_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="ru_description">Category Description (RU)</label>
                                                <textarea name="ru_description" id="ru_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="tr_description">Category Description (TR)</label>
                                                <textarea name="tr_description" id="tr_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="pr_description">Category Description (PR)</label>
                                                <textarea name="pr_description" id="pr_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3 required form-group">
                                                <label for="sort_id">Sort ID</label>
                                                <input required type="number" class="form-control" name="sort_id" id="sort_id">
                                            </div>
                                            <div class="col-md-3 required form-group">
                                                <label for="sort_order">Sort Order</label>
                                                <input required type="number" class="form-control" name="sort_order" id="sort_order">
                                            </div>
                                            <div class="col-md-3 required form-group">
                                                <label for="status">Category Status</label>
                                                <select required name="status" id="status" class="form-control select2">
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 required form-group">
                                                <label for="is_home_thumb">Is Home Category</label>
                                                <select required name="is_home_thumb" id="is_home_thumb" class="form-control select2">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Category Icon</span> 
                                                    <input type="file" name="pic_url" id="category-icon-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                                <div id="category_icon_preview"></div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Category Banner</span> 
                                                    <input type="file" name="banner_url" id="category-banner-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                                <div id="category_banner_preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="top_desc_id">Top Desc Id</label>
                                                <input type="text" name="top_desc_id" id="top_desc_id" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="footer_desc_id">Footer Desc Id</label>
                                                <input type="text" name="footer_desc_id" id="footer_desc_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 required form-group">
                                                <label for="meta_title">Meta Title</label>
                                                <input required type="text" id="meta_title" name="meta_title" class="form-control">
                                            </div>
                                            <div class="col-md-12 required form-group">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <textarea required name="meta_keywords" id="meta_keywords" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 required form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea required name="meta_description" id="meta_description" cols="30" rows="8" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Category</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('categories.index') }}" type="button" class="btn btn-primary">Go Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/add_category.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
