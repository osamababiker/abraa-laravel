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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> edit Item </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('items.update') }}">
                                        @csrf 
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <div class="form-row mt-4">
                                            <div class="form-group col-md-6">
                                                <label for="title">Item Name</label>
                                                <input type="text" value="{{ $item->title }}" name="title" class="form-control" id="title">
                                            </div>
                                            <div class="form-group col-md-6 autocomplete-supplier">
                                                <label for="user_id">Search For User</label>
                                                @if($item->supplier)
                                                    <input type="hidden" value="{{ $item->supplier->id }}" name="user_id" id="user_id">
                                                    <input type="text" value="{{ $item->supplier->full_name }}" name="search_supplier" class="form-control" id="search_supplier">
                                                @else
                                                    <input type="hidden" name="user_id" id="user_id">
                                                    <input type="text" name="search_supplier" class="form-control" id="search_supplier"> 
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sub_of">Category</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    @if($item->category)
                                                        <option selected value="{{ $item->category->id }}">{{ $item->category->en_title }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($categories as $category) 
                                                        <option value="{{ $category->id }}">{{ $category->en_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="unit">Select Unit</label>
                                                <select name="unit" id="unit" class="form-control select2">
                                                    @if($item->item_unit)
                                                        <option selected value="{{ $item->item_unit->id }}">{{ $item->item_unit->unit_en }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($units as $unit) 
                                                        <option value="{{ $unit->id }}">{{ $unit->unit_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="details">Item Details</label>
                                                <textarea name="details" cols="6" rows="6" class="form-control" id="primary_name">{{ $item->details }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="price">Item Price</label>
                                                <input type="number" name="price" value="{{ $item->price }}" class="form-control" id="price">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="old_price">Item old Price</label>
                                                <input type="number" name="old_price" value="{{ $item->old_price }}" class="form-control" id="old_price">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="youtube_video">Youtube Video</label>
                                                <input type="string" name="youtube_video" value="{{ $item->youtube_video }}" class="form-control" id="youtube_video">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="deliver_per">Deliver Per ?</label>
                                                <input type="number" name="deliver_per" value="{{ $item->deliver_per }}" placeholder="1 = week, 2 = month, 3 = year, 4 = one time" class="form-control" id="deliver_per">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="item_type">Item Type</label>
                                                <select name="item_type" id="item_type" class="form-control select2">
                                                    @if($item->item_type == 'New')
                                                        <option selected value="New">New</option>
                                                        <option value="Used">Used</option>
                                                    @else
                                                        <option selected value="Used">Used</option>
                                                        <option value="New">New</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="quantity">Item Quantity</label>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="manufacture_country">Manufacture Country</label>
                                                <select name="manufacture_country" id="manufacture_country" class="form-control select2">
                                                    <option selected value="{{ $item->manufacture_country }}">{{ $item->manufacture_country }}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->en_name }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="part_number">Part Number</label>
                                                <input type="number" value="{{ $item->part_number }}" name="part_number" class="form-control" id="part_number">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="active">Is Active</label>
                                                <select name="active" id="active" class="form-control select2">
                                                    @if($item->active == 1)
                                                        <option selected value="1">Active Item</option>
                                                        <option value="0">Un Active Item</option>
                                                    @else 
                                                        <option selected value="0">Un Active Item</option>
                                                        <option value="1">Active Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Item Status</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    @if($item->status == 1)
                                                        <option selected value="1">Is Available</option>
                                                        <option value="0">Un available</option>
                                                    @else 
                                                        <option selected value="0">Un available</option>
                                                        <option  value="1">Is Available</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="rejected">Is Rejected</label>
                                                <select name="rejected" id="rejected" class="form-control select2">
                                                    @if($item->rejected == 1)
                                                        <option selected value="1">Rejected Item</option>
                                                        <option value="0">Not rejected Item</option>
                                                    @else 
                                                        <option selected value="0">Not rejected Item</option>
                                                        <option value="1">Rejected Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="is_sold">Item Sold</label>
                                                <select name="is_sold" id="is_sold" class="form-control select2">
                                                    @if($item->is_sold == 1)
                                                        <option selected value="1">Is sold</option>
                                                        <option value="0">Un sold</option>
                                                    @else 
                                                        <option selected value="0">Un sold</option>
                                                        <option value="1">Is sold</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="featured">Is Reatured</label>
                                                <select name="featured" id="featured" class="form-control select2">
                                                    @if($item->featured == 1)
                                                        <option selected value="1">Reatured Item</option>
                                                        <option value="0">Not Reatured Item</option>
                                                    @else
                                                        <option selected value="0">Not Reatured Item</option>
                                                        <option value="1">Reatured Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="accept_offers">Item accept offers</label>
                                                <select name="accept_offers" id="accept_offers" class="form-control select2">
                                                    @if($item->accept_offers == 1)
                                                        <option selected value="1">Accept Offers</option>
                                                        <option value="0">Not Accept Offers</option>
                                                    @else 
                                                        <option selected value="0">Not Accept Offers</option>
                                                        <option value="1">Accept Offers</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="accept_min_offer">Accept Min Offer</label>
                                                <input type="number" value="{{ $item->accept_min_offer }}" name="accept_min_offer" class="form-control" id="accept_min_offer">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sort_order">Sort Order</label>
                                                <input type="number" value="{{ $item->sort_order }}" name="sort_order" class="form-control" id="sort_order">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="meta_keyword">Meta Keywords</label>
                                                <select name="meta_keyword[]" multiple="multiple" id="meta_keyword" class="form-control select2">
                                                    <option selected value="{{ $item->meta_keyword }}">{{ $item->meta_keyword }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="meta_description">Meta Description</label>
                                                <select name="meta_description"  multiple="multiple"  id="meta_description" class="form-control select2">
                                                    <option selected value="{{ $item->meta_description }}">{{ $item->meta_description }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="phone_count">Phone Count</label>
                                                <input type="number" name="phone_count" value="{{ $item->phone_count }}" class="form-control" id="phone_count">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email_count">Email Count</label>
                                                <input type="number" name="email_count" value="{{ $item->email_count }}" class="form-control" id="email_count">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="chat_count">Chat Count</label>
                                                <input type="number" name="chat_count" value="{{ $item->chat_count }}" class="form-control" id="chat_count">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="min_order">Minimum Order</label>
                                                <input type="number" name="min_order" value="{{ $item->min_order }}" class="form-control" id="min_order">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="payment_option_ids">Payment Options</label>
                                                <select name="payment_option_ids[]" multiple="multiple" id="payment_option_ids" class="form-control select2">
                                                    <option selected value="{{ $item->payment_option_ids }}">{{ $item->payment_option_ids }}</option>
                                                    @foreach($paymentOptions as $option)
                                                        <option value="{{ $option->id }}">{{ $option->method }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="default_image">Item Default Image</label>
                                                <input type="file" value="{{ $item->default_image }}" name="default_image" class="form-control" id="default_image">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="rating">Item Rating</label>
                                                <input type="number" value="{{ $item->rating }}" name="rating" class="form-control" id="rating">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="currency">Item Currency</label>
                                                <select name="currency" id="currency" class="form-control select2">
                                                    @if($item->item_currency)
                                                        <option selected value="{{ $item->item_currency->id }}">{{ $item->item_currency->name_en }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($currencies as $currency)
                                                        <option value="{{ $currency->id }}">{{ $currency->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="approved">Is Approved</label>
                                                <select name="approved" id="approved" class="form-control select2">
                                                    @if($item->approved == 1)
                                                        <option selected value="1">Approved Item</option>
                                                        <option value="0">Not Approved Item</option>
                                                    @else 
                                                        <option selected value="0">Not Approved Item</option>
                                                        <option value="1">Approved Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="is_bulk">Is Bulk</label>
                                                <select name="is_bulk" id="is_bulk" class="form-control select2">
                                                    @if($item->is_bulk == 1)
                                                        <option selected value="1">Bulk Item</option>
                                                        <option value="0">Not Bulk Item</option>
                                                    @else 
                                                        <option selected value="0">Not Bulk Item</option>
                                                        <option value="1">Bulk Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="is_global">Is Global</label>
                                                <select name="is_global" id="is_global" class="form-control select2">
                                                    @if($item->is_global == 1)
                                                        <option selected value="1">Global Item</option>
                                                        <option value="0">Not Global Item</option>
                                                    @else 
                                                        <option selected value="0">Not Global Item</option>
                                                        <option value="1">Global Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="is_customized">Is Customized</label>
                                                <select name="is_customized" id="is_customized" class="form-control select2">
                                                    @if($item->is_customized == 1)
                                                        <option selected value="1">Customized Item</option>
                                                        <option value="0">Not Customized Item</option>
                                                    @else 
                                                        <option selected value="0">Not Customized Item</option>
                                                        <option value="1">Customized Item</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
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
