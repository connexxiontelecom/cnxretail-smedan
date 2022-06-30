@extends('layouts.frontend-layout')

@section('title')
    Home
@endsection

@section('main-content')
    <div class="hero-banner full jumbo-banner" style="background:#f4f9fd url(assets/assets/img/bg2.png);">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 col-md-8">
                    <h1>Organize <span class="text-info">Your Sales</span> Processes!</h1>
                    <p class="lead">All in one place.</p>
                        <div class="row m-0">
                            <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                                <div class="btn-group">
                                    <a href="{{route('contact-us')}}" class="btn dark-3  r-radius">Send Request</a>
                                    <a href="{{route('register')}}" class="btn dark-2  r-radius">Start Trial</a>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="col-lg-5 col-md-4">
                    <img src="/assets/assets/img/a-2.png" alt="latest property" class="img-fluid">
                </div>

            </div>
        </div>
    </div>
    <section class="how-it-works">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="sec-heading">
                        <h2>How It <span class="theme-cl-2">Works?</span></h2>
                        <p>CNX Retail helps you take your business online so you can find new customers, sell more and expand your reach. It works in 4 easy steps…</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="working-process"><span class="process-img"><img src="/assets/assets/img/step-1.png" class="img-responsive" alt=""><span class="process-num">01</span></span>
                        <h4>Create An Account</h4>
                        <p>To take your business online, you will need to create an account you will use to manage and grow your store. Click on Get Started to begin creating an account for your online store.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="working-process"><span class="process-img">
                            <img src="/assets/assets/img/step-2.png" class="img-responsive" alt="">
                            <span class="process-num">02</span></span>
                        <h4>Describe Your Business</h4>
                        <p>Once done, login to the CNX Retail account you just created to access and populate your account. Here you will fill in information needed to help your customers understand what your business is about.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="working-process"><span class="process-img">
                            <img src="/assets/assets/img/step-3.png" class="img-responsive" alt="">
                            <span class="process-num">03</span></span>
                        <h4>Upload Your Inventory</h4>
                        <p>This is where you upload details about each product and service you offer in store. Here you can upload details such as pictures and videos, prices, quantities, delivery time, size etc, around your products and services. </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="working-process"><span class="process-img">
                            <img src="/assets/assets/img/step-1.png" class="img-responsive" alt="">
                            <span class="process-num">04</span></span>
                        <h4>Manage Your Business</h4>
                        <p>Once your inventory goes live, you are ready to sell and manage your business. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="min-sec">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="sec-heading">
                        <h2>Featured <span class="theme-cl-2">Products</span></h2>
                        <p>Here are some of the most viewed products from some vendors on CNX Retail.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach($items as $item)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                        <div class="job_grid_02">
                            <div class="blog-thumb">
                                <a href="{{route('view-item', $item->slug)}}">
                                    <img style="width: 255px; height: 300px;" src="/assets/drive/{{$item->getItemFirstGalleryImage($item->id)->attachment ?? 'image.jpg'}}" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="jb_grid_01_caption">
                                <h4 class="_jb_title" style="margin-top: 20px;">
                                    <a href="{{route('view-item', $item->slug)}}" title="{{$item->item_name ?? '' }}">{{ strlen($item->item_name) > 28 ? substr($item->item_name,0,25).'...' : $item->item_name}}</a>
                                </h4>
                            </div>
                            <div class="jb_grid_01_footer" style="margin-top:-20px;">
                                <a href="{{route('view-item', $item->slug)}}" class="_jb_apply">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="text-center">We’ll automatically list your product here once it starts gaining views
                    </p>
                    <div class="mt-3 text-center">
                        <a href="{{route('marketplace')}}" class="_browse_more-2 light">Visit Marketplace</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="gray-light">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="sec-heading">
                        <h2>Manage everything in  <span class="theme-cl-2">one place</span></h2>
                        <p>Here’s all you will need to easily manage your online business in one place</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-package"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Organic Market Place Listing</h4>
                                <p>Think of this like a sample advert and listing of your business at the entrance of the market… Only that this signboard shows people what your beautiful product looks like. If they click that product, it leads them directly to your store.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-mouse-alt"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>CRM with Mailchimp Integration</h4>
                                <p>With Our easy-to-use customer relationship management system, you can send emails to your customers about your new arrivals and wish them everything wonderful on their birthdays.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-layers"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Receipts & Reminders</h4>
                                <p>Access fully automated receipts generator and reminders so you can deliver faster, keep your clients happy and get everything about your business sorted and tended</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Bookkeeping & Reports</h4>
                                <p>With CNX Retail, we save you the stress of keeping records as all your business transactions are recorded and logged so you can show investors your record and get investments to expand your business</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-package"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Smart Contact Management</h4>
                                <p>Can you imagine a situation where you can access your customer’s information in one place? Now you don’t have to imagine anymore… It’s yours already</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-mouse-alt"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Invoices and Bills</h4>
                                <p>Now you can automatically generate invoices and bills like big businesses and look all corporate and official while at it.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-layers"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Receipts & Reminders</h4>
                                <p>Access fully automated receipts generator and reminders so you can deliver faster, keep your clients happy and get everything about your business sorted and tended</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Monitoring Evaluation</h4>
                                <p>You can monitor your business growth processes, quickly spot what you need to do to scale your business in one go</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-package"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Full Payments Solution & Gateway</h4>
                                <p>Now you can automate your payment and have customers place orders and make payments while you sleep.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="yel098_7uw">
                            <div class="ye_lk23">
                                <i class="ti-mouse-alt"></i>
                            </div>
                            <div class="yel_7bcx">
                                <h4>Cloud Storage/File Management</h4>
                                <p>No more record loss or missing files when you sign up to use CNX Retail. Plus you can now login to your online store from anywhere in the world to evaluate your business growth on the go</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="download-app">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">
                    <div class="_setup_process">
                        <h2>Download CNX Retail For <span class="theme-cl-2">Android And iPhone</span></h2>
                        <p>Take your business online and gain access to 150 million new Nigerian customers surfing the web for businesses like yours.</p>
                    </div>
                    <div class="btn-box clearfix mt-5">
                        <a href="index.html" class="download-btn play-store">
                            <i class="fa fa-android"></i>
                            <span>Download on</span>
                            <h3>Google Play</h3>
                        </a>

                        <a href="index.html" class="download-btn app-store">
                            <i class="fa fa-apple"></i>
                            <span>Download on</span>
                            <h3>App Store</h3>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <img src="/assets/assets/img/app.png" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </section>
@endsection


