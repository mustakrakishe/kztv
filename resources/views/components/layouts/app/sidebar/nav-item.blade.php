@props(['title', 'iconClass', 'link', 'dropDownAble', 'badge', 'treeview'])

<li class="nav-item">
    <a href="{{ $link }}" class="nav-link">
        <i class="nav-icon {{ $iconClass }}"></i>
        <p>
            {{ $title }}

            @isset($treeview)
                <i class="fas fa-angle-left right"></i>
            @endif

            @isset($badge)
                <span class="badge badge-info right">{{ $badge }}</span>
            @endif
        </p>

    </a>

    @isset($treeview)
        <ul class="nav nav-treeview">
            {{ $treeview }}
        </ul>
    @endif
</li>