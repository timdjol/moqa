<div class="sidebar">
    <ul>
        @admin
            <li @routeactive('dashboard')><a href="{{ route('dashboard')}}">Консоль</a></li>
            <li @routeactive('categories.index')><a href="{{ route('categories.index')}}">Категории</a></li>
            <li @routeactive('products.index')><a href="{{ route('products.index')}}">Продукции</a></li>
            <li @routeactive('properties.index')><a href="{{ route('properties.index')}}">Свойства</a></li>
            <li @routeactive('coupons.index')><a href="{{ route('coupons.index')}}">Купоны</a></li>
            <li @routeactive('orders.index')><a href="{{ route('orders.index')}}">Заказы</a></li>
            <li @routeactive('pages.index')><a href="{{ route('pages.index')}}">Страницы</a></li>
            <li @routeactive('contacts.index')><a href="{{ route('contacts.index')}}">Контакты</a></li>
            <li @routeactive('profile.edit')><a href="{{ route('profile.edit') }}">Профиль</a></li>
        @else
            <li @routeactive('person.orders.index')><a href="{{ route('person.orders.index')}}">Заказы</a></li>
            <li><a href="{{ route('profile.edit') }}">Профиль</a></li>
        @endadmin
    </ul>
</div>
