<nav class="nav flex-column">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    @foreach($list as $row)
        <a class="nav-link {{ $isActive($row['label']) ? 'active' : '' }}" href="">
        {{ $row['label'] }}
        </a>
    @endforeach
</nav>