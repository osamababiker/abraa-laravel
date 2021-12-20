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
                                    <form>
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
                                                <input type="text" name="business_name" class="form-control" id="business_name"
                                                    placeholder="business_name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="counter">Country</label>
                                                <select name="country"  id="country" class="form-control select2">
                                                    <option value="">Select country</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="business_keywords">Business keyword</label>
                                                <select name="business_keywords[]" id="business_keywords" multiple="multiple" class="form-control select2">
                                                    <option value="">Select country</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="primary_name">Primary Contact Person</label>
                                                <input type="text" name="primary_name" class="form-control" id="primary_name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="primary_m_phone">Primary Mobile Number</label>
                                                <input type="number" name="primary_m_phone" class="form-control" id="primary_m_phone">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="position">Position</label>
                                                <select id="position" name="position" class="form-control select2">
                                                    <option value=""> Select position </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="primary_whatsapp">WhatsApp Number</label>
                                                <input type="number" name="primary_whatsapp" class="form-control" id="primary_whatsapp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="primary_line_number">Land Line Number</label>
                                                <input type="number" name="primary_line_number" class="form-control" id="primary_line_number">
                                            </div>
                                        </div>
                                        <div class="form-group">
											<label class="custom-control custom-checkbox m-0">
                                                <input type="checkbox" name="premium_check" class="custom-control-input">
                                                <span class="custom-control-label">Contact Supplier For Premium Membership </span>
                                            </label>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Supplier</button>
                                            &nbsp; &nbsp;
                                            <button type="submit" class="btn btn-primary">Add Secondary Contact Person</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
