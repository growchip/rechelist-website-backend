<section class="pcd-franchise">
    <div class="content">
        <h3>{{ theme_option('pcd_title') }}</h3>
        <p>{!! nl2br(e(theme_option('pcd_content'))) !!}</p>
        <ul>
            @foreach (explode("\n", theme_option('pcd_offer_list')) as $item)
                @if(trim($item))
                    <li>{{ ltrim($item, '- ') }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="image">
        <img src="{{ RvMedia::getImageUrl(theme_option('pcd_image')) }}" alt="PCD Franchise Opportunity">
    </div>
</section>
