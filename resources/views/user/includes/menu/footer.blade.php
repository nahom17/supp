<footer class="mt-5">
    <nav class="sticky-bottom" id="footer">
        <ul class="nav justify-content-center border-bottom">
            <li class="nav-item">
                <a href="{{ route('welcome') }}" class="nav-link px-2 text-muted" id="footer-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('service') }}" class="nav-link px-2 text-muted" id="footer-link">Voorwaarden</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}" class="nav-link px-2 text-muted" id="footer-link">Contact</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link px-2 text-muted" id="footer-link">Over ons</a>
            </li>
        </ul>
        <p class="text-center text-muted mb-0 pb-3" id="footer-link">© {{date('Y')}} MessageBoard, Inc</p>
    </nav>

</footer>