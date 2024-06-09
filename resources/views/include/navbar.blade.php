<nav>
      <div class="navbar">
        <div class="logo"><a href="#">Velvet Whisk</a></div>
        <ul class="menu">
          @auth
          <li><a href="{{ route('dashboard') }}" method='GET' class="Home">Home</a></li>
          @else
          <li><a href="{{ route('home') }}" method='GET' class="Home">Home</a></li>
          @endauth
          <li><a href="{{route('product')}}" method='get'class="Category">Product</a></li>
          <li><a href="{{route('cart.show')}}" class="Feedback">Cart</a></li>
          <li><a href="{{route('transaction.show')}}" class="Feedback">Transaction</a></li>
          @auth
          <li class="dropdown">
                <a href="#" class="dropbtn">{{ Auth::user()->name }}</a>
                <div class="dropdown-content">
                    <a href="{{route('profile.edit') }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                    <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a>
                    </form>
                </div>
            </li>
          @else()
          <button onclick="window.location.href='{{ route('login') }}'" class="Login">Log in</button>
          @endauth
        </ul>
      </div>
</nav>