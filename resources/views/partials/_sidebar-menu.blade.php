
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('dashboard', ['account'=>$account])}}">
            <img src="/assets/images/brand/main.png" class="header-brand-img desktop-logo" alt="logo">
            <img src="/assets/images/brand/main.png" class="header-brand-img toggle-logo" alt="logo">
            <img src="/assets/images/brand/main.png" class="header-brand-img light-logo" alt="logo">
            <img src="/assets/images/brand/main.png" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>Main</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('dashboard', ['account'=>$account])}}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 4h18v10H3z" opacity=".3"/><path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 12H3V4h18v10z"/></svg>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('app-settings', ['account'=>$account])}}">
                <i class="mdi mdi-settings mr-2"></i>
                <span class="side-menu__label">Settings</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-user mr-2"></i>
                <span class="side-menu__label">Contacts</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('add-new-contact', ['account'=>$account])}}" class="slide-item"> Add New Contact</a></li>
                <li><a href="{{route('all-contacts', ['account'=>$account])}}" class="slide-item"> All Contacts</a></li>
                <li><a href="{{route('all-leads', ['account'=>$account])}}" class="slide-item"> Leads</a></li>
                <li><a href="{{route('all-deals', ['account'=>$account])}}" class="slide-item"> Deals</a></li>
            </ul>
        </li>
        <li><h3>Communication</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-email mr-2"></i>
                <span class="side-menu__label">CRM</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('manage-campaigns', ['account'=>$account])}}" class="slide-item">Campaigns</a></li>
                <li><a href="{{route('manage-audiences', ['account'=>$account])}}" class="slide-item">Audiences</a></li>
                <li><a href="{{route('add-new-audience', ['account'=>$account])}}" class="slide-item"> Add New Audience</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-bolt mr-2"></i>
                <span class="side-menu__label">Bulk SMS</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('compose-message', ['account'=>$account])}}" class="slide-item"> Compose</a></li>
                <li><a href="{{route('top-up', ['account'=>$account])}}" class="slide-item">Top-up</a></li>
                <li><a href="{{route('bulk-messages', ['account'=>$account])}}" class="slide-item"> Messages</a></li>
                <li><a href="{{route('phone-group', ['account'=>$account])}}" class="slide-item"> Phone Group</a></li>
            </ul>
        </li>
        <li><h3>Products/Services</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"  class="side-menu__icon">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M5 5v14h14V5H5zm4 12H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                </svg>
                <span class="side-menu__label">Setup Items</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('add-new-item', ['account'=>$account])}}" class="slide-item">Add New Item</a></li>
                <li><a href="{{route('manage-products', ['account'=>$account])}}" class="slide-item"> Products</a></li>
                <li><a href="{{route('manage-services', ['account'=>$account])}}" class="slide-item"> Services</a></li>
                <li><a href="{{route('item-categories', ['account'=>$account])}}" class="slide-item"> Categories</a></li>
            </ul>
        </li>
        <li><h3>Sales & Invoicing</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-ticket mr-2"></i>
                <span class="side-menu__label">Invoices</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('add-new-invoice', ['account'=>$account])}}" class="slide-item">New Invoice</a></li>
                <li><a href="{{route('manage-invoices', ['account'=>$account])}}" class="slide-item"> All Invoices</a></li>
                <li><a href="{{route('post-invoice', ['account'=>$account])}}" class="slide-item"> Post Invoice</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-menu-alt mr-2"></i>
                <span class="side-menu__label">Receipts</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('add-new-receipt', ['account'=>$account])}}" class="slide-item">New Receipt</a></li>
                <li><a href="{{route('manage-receipts', ['account'=>$account])}}" class="slide-item"> All Receipts</a></li>
            </ul>
        </li>
        <li><h3>Bills & Payment</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-share mr-2"></i>
                <span class="side-menu__label">Bills</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('manage-bills', ['account'=>$account])}}" class="slide-item"> All Bills</a></li>
                <li><a href="{{route('add-new-bill', ['account'=>$account])}}" class="slide-item"> New Bill</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-wallet mr-2"></i>
                <span class="side-menu__label">Payment</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('manage-payments', ['account'=>$account])}}" class="slide-item"> All Payments</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M7 3h14v14H7z" opacity=".3"/>
                    <path d="M3 23h16v-2H3V5H1v16c0 1.1.9 2 2 2zM21 1H7c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 16H7V3h14v14z"/></svg>
                <span class="side-menu__label">Imprest</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('my-imprest', ['account'=>$account])}}" class="slide-item"> My Imprest</a></li>
                <li><a href="{{route('manage-imprests', ['account'=>$account])}}" class="slide-item"> All Imprest</a></li>
            </ul>
        </li>
        <li><h3>Reports</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M7 3h14v14H7z" opacity=".3"/>
                    <path d="M3 23h16v-2H3V5H1v16c0 1.1.9 2 2 2zM21 1H7c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 16H7V3h14v14z"/></svg>
                <span class="side-menu__label">Reports</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('sales-report', ['account'=>$account])}}" class="slide-item"> Sales Report</a></li>
                <li><a href="{{route('payment-report', ['account'=>$account])}}" class="slide-item"> Payment Report</a></li>
                <li><a href="#" class="slide-item"> Margin Report</a></li>
                <li><a href="{{route('impress-report', ['account'=>$account])}}" class="slide-item"> Impress Report</a></li>
            </ul>
        </li>
        <li><h3>Extras</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('manage-reminders', ['account'=>$account])}}">
                <i class="ti-alarm-clock mr-2"></i>
                <span class="side-menu__label">Reminders</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('manage-storage', ['account'=>$account])}}">
                <i class="ti-dropbox mr-2"></i>
                <span class="side-menu__label">CNXDrive</span>
            </a>
        </li>
        <li><h3>Administration</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-hand-open mr-2"></i>
                <span class="side-menu__label">Workforce</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('manage-workforce', ['account'=>$account])}}" class="slide-item"> Team Members</a></li>
                <li><a href="{{route('add-new-team-member', ['account'=>$account])}}" class="slide-item">Add New Member</a></li>
            </ul>
        </li>
        <li><h3>Monitoring/Evaluation</h3></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-hand-open mr-2"></i>
                <span class="side-menu__label">Monitoring</span><i class="angle fe fe-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('list-trainings', ['account'=>$account])}}" class="slide-item"> Trainings</a></li>
                <li><a href="{{route('list-grants', ['account'=>$account])}}" class="slide-item">Grants</a></li>
                <li><a href="{{route('list-surveys', ['account'=>$account])}}" class="slide-item">Surveys</a></li>
                <li><a href="{{route('list-consultations', ['account'=>$account])}}" class="slide-item">Consultations</a></li>
            </ul>
        </li>
    </ul>
</aside>
