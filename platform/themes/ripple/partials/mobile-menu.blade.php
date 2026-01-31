@php $menuId = uniqid('mobile-menu-'); @endphp

@foreach ($menuNodes as $index => $node)
    <li>
        @if ($node->has_child)
            @php $submenuId = $menuId . '-submenu-' . $index; @endphp
            <a 
                data-bs-toggle="collapse" 
                href="#{{ $submenuId }}" 
                role="button" 
                aria-expanded="false" 
                aria-controls="{{ $submenuId }}"
                class="d-flex justify-content-between align-items-center"
            >
                {{ $node->title }}
                <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="collapse ps-3" id="{{ $submenuId }}">
                @foreach ($node->children as $child)
                    <li class="mt-2"><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        @else
            <a href="{{ $node->url }}">{{ $node->title }}</a>
        @endif
    </li>
@endforeach
