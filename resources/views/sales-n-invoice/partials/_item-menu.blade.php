<div class="btn-group mt-2 mb-2 float-right">
    <button type="button" class="btn btn-pill btn-outline-primary">Action</button>
    <button type="button" class="btn btn-pill btn-outline-primary dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{route('add-new-item', ['account'=>$account])}}">Add New Item</a></li>
        <li><a href="{{route('manage-products', ['account'=>$account])}}">Products</a></li>
        <li><a href="{{route('manage-services', ['account'=>$account])}}">Services</a></li>
    </ul>
</div>
