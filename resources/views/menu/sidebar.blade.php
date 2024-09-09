<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bx-network-chart'></i>
        <span class="text">TEST CETTA</span>
    </a>
    <ul class="side-menu top" style="margin-top: 10px !important;">
        <li class=" {{ Request::is('sensors') ? 'active bg-gradient-primary' : '' }}">
            <a href="{{ route('sensors.index') }}">
                <i class='bx bx-clipboard'></i>
                <span class="text">Manage Air Quailty Sensor</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#" class="text "
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out-circle'></i> <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </li>
    </ul>
</section>
