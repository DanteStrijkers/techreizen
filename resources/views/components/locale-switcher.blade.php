<div class="dropdown locale-switcher">
    <button class="btn btn-primary dropdown-toggle" type="button" id="localeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        {{ strtoupper(app()->getLocale()) }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="localeDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('locale.switch', 'nl') }}">Nederlands</a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a>
        </li>
    </ul>
</div>
