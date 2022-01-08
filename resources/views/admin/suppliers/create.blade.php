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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Supplier </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('suppliers.store') }}" method="POST">
                                        @csrf
                                        <div id="primary_contact_section">
                                            <div class="form-row d-flex justify-content-center mt-4">
                                                <div class="form-group">
                                                    <label class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" name="manufacturer" class="custom-control-input">
                                                        <span class="custom-control-label"> manufacturer </span>
                                                    </label>
                                                </div>
                                                &nbsp; &nbsp;
                                                <div class="form-group">
                                                    <label class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" name="brand_owner" class="custom-control-input">
                                                        <span class="custom-control-label"> Brand Owner </span>
                                                    </label>
                                                </div>
                                                &nbsp; &nbsp;
                                                <div class="form-group">
                                                    <label class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" name="reseller" class="custom-control-input">
                                                        <span class="custom-control-label"> Reseller </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="form-group col-md-6">
                                                    <label for="business_name">Business Name</label>
                                                    <input type="text"  name="business_name" class="form-control" id="business_name"
                                                        placeholder="business name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="counter">Country</label>
                                                    <select name="country"  id="country" class="form-control select2">
                                                        <option value="">Select country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="interested_keywords">Business keyword</label>
                                                    <select name="interested_keywords[]" id="interested_keywords" multiple="multiple" class="form-control select2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="primary_name">Primary Contact Person</label>
                                                    <input type="text" name="primary_name" class="form-control" id="primary_name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="primary_email">Primary Email</label>
                                                    <input type="email" name="email" class="form-control" id="primary_email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="primary_m_phone">Primary Mobile Number</label>
                                                    <input type="number" name="phone" class="form-control" id="primary_m_phone">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="primary_position">Primary Position</label>
                                                    <select id="primary_position" name="primary_position" class="form-control select2">
                                                        <option value="1">
                                                            Sales Manager
                                                        </option>
                                                        <option value="2">
                                                            Maketing Manger
                                                        </option>
                                                        <option value="3">
                                                            Full Size
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="primary_whatsapp">WhatsApp Number</label>
                                                    <input type="text" name="primary_whatsapp" class="form-control" id="primary_whatsapp">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="primary_line_number">Land Line Number</label>
                                                    <input type="text" name="primary_line_number" class="form-control" id="primary_line_number">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- edit secoundry contact form -->
                                        <div id="secondary_contact_section">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_name">Secondary Contact Person</label>
                                                    <input type="text" name="secondary_name" class="form-control" id="secondary_name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_email">Secondary Email</label>
                                                    <input type="email" name="secondary_email" class="form-control" id="secondary_email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_m_phone">Secondary Mobile Number</label>
                                                    <input type="number" name="secondary_m_phone" class="form-control" id="secondary_m_phone">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_position">Secondary Position</label>
                                                    <select id="secondary_position" name="secondary_position" class="form-control select2">
                                                        <option value="1">
                                                            Sales Manager
                                                        </option>
                                                        <option value="2">
                                                            Maketing Manger
                                                        </option>
                                                        <option value="3">
                                                            Full Size
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_whatsapp">WhatsApp Number</label>
                                                    <input type="text" name="secondary_whatsapp" class="form-control" id="secondary_whatsapp">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="secondary_line_number">Land Line Number</label>
                                                    <input type="text" name="secondary_line_number" class="form-control" id="secondary_line_number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" name="premium_check" class="custom-control-input">
                                                    <span class="custom-control-label">Contact Supplier For Premium Membership </span>
                                                </label>
                                            </div>
                                            <div class="form-row d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Add Supplier</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @if(session()->has('feedback'))
                @include('admin.suppliers.components.feedback')
            @endif
            @include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
