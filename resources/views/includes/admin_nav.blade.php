<div class="fluid-container admin-nav">  
    @if(Auth::user()->role === 'admin')  
        <a href="{{ route('products.create') }}" class="btn btn-primary" title="Add New Product">  
            <i class="fa-solid fa-plus"></i>  
        </a>  
        <a href="{{ route('categories.create') }}" class="btn btn-primary" title="Create Category">  
            <i class="fa-solid fa-folder-plus"></i>  
        </a>  
        {{--  <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" title="Admin Dashboard">  
            <i class="fa-solid fa-tachometer-alt"></i>  
        </a> --}}  
        <a href="{{ route('admin.manage_roles') }}" class="btn btn-primary" title="Manage Users">  
            <i class="fa-solid fa-user-cog"></i>  
        </a>  
        <a href="{{ route('admin.register') }}" class="btn btn-primary" title="Register New Staff">  
            <i class="fa-solid fa-user-plus"></i>  
        </a>  
        <a href="{{ route('admin.profile') }}" class="btn btn-primary" title="Edit Profile">  
            <i class="fa-solid fa-user-edit"></i>  
        </a>  
        <a href="{{ route('admin.setting') }}" class="btn btn-primary" title="Settings">  
            <i class="fa-solid fa-cog"></i>  
        </a>  
    @endif  
</div>  