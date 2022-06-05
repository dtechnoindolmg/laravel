<!-- need to remove -->
{{-- Home --}}
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
{{-- warehouse menu --}}
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fas fa-warehouse"></i>
        <p>
            Warehouse
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('warehouse.items') }}"
                class="nav-link {{ \Request::route()->getName() === 'warehouse.items' ? 'active' : '' }}">
                <i class="fas fa-luggage-cart"></i>
                <p>Items</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('warehouse.stockin') }}"
                class="nav-link {{ \Request::route()->getName() === 'warehouse.stockin' ? 'active' : '' }}">
                <i class="fas fa-cart-plus"></i>
                <p>Stock In</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('warehouse.stockout') }}"
                class="nav-link {{ \Request::route()->getName() === 'warehouse.stockout' ? 'active' : '' }}">
                <i class="fas fa-cart-arrow-down"></i>
                <p>Stock Out</p>
            </a>
        </li>
    </ul>
</li>
