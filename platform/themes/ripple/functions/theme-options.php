<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;

app('events')->listen(RenderingThemeOptionSettings::class, function () {
    theme_option()
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#AF0F26',
            ],
        ])
        ->setField([
            'id' => 'default_breadcrumb_banner_image',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Default banner image (1920x170px)'),
            'attributes' => [
                'name' => 'default_breadcrumb_banner_image',
                'value' => null,
            ],
        ])
        ->setField([
            'id' => 'site_description',
            'section_id' => 'opt-text-subsection-general',
            'label' => __('Site description'),
            'attributes' => [
                'name' => 'site_description',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 455,
                ],
            ],
        ])
         ->setField([
            'id' => 'site_title',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Site Title'),
            'attributes' => [
                'name' => 'site_title',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'address',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'text',
            'label' => __('Address'),
            'attributes' => [
                'name' => 'address',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'website',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'url',
            'label' => __('Website'),
            'attributes' => [
                'name' => 'website',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'contact_email',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'email',
            'label' => __('Email'),
            'attributes' => [
                'name' => 'contact_email',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'data-counter' => 120,
                ],
            ],
        ])
        ->setField([
    'id' => 'contact_number',
    'section_id' => 'opt-text-subsection-general',
    'type' => 'text',
    'label' => __('Contact Number'),
    'attributes' => [
        'name' => 'contact_number',
        'value' => null,
        'options' => [
            'class' => 'form-control',
            'data-counter' => 20,
        ],
    ],
])

        ->setField([
            'id' => 'facebook_comment_enabled_in_gallery',
            'section_id' => 'opt-text-subsection-facebook-integration',
            'type' => 'customSelect',
            'label' => __('Enable Facebook comment in the gallery detail?'),
            'attributes' => [
                'name' => 'facebook_comment_enabled_in_gallery',
                'list' => [
                    'no' => trans('core/base::base.no'),
                    'yes' => trans('core/base::base.yes'),
                ],
                'value' => 'no',
            ],
        ])

        
        ->setSection([
            'title'      => 'Certifications Section',
            'desc'       => 'Settings for the certifications section on homepage',
            'id'         => 'opt-certifications-section',
            'subsection' => true,
            'icon'       => 'fa fa-certificate',
        ])

        
        ->setField([
            'id' => 'certifications_title',
            'section_id' => 'opt-certifications-section',
            'type' => 'text',
            'label' => 'Certifications Title',
            'attributes' => [
                'name' => 'certifications_title',
                'value' => 'Global Standards, Proven Quality',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'certifications_description',
            'section_id' => 'opt-certifications-section',
            'type' => 'textarea',
            'label' => 'Certifications Description',
            'attributes' => [
                'name' => 'certifications_description',
                'value' => 'Recognized by leading global healthcare authorities for our quality and compliance.',
                'options' => [
                    'class' => 'form-control',
                ],
            ],
        ])
        ->setField([
            'id' => 'cert_image_1',
            'section_id' => 'opt-certifications-section',
            'type' => 'mediaImage',
            'label' => 'Certification Image 1',
            'attributes' => [
                'name' => 'cert_image_1',
                'value' => null,
            ],
        ])
        ->setField([
            'id' => 'cert_image_2',
            'section_id' => 'opt-certifications-section',
            'type' => 'mediaImage',
            'label' => 'Certification Image 2',
            'attributes' => [
                'name' => 'cert_image_2',
                'value' => null,
            ],
        ])
        ->setField([
            'id' => 'cert_image_3',
            'section_id' => 'opt-certifications-section',
            'type' => 'mediaImage',
            'label' => 'Certification Image 3',
            'attributes' => [
                'name' => 'cert_image_3',
                'value' => null,
            ],
        ])
        ->setSection([
    'title'      => 'PCD Franchise Opportunity Section',
    'desc'       => 'Content and image for the PCD Franchise Opportunity block',
    'id'         => 'opt-pcd-franchise-section',
    'subsection' => true,
    'icon'       => 'fa fa-industry',
])

->setField([
    'id' => 'pcd_title',
    'section_id' => 'opt-pcd-franchise-section',
    'type' => 'text',
    'label' => 'Section Title',
    'attributes' => [
        'name' => 'pcd_title',
        'value' => 'PCD Franchise Opportunity',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])

->setField([
    'id' => 'pcd_content',
    'section_id' => 'opt-pcd-franchise-section',
    'type' => 'textarea',
    'label' => 'Section Content',
    'attributes' => [
        'name' => 'pcd_content',
        'value' => 'At Pharma, we offer reliable and high-quality Third Party Manufacturing services...',
        'options' => [
            'class' => 'form-control',
            'rows' => 5,
        ],
    ],
])

->setField([
    'id' => 'pcd_offer_list',
    'section_id' => 'opt-pcd-franchise-section',
    'type' => 'textarea',
    'label' => 'Offer List (one per line)',
    'attributes' => [
        'name' => 'pcd_offer_list',
        'value' => "- GMP certified facilities\n- Approved product range\n- Branding & packaging support\n- Delivery with full documentation\n- Quality assurance & batch testing",
        'options' => [
            'class' => 'form-control',
            'rows' => 5,
        ],
    ],
])

->setField([
    'id' => 'pcd_image',
    'section_id' => 'opt-pcd-franchise-section',
    'type' => 'mediaImage',
    'label' => 'Right Side Image',
    'attributes' => [
        'name' => 'pcd_image',
        'value' => null,
    ],
])

->setField([
    'id' => 'pcd_innerimage',
    'section_id' => 'opt-pcd-franchise-section',
    'type' => 'mediaImage',
    'label' => 'Service page image',
    'attributes' => [
        'name' => 'pcd_innerimage',
        'value' => null,
    ],
])

->setSection([
    'title'      => 'Why Us Section',
    'desc'       => 'Content and icons for the "What Makes Us Better than Others" section',
    'id'         => 'opt-why-us-section',
    'subsection' => true,
    'icon'       => 'fa fa-star',
])

->setField([
    'id' => 'whyus_subtitle',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Section Subtitle',
    'attributes' => [
        'name' => 'whyus_subtitle',
        'value' => 'Speciality',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])

->setField([
    'id' => 'whyus_title',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Section Title',
    'attributes' => [
        'name' => 'whyus_title',
        'value' => 'What Makes Us Better than Others',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])

->setField([
    'id' => 'whyus_map_image',
    'section_id' => 'opt-why-us-section',
    'type' => 'mediaImage',
    'label' => 'Right Side Map Image',
    'attributes' => [
        'name' => 'whyus_map_image',
        'value' => null,
    ],
])


->setField([
    'id' => 'whyus_feature1_icon',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 1 Icon Class (e.g., fa fa-chart-line)',
    'attributes' => [
        'name' => 'whyus_feature1_icon',
        'value' => 'fa fa-sitemap',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature1_title',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 1 Title',
    'attributes' => [
        'name' => 'whyus_feature1_title',
        'value' => 'Our Marketing Divisions',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature1_desc',
    'section_id' => 'opt-why-us-section',
    'type' => 'textarea',
    'label' => 'Feature 1 Description',
    'attributes' => [
        'name' => 'whyus_feature1_desc',
        'value' => 'A wide array of marketing divisions including PCD pharma franchise and Third Party Manufacturing',
        'options' => [
            'class' => 'form-control',
            'rows' => 3,
        ],
    ],
])

// Feature 2
->setField([
    'id' => 'whyus_feature2_icon',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 2 Icon Class',
    'attributes' => [
        'name' => 'whyus_feature2_icon',
        'value' => 'fa fa-th-large',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature2_title',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 2 Title',
    'attributes' => [
        'name' => 'whyus_feature2_title',
        'value' => 'Categories',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature2_desc',
    'section_id' => 'opt-why-us-section',
    'type' => 'textarea',
    'label' => 'Feature 2 Description',
    'attributes' => [
        'name' => 'whyus_feature2_desc',
        'value' => 'Different types of product categories include Ayurvedic, Dermatology, Nutraceuticals, General, and Pediatrics.',
        'options' => [
            'class' => 'form-control',
            'rows' => 3,
        ],
    ],
])

// Feature 3
->setField([
    'id' => 'whyus_feature3_icon',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 3 Icon Class',
    'attributes' => [
        'name' => 'whyus_feature3_icon',
        'value' => 'fa fa-cubes',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature3_title',
    'section_id' => 'opt-why-us-section',
    'type' => 'text',
    'label' => 'Feature 3 Title',
    'attributes' => [
        'name' => 'whyus_feature3_title',
        'value' => 'Product Classification',
        'options' => [
            'class' => 'form-control',
        ],
    ],
])
->setField([
    'id' => 'whyus_feature3_desc',
    'section_id' => 'opt-why-us-section',
    'type' => 'textarea',
    'label' => 'Feature 3 Description',
    'attributes' => [
        'name' => 'whyus_feature3_desc',
        'value' => 'A diverse portfolio of pharma products is available under a range of product classifications such as tablets, capsules, syrups, and injectables.',
        'options' => [
            'class' => 'form-control',
            'rows' => 3,
        ],
    ],
])
->setField([
    'id'          => 'logo_description',
    'section_id'  => 'opt-text-subsection-logo', 
    'type'        => 'textarea',
    'label'       => 'Logo Description',
    'attributes'  => [
        'name'    => 'logo_description',
        'value'   => null, 
        'options' => [
            'class' => 'form-control',
            'rows'  => 3,
        ],
    ],
])
->setField([
        'id' => 'about_section_logo',
        'section_id' => 'opt-text-subsection-homepage', 
        'type' => 'mediaImage',
        'label' => 'About Section Logo',
        'attributes' => [
            'name' => 'about_section_logo',
            'value' => null, 
        ],
    ])
     ->setSection([
                'title'      => __('Products SEO & Banner Settings'),
                'desc'       => __('Manage SEO details and banner image for products'),
                'id'         => 'opt-products-seo',
                'subsection' => true,
                'icon'       => 'fa fa-tags',
            ])
            ->setField([
                'id'         => 'products_seo_title',
                'section_id' => 'opt-products-seo',
                'type'       => 'text',
                'label'      => __('Products SEO Title'),
                'attributes' => [
                    'name'  => 'products_seo_title',
                    'value' => theme_option('products_seo_title'),
                ],
            ])
            ->setField([
                'id'         => 'products_seo_description',
                'section_id' => 'opt-products-seo',
                'type'       => 'textarea',
                'label'      => __('Products SEO Description'),
                'attributes' => [
                    'name'  => 'products_seo_description',
                    'value' => theme_option('products_seo_description'),
                ],
            ])
            ->setField([
                'id'         => 'products_seo_image',
                'section_id' => 'opt-products-seo',
                'type'       => 'mediaImage',
                'label'      => __('Products SEO Image'),
                'attributes' => [
                    'name'  => 'products_seo_image',
                    'value' => theme_option('products_seo_image'),
                ],
            ])
            ->setField([
                'id'         => 'products_banner_image',
                'section_id' => 'opt-products-seo',
                'type'       => 'mediaImage',
                'label'      => __('Products Banner Image'),
                'attributes' => [
                    'name'  => 'products_banner_image',
                    'value' => theme_option('products_banner_image'),
                ],
            ])

   ->setField([
        'id' => 'about_section_description',
        'section_id' => 'opt-text-subsection-homepage',
        'type' => 'textarea',
        'label' => 'About Section Description',
        'attributes' => [
            'name' => 'about_section_description',
            'value' => 'Rechelist Pharma, the nutraceutical manufacturing division of Biotech, offers a full-spectrum contract manufacturing service that blends science with market-ready innovation.',
            'options' => [
                'class' => 'form-control',
                'rows' => 4,
                'data-counter' => 300,
            ],
        ],
    ])
->setSection([
            'title'      => __('Admin Office'),
            'id'         => 'opt-admin-office',
            'subsection' => true,
            'icon'       => 'fa fa-building',
        ])
        ->setField([
            'id'        => 'admin_office_address',
            'section_id'=> 'opt-admin-office',
            'type'      => 'textarea',
            'label'     => __('Office Address'),
            'attributes'=> [
                'name'    => 'admin_office_address',
                'value'   => theme_option('admin_office_address'),
            ],
        ]);
        

        
});
