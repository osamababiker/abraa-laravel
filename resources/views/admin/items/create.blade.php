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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Item </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('items.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="form-group col-md-6">
                                                <label for="title">Item Name</label>
                                                <input type="text" name="title" class="form-control" id="title">
                                            </div>
                                            <div class="form-group col-md-6 autocomplete-supplier">
                                                <label for="user_id">Search For User</label>
                                                <input type="hidden" name="user_id" id="user_id">
                                                <input type="text" name="search_supplier" class="form-control" id="search_supplier">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sub_of">Category</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($categories as $category) 
                                                        <option value="{{ $category->id }}">{{ $category->en_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="unit">Select Unit</label>
                                                <select name="unit" id="unit" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($units as $unit) 
                                                        <option value="{{ $unit->id }}">{{ $unit->unit_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="details">Item Details</label>
                                                <textarea name="details" cols="6" rows="6" class="form-control" id="primary_name"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="price">Item Price</label>
                                                <input type="number" name="price" class="form-control" id="price">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="old_price">Item old Price</label>
                                                <input type="number" name="old_price" class="form-control" id="old_price">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="youtube_video">Youtube Video</label>
                                                <input type="string" name="youtube_video" class="form-control" id="youtube_video">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="deliver_per">Deliver Per ?</label>
                                                <input type="number" name="deliver_per" placeholder="1 = week, 2 = month, 3 = year, 4 = one time" class="form-control" id="deliver_per">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="item_type">Item Type</label>
                                                <select name="item_type" id="item_type" class="form-control select2">
                                                    <option value=""></option>
                                                    <option value="New">New</option>
                                                    <option value="Used">Used</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="quantity">Item Quantity</label>
                                                <input type="number" name="quantity" class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="manufacture_country">Manufacture Country</label>
                                                <select name="manufacture_country" id="manufacture_country" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->en_name }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="part_number">Part Number</label>
                                                <input type="number" name="part_number" class="form-control" id="part_number">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="active">Is Active</label>
                                                <select name="active" id="active" class="form-control select2">
                                                    <option value="1">Active Item</option>
                                                    <option value="0">Un Active Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Item Status</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1">Is Available</option>
                                                    <option value="0">Un available</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="rejected">Is Rejected</label>
                                                <select name="rejected" id="rejected" class="form-control select2">
                                                    <option value="1">Rejected Item</option>
                                                    <option value="0">Not rejected Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="is_sold">Item Sold</label>
                                                <select name="is_sold" id="is_sold" class="form-control select2">
                                                    <option value="1">Is sold</option>
                                                    <option value="0">Un sold</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="featured">Is Reatured</label>
                                                <select name="featured" id="featured" class="form-control select2">
                                                    <option value="1">Reatured Item</option>
                                                    <option value="0">Not Reatured Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="accept_offers">Item accept offers</label>
                                                <select name="accept_offers" id="accept_offers" class="form-control select2">
                                                    <option value="1">Accept Offers</option>
                                                    <option value="0">Not Accept Offers</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="accept_min_offer">Accept Min Offer</label>
                                                <input type="number" name="accept_min_offer" class="form-control" id="accept_min_offer">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sort_order">Sort Order</label>
                                                <input type="number" name="sort_order" class="form-control" id="sort_order">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="meta_keyword">Meta Keywords</label>
                                                <select name="meta_keyword[]" multiple="multiple" id="meta_keyword" class="form-control select2">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea name="meta_description" class="form-control" id="meta_description" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="phone_count">Phone Count</label>
                                                <input type="number" name="phone_count" class="form-control" id="phone_count">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email_count">Email Count</label>
                                                <input type="number" name="email_count" class="form-control" id="email_count">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="chat_count">Chat Count</label>
                                                <input type="number" name="chat_count" class="form-control" id="chat_count">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="min_order">Minimum Order</label>
                                                <input type="number" name="min_order" class="form-control" id="min_order">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="payment_option_ids">Payment Options</label>
                                                <select name="payment_option_ids[]" multiple="multiple" id="payment_option_ids" class="form-control select2">
                                                    @foreach($paymentOptions as $option)
                                                        <option value="{{ $option->id }}">{{ $option->method }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="default_image">Item Default Image</label>
                                                <input type="file" name="default_image" class="form-control" id="default_image">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="rating">Item Rating</label>
                                                <input type="number" name="rating" class="form-control" id="rating">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="currency">Item Currency</label>
                                                <select name="currency" id="currency" class="form-control select2">
                                                    @foreach($currencies as $currency)
                                                        <option value="{{ $currency->id }}">{{ $currency->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="approved">Is Approved</label>
                                                <select name="approved" id="approved" class="form-control select2">
                                                    <option value="1">Approved Item</option>
                                                    <option value="0">Not Approved Item</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="is_bulk">Is Bulk</label>
                                                <select name="is_bulk" id="is_bulk" class="form-control select2">
                                                    <option value="1">Bulk Item</option>
                                                    <option value="0">Not Bulk Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="is_global">Is Global</label>
                                                <select name="is_global" id="is_global" class="form-control select2">
                                                    <option value="1">Global Item</option>
                                                    <option value="0">Not Global Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="is_customized">Is Customized</label>
                                                <select name="is_customized" id="is_customized" class="form-control select2">
                                                    <option value="1">Customized Item</option>
                                                    <option value="0">Not Customized Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="is_shipping">Is Shipping</label>
                                                <select name="is_shipping" id="is_shipping" class="form-control select2">
                                                    <option value="1">Shipping Item</option>
                                                    <option value="0">Not Shipping Item</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Item</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('items.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_item.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
