<section class="why-us">
    <div class="left">
        <span class="subtitle">{{ theme_option('whyus_subtitle') }}</span>
        <h3>{{ theme_option('whyus_title') }}</h3>
        <div class="features">
            <div class="feature">
                <i class="{{ theme_option('whyus_feature1_icon') }}"></i>
                <h4>{{ theme_option('whyus_feature1_title') }}</h4>
                <p>{{ theme_option('whyus_feature1_desc') }}</p>
            </div>
            <div class="feature">
                <i class="{{ theme_option('whyus_feature2_icon') }}"></i>
                <h4>{{ theme_option('whyus_feature2_title') }}</h4>
                <p>{{ theme_option('whyus_feature2_desc') }}</p>
            </div>
            <div class="feature">
                <i class="{{ theme_option('whyus_feature3_icon') }}"></i>
                <h4>{{ theme_option('whyus_feature3_title') }}</h4>
                <p>{{ theme_option('whyus_feature3_desc') }}</p>
            </div>
        </div>
    </div>
    <div class="right">
        <img src="{{ RvMedia::getImageUrl(theme_option('whyus_map_image')) }}" alt="Map">
    </div>
</section>
