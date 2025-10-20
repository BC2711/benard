<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function hero_section(Request $request)
    {
        // Get or create hero section data
        $section = Section::where('section_type', 'HERO')->first();

        if (!$section) {
            $defaultContent = [
                'heading' => 'Get a Loan for Your Business Growth or Startup',
                'description' => 'Fast, flexible financing solutions designed specifically for marketers and entrepreneurs. Grow your business with our tailored loan programs.',
                'ctaButton' => [
                    'text' => 'Get Started Now',
                    'url' => '/#support'
                ],
                'ctaPhone' => '+123456789',
                'ctaPhoneSubtext' => 'For any question or concern',
                'trustIndicators' => [
                    ['value' => '500+', 'label' => 'Marketeers Funded'],
                    ['value' => '$10M+', 'label' => 'Amount Disbursed'],
                    ['value' => '24/7', 'label' => 'Customer Support']
                ]
            ];

            $section = Section::create([
                'name' => 'Hero Section',
                'description' => 'Main hero section of the website',
                'section_type' => 'HERO',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'heading' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'ctaButtonText' => 'required|string|max:50',
                'ctaButtonUrl' => 'required|max:255',
                'ctaPhone' => 'required|string|max:20',
                'ctaPhoneSubtext' => 'required|string|max:100',
                'trustIndicators' => 'sometimes|array',
                'trustIndicators.*.value' => 'required|string|max:50',
                'trustIndicators.*.label' => 'required|string|max:100',
                'hero_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Process trust indicators
            $trustIndicators = [];
            if (isset($data['trustIndicators'])) {
                foreach ($data['trustIndicators'] as $indicator) {
                    if (!empty($indicator['value']) && !empty($indicator['label'])) {
                        $trustIndicators[] = [
                            'value' => $indicator['value'],
                            'label' => $indicator['label']
                        ];
                    }
                }
            }

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            $heroData = array_merge($currentContent, [
                'heading' => $data['heading'],
                'description' => $data['description'],
                'ctaButton' => [
                    'text' => $data['ctaButtonText'],
                    'url' => $data['ctaButtonUrl']
                ],
                'ctaPhone' => $data['ctaPhone'],
                'ctaPhoneSubtext' => $data['ctaPhoneSubtext'],
                'trustIndicators' => $trustIndicators
            ]);

            // Handle image upload
            if ($request->hasFile('hero_image')) {
                // Delete old image if exists
                if (isset($currentContent['hero_image']) && Storage::exists($currentContent['hero_image'])) {
                    Storage::delete($currentContent['hero_image']);
                }

                $imagePath = $request->file('hero_image')->store('hero-images', 'public');
                $heroData['hero_image'] = $imagePath;
            }

            $section->update([
                'content' => $heroData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Hero section updated successfully.');
        }

        // Ensure content is always returned as array
        $heroData = $this->getContentAsArray($section->content);

        return view('pages.website.hero', [
            'heroData' => $heroData,
            'section' => $section
        ]);
    }

    /**
     * Ensure content is always returned as array
     */
    private function getContentAsArray($content)
    {
        if (is_array($content)) {
            return $content;
        }

        if (is_string($content)) {
            return json_decode($content, true) ?? [];
        }

        return [];
    }

    public function feature_section(Request $request)
    {
        // Get or create feature section data
        $section = Section::where('section_type', 'FEATURES')->first();

        if (!$section) {
            $defaultContent = [
                'section_heading' => 'Why Marketeers Choose Londa Loans',
                'section_description' => 'We understand the unique financial needs of marketing professionals and have built our services around your success.',
                'cta_heading' => 'Ready to fund your next marketing success?',
                'cta_description' => 'Join hundreds of marketeers who have scaled their businesses with Londa Loans',
                'feature_cards' => [
                    [
                        'id' => 1,
                        'title' => 'Fast Approval',
                        'description' => 'Get loan decisions within 24 hours, so you can seize marketing opportunities when they arise.',
                        'icon' => 'assets/images/icon-01.svg',
                        'bg_color' => 'primary'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Marketing Expertise',
                        'description' => 'Our team understands marketing needs and tailors loans specifically for campaign funding and growth.',
                        'icon' => 'assets/images/icon-02.svg',
                        'bg_color' => 'secondary'
                    ],
                    [
                        'id' => 3,
                        'title' => 'Flexible Terms',
                        'description' => 'Repayment plans designed around your campaign ROI cycles and revenue patterns.',
                        'icon' => 'assets/images/icon-03.svg',
                        'bg_color' => 'primary'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Transparent Pricing',
                        'description' => 'No hidden fees or surprise charges. Know exactly what you\'re paying from day one.',
                        'icon' => 'assets/images/icon-04.svg',
                        'bg_color' => 'secondary'
                    ],
                    [
                        'id' => 5,
                        'title' => 'Dedicated Support',
                        'description' => 'Get personalized assistance from loan specialists who understand marketing businesses.',
                        'icon' => 'assets/images/icon-05.svg',
                        'bg_color' => 'primary'
                    ],
                    [
                        'id' => 6,
                        'title' => 'Scalable Funding',
                        'description' => 'Start small and access larger amounts as your marketing success and business grow.',
                        'icon' => 'assets/images/icon-06.svg',
                        'bg_color' => 'secondary'
                    ]
                ],
                'trust_indicators' => [
                    [
                        'id' => 1,
                        'value' => '500+',
                        'label' => 'Marketing Campaigns Funded'
                    ],
                    [
                        'id' => 2,
                        'value' => '98%',
                        'label' => 'Approval Rate'
                    ],
                    [
                        'id' => 3,
                        'value' => '24h',
                        'label' => 'Average Processing Time'
                    ],
                    [
                        'id' => 4,
                        'value' => 'ZMW 10M+',
                        'label' => 'Loans Disbursed'
                    ]
                ],
                'cta_buttons' => [
                    [
                        'id' => 1,
                        'text' => 'Apply for Loan',
                        'url' => '#!',
                        'style' => 'primary',
                        'aria_label' => 'Apply for a loan'
                    ],
                    [
                        'id' => 2,
                        'text' => 'Calculate Payments',
                        'url' => '#!',
                        'style' => 'secondary',
                        'aria_label' => 'Calculate loan payments'
                    ]
                ]
            ];

            $section = Section::create([
                'name' => 'Features Section',
                'description' => 'Main features section of the website',
                'section_type' => 'FEATURES',
                'status' => 'ACTIVE',
                'content' => json_encode($defaultContent),
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'section_heading' => 'required|string|max:255',
                'section_description' => 'required|string|max:500',
                'cta_heading' => 'required|string|max:255',
                'cta_description' => 'required|string|max:500',
                'feature_cards' => 'sometimes|array',
                'feature_cards.*.title' => 'required|string|max:100',
                'feature_cards.*.description' => 'required|string|max:200',
                'feature_cards.*.icon' => 'sometimes|string|max:255',
                'feature_cards.*.bg_color' => 'required|in:primary,secondary',
                'trust_indicators' => 'sometimes|array',
                'trust_indicators.*.value' => 'required|string|max:50',
                'trust_indicators.*.label' => 'required|string|max:100',
                'cta_buttons' => 'sometimes|array',
                'cta_buttons.*.text' => 'required|string|max:50',
                'cta_buttons.*.url' => 'required|max:255',
                'cta_buttons.*.style' => 'required|in:primary,secondary',
                'cta_buttons.*.aria_label' => 'sometimes|string|max:100'
            ]);

            // Process feature cards
            $featureCards = [];
            if (isset($data['feature_cards'])) {
                $cardId = 1;
                foreach ($data['feature_cards'] as $card) {
                    if (!empty($card['title']) && !empty($card['description'])) {
                        $featureCards[] = [
                            'id' => $cardId++,
                            'title' => $card['title'],
                            'description' => $card['description'],
                            'icon' => $card['icon'] ?? "assets/images/icon-0" . (($cardId % 6) + 1) . ".svg",
                            'bg_color' => $card['bg_color']
                        ];
                    }
                }
            }

            // Process trust indicators
            $trustIndicators = [];
            if (isset($data['trust_indicators'])) {
                $indicatorId = 1;
                foreach ($data['trust_indicators'] as $indicator) {
                    if (!empty($indicator['value']) && !empty($indicator['label'])) {
                        $trustIndicators[] = [
                            'id' => $indicatorId++,
                            'value' => $indicator['value'],
                            'label' => $indicator['label']
                        ];
                    }
                }
            }

            // Process CTA buttons
            $ctaButtons = [];
            if (isset($data['cta_buttons'])) {
                $buttonId = 1;
                foreach ($data['cta_buttons'] as $button) {
                    if (!empty($button['text']) && !empty($button['url'])) {
                        $ctaButtons[] = [
                            'id' => $buttonId++,
                            'text' => $button['text'],
                            'url' => $button['url'],
                            'style' => $button['style'],
                            'aria_label' => $button['aria_label'] ?? $button['text']
                        ];
                    }
                }
            }

            // Get current content and update it
            $currentContent = $this->getContentAsArray($section->content);

            $featureData = array_merge($currentContent, [
                'section_heading' => $data['section_heading'],
                'section_description' => $data['section_description'],
                'cta_heading' => $data['cta_heading'],
                'cta_description' => $data['cta_description'],
                'feature_cards' => $featureCards,
                'trust_indicators' => $trustIndicators,
                'cta_buttons' => $ctaButtons
            ]);

            $section->update([
                'content' => $featureData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Features section updated successfully.');
        }

        // Ensure content is always returned as array
        $featureData = $this->getContentAsArray($section->content);

        return view('pages.website.features', [
            'featureData' => $featureData,
            'section' => $section
        ]);
    }

    public function about_section(Request $request)
    {
        // Get or create about section data
        $section = Section::where('section_type', 'ABOUT_US')->first();

        if (!$section) {
            $defaultContent = [
                'subheading' => 'Why Choose Londa Loans',
                'heading' => 'We Empower Marketeers with Financial Solutions That Drive Growth',
                'description' => 'At Londa Loans, we understand the unique financial needs of marketers and entrepreneurs. Our tailored loan programs are designed specifically to fuel your business growth and marketing initiatives.',
                'images' => [
                    [
                        'id' => 1,
                        'src' => 'assets/images/about-01.png',
                        'alt' => 'Team collaborating on a marketing campaign',
                        'shape' => 'assets/images/shape-05.svg',
                        'shape_alt' => 'Decorative shape pattern',
                        'shape_position' => 'top-left',
                        'is_centered' => false
                    ],
                    [
                        'id' => 2,
                        'src' => 'assets/images/about-02.png',
                        'alt' => 'Entrepreneur analyzing financial growth',
                        'shape' => null,
                        'shape_alt' => null,
                        'shape_position' => null,
                        'is_centered' => false
                    ],
                    [
                        'id' => 3,
                        'src' => 'assets/images/about-03.png',
                        'alt' => 'Marketer presenting a growth strategy',
                        'shape' => 'assets/images/shape-06.svg',
                        'shape_alt' => 'Decorative shape accent',
                        'shape_position' => 'top-right',
                        'is_centered' => true
                    ],
                    [
                        'id' => 4,
                        'src' => null,
                        'alt' => null,
                        'shape' => 'assets/images/shape-07.svg',
                        'shape_alt' => 'Decorative shape detail',
                        'shape_position' => 'bottom-left',
                        'is_centered' => true
                    ]
                ],
                'features' => [
                    [
                        'id' => 1,
                        'title' => 'Fast Approval',
                        'description' => 'Get decisions within 24 hours',
                        'bg_color' => 'primary'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Flexible Terms',
                        'description' => 'Repayment plans that work for you',
                        'bg_color' => 'secondary'
                    ],
                    [
                        'id' => 3,
                        'title' => 'No Hidden Fees',
                        'description' => 'Transparent pricing always',
                        'bg_color' => 'primary'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Marketing Focus',
                        'description' => 'Loans designed for marketeers',
                        'bg_color' => 'secondary'
                    ]
                ],
                'stats' => [
                    [
                        'id' => 1,
                        'value' => '500+',
                        'label' => 'Successful Campaigns Funded'
                    ],
                    [
                        'id' => 2,
                        'value' => '98%',
                        'label' => 'Customer Satisfaction'
                    ],
                    [
                        'id' => 3,
                        'value' => '$10M+',
                        'label' => 'Loans Disbursed'
                    ]
                ],
                'video_cta' => [
                    'url' => 'https://www.youtube.com/watch?v=xcJtL7QggTI',
                    'text' => 'See How We Empower Marketers',
                    'aria_label' => 'Watch video about Londa Loans impact on marketers'
                ]
            ];

            $section = Section::create([
                'name' => 'About Section',
                'description' => 'Main about section of the website',
                'section_type' => 'ABOUT_US',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            // First validate non-file fields
            $data = $request->validate([
                'subheading' => 'required|string|max:255',
                'heading' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'video_cta_url' => 'required|url|max:255',
                'video_cta_text' => 'required|string|max:100',
                'video_cta_aria_label' => 'required|string|max:255',
                'images' => 'sometimes|array',
                'images.*.alt' => 'nullable|string|max:255',
                'images.*.shape_alt' => 'nullable|string|max:255',
                'images.*.shape_position' => 'nullable|in:top-left,top-right,bottom-left',
                'images.*.is_centered' => 'sometimes|boolean',
                'features' => 'sometimes|array',
                'features.*.title' => 'required|string|max:100',
                'features.*.description' => 'required|string|max:200',
                'features.*.bg_color' => 'required|in:primary,secondary',
                'stats' => 'sometimes|array',
                'stats.*.value' => 'required|string|max:50',
                'stats.*.label' => 'required|string|max:100',
            ]);

            // Manually validate files only if they exist and are not empty
            if ($request->hasFile('image_files')) {
                foreach ($request->file('image_files') as $index => $file) {
                    if ($file && $file->isValid()) {
                        $request->validate([
                            "image_files.{$index}" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);
                    }
                }
            }

            if ($request->hasFile('shape_files')) {
                foreach ($request->file('shape_files') as $index => $file) {
                    if ($file && $file->isValid()) {
                        $request->validate([
                            "shape_files.{$index}" => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
                        ]);
                    }
                }
            }

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            // Process images
            $images = [];
            if (isset($data['images'])) {
                $imageId = 1;
                foreach ($data['images'] as $index => $image) {
                    $images[] = [
                        'id' => $imageId++,
                        'src' => $this->handleImageUpload($request, 'image_files', $index, $currentContent['images'][$index]['src'] ?? null),
                        'alt' => $image['alt'] ?? '',
                        'shape' => $this->handleImageUpload($request, 'shape_files', $index, $currentContent['images'][$index]['shape'] ?? null),
                        'shape_alt' => $image['shape_alt'] ?? '',
                        'shape_position' => $image['shape_position'] ?? null,
                        'is_centered' => $image['is_centered'] ?? false
                    ];
                }
            } else {
                $images = $currentContent['images'] ?? [];
            }

            // Process features
            $features = [];
            if (isset($data['features'])) {
                $featureId = 1;
                foreach ($data['features'] as $feature) {
                    if (!empty($feature['title']) && !empty($feature['description'])) {
                        $features[] = [
                            'id' => $featureId++,
                            'title' => $feature['title'],
                            'description' => $feature['description'],
                            'bg_color' => $feature['bg_color']
                        ];
                    }
                }
            } else {
                $features = $currentContent['features'] ?? [];
            }

            // Process stats
            $stats = [];
            if (isset($data['stats'])) {
                $statId = 1;
                foreach ($data['stats'] as $stat) {
                    if (!empty($stat['value']) && !empty($stat['label'])) {
                        $stats[] = [
                            'id' => $statId++,
                            'value' => $stat['value'],
                            'label' => $stat['label']
                        ];
                    }
                }
            } else {
                $stats = $currentContent['stats'] ?? [];
            }

            $aboutData = array_merge($currentContent, [
                'subheading' => $data['subheading'],
                'heading' => $data['heading'],
                'description' => $data['description'],
                'images' => $images,
                'features' => $features,
                'stats' => $stats,
                'video_cta' => [
                    'url' => $data['video_cta_url'],
                    'text' => $data['video_cta_text'],
                    'aria_label' => $data['video_cta_aria_label']
                ]
            ]);

            $section->update([
                'content' => $aboutData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'About section updated successfully.');
        }

        // Ensure content is always returned as array
        $aboutData = $this->getContentAsArray($section->content);

        return view('pages.website.about', [
            'aboutData' => $aboutData,
            'section' => $section
        ]);
    }

    /**
     * Handle image upload
     */
    private function handleImageUpload($request, $field, $index, $currentPath = null)
    {
        // Check if file exists and is valid
        if ($request->hasFile("{$field}.{$index}")) {
            $file = $request->file("{$field}.{$index}");

            // Only process if file is valid and not empty
            if ($file && $file->isValid()) {
                // Delete old image if exists
                if ($currentPath && Storage::exists($currentPath)) {
                    Storage::delete($currentPath);
                }

                $folder = $field === 'image_files' ? 'about-images' : 'about-shapes';
                return $file->store($folder, 'public');
            }
        }

        return $currentPath;
    }

    public function service_section(Request $request)
    {
        // Get or create services section data
        $section = Section::where('section_type', 'SERVICES')->first();

        if (!$section) {
            $defaultContent = [
                'sectionHeading' => 'Loan Solutions for Marketeers',
                'sectionDescription' => 'We provide specialized financial solutions designed specifically for marketers and entrepreneurs to fuel your growth and marketing initiatives.',
                'services' => [
                    [
                        'id' => 1,
                        'title' => 'Business Expansion Loans',
                        'description' => 'Scale your marketing operations with flexible financing options tailored for growth.',
                        'icon' => 'assets/images/service-icon-1.svg',
                        'iconAlt' => 'Business growth icon',
                        'borderColor' => 'primary',
                        'linkUrl' => '#',
                        'linkAriaLabel' => 'Learn more about Business Expansion Loans',
                        'animationDelay' => '0.1s'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Marketing Campaign Funding',
                        'description' => 'Get immediate funding for your marketing campaigns and client projects.',
                        'icon' => 'assets/images/service-icon-2.svg',
                        'iconAlt' => 'Marketing campaign icon',
                        'borderColor' => 'secondary',
                        'linkUrl' => '#',
                        'linkAriaLabel' => 'Learn more about Marketing Campaign Funding',
                        'animationDelay' => '0.2s'
                    ],
                    [
                        'id' => 3,
                        'title' => 'Startup Capital',
                        'description' => 'Launch your marketing agency with our specialized startup loan programs.',
                        'icon' => 'assets/images/service-icon-3.svg',
                        'iconAlt' => 'Startup capital icon',
                        'borderColor' => 'primary',
                        'linkUrl' => '#',
                        'linkAriaLabel' => 'Learn more about Startup Capital',
                        'animationDelay' => '0.3s'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Equipment Financing',
                        'description' => 'Finance your marketing tools and technology infrastructure.',
                        'icon' => 'assets/images/service-icon-4.svg',
                        'iconAlt' => 'Equipment financing icon',
                        'borderColor' => 'secondary',
                        'linkUrl' => '#',
                        'linkAriaLabel' => 'Learn more about Equipment Financing',
                        'animationDelay' => '0.4s'
                    ]
                ],
                'cta' => [
                    'heading' => 'Ready to grow your marketing business?',
                    'description' => 'Get the financial support you need to scale your marketing efforts',
                    'buttons' => [
                        [
                            'text' => 'Apply Now',
                            'url' => '/apply',
                            'ariaLabel' => 'Apply for a loan',
                            'style' => 'primary'
                        ],
                        [
                            'text' => 'Contact Us',
                            'url' => '/contact',
                            'ariaLabel' => 'Contact our team',
                            'style' => 'secondary'
                        ]
                    ]
                ]
            ];

            $section = Section::create([
                'name' => 'Services Section',
                'description' => 'Main services section content',
                'section_type' => 'SERVICES',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            // First validate non-file fields
            $validator = Validator::make($request->all(), [
                'sectionHeading' => 'required|string|max:255',
                'sectionDescription' => 'required|string|max:500',
                'services' => 'required|array|min:1',
                'services.*.title' => 'required|string|max:255',
                'services.*.description' => 'required|string|max:500',
                'services.*.iconAlt' => 'required|string|max:255',
                'services.*.borderColor' => 'required|in:primary,secondary',
                'services.*.linkUrl' => 'required|string|max:500',
                'services.*.linkAriaLabel' => 'required|string|max:255',
                'services.*.animationDelay' => 'required|string|max:10',
                'ctaHeading' => 'required|string|max:255',
                'ctaDescription' => 'required|string|max:500',
                'ctaButton1Text' => 'required|string|max:255',
                'ctaButton1Url' => 'required|string|max:500',
                'ctaButton1AriaLabel' => 'required|string|max:255',
                'ctaButton2Text' => 'required|string|max:255',
                'ctaButton2Url' => 'required|string|max:500',
                'ctaButton2AriaLabel' => 'required|string|max:255',
            ]);

            // Add file validation only for files that are actually uploaded
            $validator->after(function ($validator) use ($request) {
                if ($request->hasFile('service_icons')) {
                    foreach ($request->file('service_icons') as $index => $file) {
                        if ($file && $file->isValid()) {
                            $rules = [
                                'service_icons.' . $index => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                            ];

                            $fileValidator = Validator::make(
                                ['service_icons' => [$index => $file]],
                                $rules
                            );

                            if ($fileValidator->fails()) {
                                foreach ($fileValidator->errors()->all() as $error) {
                                    $validator->errors()->add("service_icons.{$index}", $error);
                                }
                            }
                        }
                    }
                }
            });

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $validator->validated();

            // Process services data
            $services = [];
            $currentContent = $this->getContentAsArray($section->content);

            foreach ($data['services'] as $index => $service) {
                $serviceData = [
                    'id' => $index + 1,
                    'title' => $service['title'],
                    'description' => $service['description'],
                    'iconAlt' => $service['iconAlt'],
                    'borderColor' => $service['borderColor'],
                    'linkUrl' => $service['linkUrl'],
                    'linkAriaLabel' => $service['linkAriaLabel'],
                    'animationDelay' => $service['animationDelay'],
                ];

                // Handle icon file upload - check if file exists for this index and is valid
                if ($request->hasFile("service_icons.{$index}")) {
                    $iconFile = $request->file("service_icons.{$index}");

                    if ($iconFile && $iconFile->isValid()) {
                        // Delete old icon if exists
                        $oldIcon = $currentContent['services'][$index]['icon'] ?? null;
                        if ($oldIcon && Storage::disk('public')->exists($oldIcon)) {
                            Storage::disk('public')->delete($oldIcon);
                        }

                        // Store new icon
                        $iconPath = $iconFile->store('services/icons', 'public');
                        $serviceData['icon'] = $iconPath;
                    } else {
                        // File upload failed, keep existing icon
                        $this->handleExistingIcon($currentContent, $serviceData, $index);
                    }
                } else {
                    // No file uploaded, keep existing icon
                    $this->handleExistingIcon($currentContent, $serviceData, $index);
                }

                $services[] = $serviceData;
            }

            $serviceData = array_merge($currentContent, [
                'sectionHeading' => $data['sectionHeading'],
                'sectionDescription' => $data['sectionDescription'],
                'services' => $services,
                'cta' => [
                    'heading' => $data['ctaHeading'],
                    'description' => $data['ctaDescription'],
                    'buttons' => [
                        [
                            'text' => $data['ctaButton1Text'],
                            'url' => $data['ctaButton1Url'],
                            'ariaLabel' => $data['ctaButton1AriaLabel'],
                            'style' => 'primary'
                        ],
                        [
                            'text' => $data['ctaButton2Text'],
                            'url' => $data['ctaButton2Url'],
                            'ariaLabel' => $data['ctaButton2AriaLabel'],
                            'style' => 'secondary'
                        ]
                    ]
                ]
            ]);

            $section->update([
                'content' => $serviceData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Services section updated successfully.');
        }

        // Ensure content is always returned as array
        $servicesData = $this->getContentAsArray($section->content);

        return view('pages.website.service', [
            'servicesData' => $servicesData,
            'section' => $section
        ]);
    }

    /**
     * Handle existing icon logic
     */
    private function handleExistingIcon($currentContent, &$serviceData, $index)
    {
        $existingService = $currentContent['services'][$index] ?? null;
        if ($existingService && isset($existingService['icon'])) {
            $serviceData['icon'] = $existingService['icon'];
        } else {
            // Use default icon based on index
            $defaultIcons = [
                'assets/images/service-icon-1.svg',
                'assets/images/service-icon-2.svg',
                'assets/images/service-icon-3.svg',
                'assets/images/service-icon-4.svg'
            ];
            $serviceData['icon'] = $defaultIcons[$index] ?? 'assets/images/service-icon-default.svg';
        }
    }


    public function price_section(Request $request)
    {
        $section = Section::where('section_type', 'PRICE')->first();

        // Default content structure
        $defaultContent = [
            'sectionHeading' => 'Flexible Loan Plans for Every Marketeer',
            'sectionDescription' => 'Choose from our range of loan options designed specifically for marketing professionals and businesses. Get the funding you need with terms that work for you.',
            'shapes' => [
                [
                    'id' => 1,
                    'src' => 'assets/images/shape-01.svg',
                    'alt' => 'Decorative shape',
                    'position' => 'top: 10%; left: 5%;',
                    'animationDuration' => '3s'
                ],
                [
                    'id' => 2,
                    'src' => 'assets/images/shape-02.svg',
                    'alt' => 'Decorative shape',
                    'position' => 'top: 15%; right: 8%;',
                    'animationDuration' => '4s'
                ],
                [
                    'id' => 3,
                    'src' => 'assets/images/shape-03.svg',
                    'alt' => 'Decorative shape',
                    'position' => 'bottom: 20%; left: 10%;',
                    'animationDuration' => '3.5s'
                ]
            ],
            'plans' => [
                [
                    'id' => 1,
                    'name' => 'Starter Plan',
                    'description' => 'Perfect for small marketing campaigns and initial business setup',
                    'featured' => false,
                    'amount' => [
                        'short' => '5,000',
                        'long' => '15,000'
                    ],
                    'term' => [
                        'short' => 'for 6 months',
                        'long' => 'for 24 months'
                    ],
                    'note' => 'Ideal for startups',
                    'buttonText' => 'Apply Now',
                    'buttonUrl' => '/apply/starter',
                    'buttonAriaLabel' => 'Apply for Starter Plan',
                    'features' => [
                        ['id' => 1, 'text' => 'Up to $5,000 funding'],
                        ['id' => 2, 'text' => '6-24 month terms'],
                        ['id' => 3, 'text' => 'Competitive rates'],
                        ['id' => 4, 'text' => 'No hidden fees']
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Growth Plan',
                    'description' => 'Scale your marketing efforts with medium-sized funding',
                    'featured' => true,
                    'amount' => [
                        'short' => '15,000',
                        'long' => '50,000'
                    ],
                    'term' => [
                        'short' => 'for 12 months',
                        'long' => 'for 36 months'
                    ],
                    'note' => 'Most popular choice',
                    'buttonText' => 'Get Started',
                    'buttonUrl' => '/apply/growth',
                    'buttonAriaLabel' => 'Apply for Growth Plan',
                    'features' => [
                        ['id' => 5, 'text' => 'Up to $50,000 funding'],
                        ['id' => 6, 'text' => '12-36 month terms'],
                        ['id' => 7, 'text' => 'Flexible repayment'],
                        ['id' => 8, 'text' => 'Priority processing']
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Enterprise Plan',
                    'description' => 'Maximum funding for large-scale marketing operations',
                    'featured' => false,
                    'amount' => [
                        'short' => '50,000',
                        'long' => '150,000'
                    ],
                    'term' => [
                        'short' => 'for 18 months',
                        'long' => 'for 48 months'
                    ],
                    'note' => 'For established businesses',
                    'buttonText' => 'Learn More',
                    'buttonUrl' => '/apply/enterprise',
                    'buttonAriaLabel' => 'Apply for Enterprise Plan',
                    'features' => [
                        ['id' => 9, 'text' => 'Up to $150,000 funding'],
                        ['id' => 10, 'text' => '18-48 month terms'],
                        ['id' => 11, 'text' => 'Customized solutions'],
                        ['id' => 12, 'text' => 'Dedicated support']
                    ]
                ]
            ],
            'customLoan' => [
                'label' => 'Custom Solution',
                'title' => 'Custom Loan Package',
                'description' => 'Need a different amount or term? We\'ll create a custom solution for your specific marketing needs.',
                'amount' => 'Flexible',
                'term' => 'Tailored to your business',
                'note' => 'Personalized terms and rates',
                'buttonText' => 'Get Custom Quote',
                'buttonUrl' => '/custom-quote',
                'buttonAriaLabel' => 'Get a custom loan quote',
                'features' => [
                    ['id' => 13, 'text' => 'Tailored funding amount'],
                    ['id' => 14, 'text' => 'Custom repayment terms'],
                    ['id' => 15, 'text' => 'Personalized service'],
                    ['id' => 16, 'text' => 'Flexible conditions']
                ]
            ]
        ];

        if (!$section) {
            $loanPlansData = $defaultContent;
        } else {
            $loanPlansData = json_decode($section->content, true) ?? $defaultContent;
        }

        if ($request->isMethod('post')) {
            return $this->handlePriceSectionUpdate($request, $section, $defaultContent);
        }

        return view('pages.website.price', compact('loanPlansData'));
    }

    private function handlePriceSectionUpdate(Request $request, $section, $defaultContent)
    {
        $validator = Validator::make($request->all(), [
            'sectionHeading' => 'required|string|max:255',
            'sectionDescription' => 'required|string|max:500',
            'shapes' => 'array',
            'shapes.*.alt' => 'required|string|max:255',
            'shapes.*.position' => 'required|string|max:255',
            'shapes.*.animationDuration' => 'required|string|max:10',
            'plans' => 'required|array|min:1',
            'plans.*.name' => 'required|string|max:255',
            'plans.*.description' => 'required|string|max:500',
            'plans.*.amount.short' => 'required|string|max:50',
            'plans.*.amount.long' => 'required|string|max:50',
            'plans.*.term.short' => 'required|string|max:100',
            'plans.*.term.long' => 'required|string|max:100',
            'plans.*.note' => 'required|string|max:255',
            'plans.*.buttonText' => 'required|string|max:255',
            'plans.*.buttonUrl' => 'required|string|max:500',
            'plans.*.buttonAriaLabel' => 'required|string|max:255',
            'plans.*.features' => 'required|array|min:1',
            'plans.*.features.*.text' => 'required|string|max:255',
            'customLoan.label' => 'required|string|max:255',
            'customLoan.title' => 'required|string|max:255',
            'customLoan.description' => 'required|string|max:500',
            'customLoan.amount' => 'required|string|max:100',
            'customLoan.term' => 'required|string|max:100',
            'customLoan.note' => 'required|string|max:255',
            'customLoan.buttonText' => 'required|string|max:255',
            'customLoan.buttonUrl' => 'required|string|max:500',
            'customLoan.buttonAriaLabel' => 'required|string|max:255',
            'customLoan.features' => 'required|array|min:1',
            'customLoan.features.*.text' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        // Process shapes
        $shapesData = [];
        foreach ($validatedData['shapes'] ?? [] as $index => $shape) {
            $shapeData = [
                'id' => $index + 1,
                'alt' => $shape['alt'],
                'position' => $shape['position'],
                'animationDuration' => $shape['animationDuration'],
            ];

            // Handle shape file upload
            if ($request->hasFile("shapes.{$index}.file")) {
                $shapeFile = $request->file("shapes.{$index}.file");
                $shapePath = $shapeFile->store('pricing/shapes', 'public');
                $shapeData['src'] = 'storage/' . $shapePath;
            } else {
                // Keep existing shape or use default
                $existingShapes = $section ? json_decode($section->content, true)['shapes'] ?? [] : [];
                $existingShape = $existingShapes[$index] ?? null;
                $shapeData['src'] = $existingShape['src'] ?? $defaultContent['shapes'][$index]['src'] ?? 'assets/images/shape-default.svg';
            }

            $shapesData[] = $shapeData;
        }

        // Process plans
        $plansData = [];
        foreach ($validatedData['plans'] as $index => $plan) {
            $planData = [
                'id' => $index + 1,
                'name' => $plan['name'],
                'description' => $plan['description'],
                'featured' => isset($plan['featured']) && $plan['featured'] === 'on',
                'amount' => [
                    'short' => $plan['amount']['short'],
                    'long' => $plan['amount']['long']
                ],
                'term' => [
                    'short' => $plan['term']['short'],
                    'long' => $plan['term']['long']
                ],
                'note' => $plan['note'],
                'buttonText' => $plan['buttonText'],
                'buttonUrl' => $plan['buttonUrl'],
                'buttonAriaLabel' => $plan['buttonAriaLabel'],
                'features' => []
            ];

            // Process plan features
            foreach ($plan['features'] as $fIndex => $feature) {
                $planData['features'][] = [
                    'id' => $fIndex + 1,
                    'text' => $feature['text']
                ];
            }

            $plansData[] = $planData;
        }

        // Process custom loan features
        $customFeatures = [];
        foreach ($validatedData['customLoan']['features'] as $index => $feature) {
            $customFeatures[] = [
                'id' => $index + 1,
                'text' => $feature['text']
            ];
        }

        $content = [
            'sectionHeading' => $validatedData['sectionHeading'],
            'sectionDescription' => $validatedData['sectionDescription'],
            'shapes' => $shapesData,
            'plans' => $plansData,
            'customLoan' => [
                'label' => $validatedData['customLoan']['label'],
                'title' => $validatedData['customLoan']['title'],
                'description' => $validatedData['customLoan']['description'],
                'amount' => $validatedData['customLoan']['amount'],
                'term' => $validatedData['customLoan']['term'],
                'note' => $validatedData['customLoan']['note'],
                'buttonText' => $validatedData['customLoan']['buttonText'],
                'buttonUrl' => $validatedData['customLoan']['buttonUrl'],
                'buttonAriaLabel' => $validatedData['customLoan']['buttonAriaLabel'],
                'features' => $customFeatures
            ]
        ];

        $sectionData = [
            'name' => 'Pricing Section',
            'description' => 'Loan plans and pricing section content',
            'section_type' => 'PRICE',
            'content' => json_encode($content),
            'status' => 'ACTIVE',
            'author' => Auth::user()->id,
            'last_modified_by' => Auth::user()->id,
        ];

        if ($section) {
            $section->update($sectionData);
        } else {
            Section::create($sectionData);
        }

        return redirect()->route('management.price-section')
            ->with('success', 'Pricing section updated successfully!');
    }

    public function toggle_loan_type(Request $request)
    {
        $request->validate([
            'loanType' => 'required|in:short,long'
        ]);

        session(['loanType' => $request->loanType]);

        return response()->json(['success' => true]);
    }

    // Team Section
    public function team_section(Request $request)
    {
        $section = Section::where('section_type', 'TEAM')->first();

        // Default content structure
        $defaultContent = [
            'sectionHeading' => 'Meet Our Financial Experts',
            'sectionDescription' => 'Our team of financial specialists understands the unique needs of marketeers and entrepreneurs. We\'re here to help you grow your business with the right funding solutions.',
            'shapes' => [
                [
                    'id' => 1,
                    'type' => 'circle',
                    'size' => '150px',
                    'opacity' => '0.1',
                    'position' => 'top: 10%; left: 5%;',
                    'animationDuration' => '3s'
                ],
                [
                    'id' => 2,
                    'type' => 'image',
                    'src' => 'assets/images/shape-01.svg',
                    'alt' => 'Decorative shape',
                    'position' => 'top: 15%; right: 8%;',
                    'animationDuration' => '4s'
                ],
                [
                    'id' => 3,
                    'type' => 'circle',
                    'size' => '120px',
                    'opacity' => '0.08',
                    'position' => 'bottom: 20%; left: 10%;',
                    'animationDuration' => '3.5s'
                ]
            ],
            'teamMembers' => [
                [
                    'id' => 1,
                    'name' => 'Sarah Johnson',
                    'title' => 'Senior Loan Advisor',
                    'description' => 'Specializing in marketing business loans with 10+ years of experience',
                    'image' => 'assets/images/team-member-1.jpg',
                    'alt' => 'Sarah Johnson - Senior Loan Advisor',
                    'socialLinks' => [
                        [
                            'id' => 1,
                            'platform' => 'linkedin',
                            'url' => 'https://linkedin.com/in/sarahjohnson',
                            'ariaLabel' => 'Connect with Sarah Johnson on LinkedIn'
                        ],
                        [
                            'id' => 2,
                            'platform' => 'twitter',
                            'url' => 'https://twitter.com/sarahjohnson',
                            'ariaLabel' => 'Follow Sarah Johnson on Twitter'
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Michael Chen',
                    'title' => 'Business Funding Specialist',
                    'description' => 'Expert in growth capital and marketing campaign financing',
                    'image' => 'assets/images/team-member-2.jpg',
                    'alt' => 'Michael Chen - Business Funding Specialist',
                    'socialLinks' => [
                        [
                            'id' => 3,
                            'platform' => 'linkedin',
                            'url' => 'https://linkedin.com/in/michaelchen',
                            'ariaLabel' => 'Connect with Michael Chen on LinkedIn'
                        ],
                        [
                            'id' => 4,
                            'platform' => 'facebook',
                            'url' => 'https://facebook.com/michaelchen',
                            'ariaLabel' => 'Follow Michael Chen on Facebook'
                        ]
                    ]
                ],
                [
                    'id' => 3,
                    'name' => 'Emily Rodriguez',
                    'title' => 'Startup Loan Consultant',
                    'description' => 'Helping marketing startups secure their first round of funding',
                    'image' => 'assets/images/team-member-3.jpg',
                    'alt' => 'Emily Rodriguez - Startup Loan Consultant',
                    'socialLinks' => [
                        [
                            'id' => 5,
                            'platform' => 'linkedin',
                            'url' => 'https://linkedin.com/in/emilyrodriguez',
                            'ariaLabel' => 'Connect with Emily Rodriguez on LinkedIn'
                        ],
                        [
                            'id' => 6,
                            'platform' => 'twitter',
                            'url' => 'https://twitter.com/emilyrodriguez',
                            'ariaLabel' => 'Follow Emily Rodriguez on Twitter'
                        ]
                    ]
                ],
                [
                    'id' => 4,
                    'name' => 'David Thompson',
                    'title' => 'Financial Strategy Director',
                    'description' => 'Developing long-term financial solutions for marketing agencies',
                    'image' => 'assets/images/team-member-4.jpg',
                    'alt' => 'David Thompson - Financial Strategy Director',
                    'socialLinks' => [
                        [
                            'id' => 7,
                            'platform' => 'linkedin',
                            'url' => 'https://linkedin.com/in/davidthompson',
                            'ariaLabel' => 'Connect with David Thompson on LinkedIn'
                        ]
                    ]
                ]
            ],
            'cta' => [
                'heading' => 'Ready to speak with our experts?',
                'description' => 'Get personalized loan advice from professionals who understand marketing businesses',
                'primaryButton' => [
                    'text' => 'Schedule Consultation',
                    'url' => '/consultation',
                    'ariaLabel' => 'Schedule a consultation with our financial experts'
                ],
                'secondaryButton' => [
                    'text' => 'Meet the Team',
                    'url' => '/team',
                    'ariaLabel' => 'Learn more about our team'
                ]
            ]
        ];

        if (!$section) {
            $teamData = $defaultContent;
        } else {
            $teamData = json_decode($section->content, true) ?? $defaultContent;
        }

        if ($request->isMethod('post')) {
            return $this->handleTeamSectionUpdate($request, $section, $defaultContent);
        }

        return view('pages.website.team', compact('teamData'));
    }

    private function handleTeamSectionUpdate(Request $request, $section, $defaultContent)
    {
        $validator = Validator::make($request->all(), [
            'sectionHeading' => 'required|string|max:255',
            'sectionDescription' => 'required|string|max:500',
            'shapes' => 'array',
            'shapes.*.type' => 'required|in:circle,image',
            'shapes.*.position' => 'required|string|max:255',
            'shapes.*.animationDuration' => 'required|string|max:10',
            'shapes.*.size' => 'required_if:shapes.*.type,circle|string|max:50',
            'shapes.*.opacity' => 'required_if:shapes.*.type,circle|string|max:10',
            'shapes.*.alt' => 'required_if:shapes.*.type,image|string|max:255',
            'teamMembers' => 'required|array|min:1',
            'teamMembers.*.name' => 'required|string|max:255',
            'teamMembers.*.title' => 'required|string|max:255',
            'teamMembers.*.description' => 'required|string|max:500',
            'teamMembers.*.alt' => 'required|string|max:255',
            'teamMembers.*.socialLinks' => 'required|array|min:1',
            'teamMembers.*.socialLinks.*.platform' => 'required|in:facebook,twitter,linkedin',
            'teamMembers.*.socialLinks.*.url' => 'required|string|max:500',
            'teamMembers.*.socialLinks.*.ariaLabel' => 'required|string|max:255',
            'cta.heading' => 'required|string|max:255',
            'cta.description' => 'required|string|max:500',
            'cta.primaryButton.text' => 'required|string|max:255',
            'cta.primaryButton.url' => 'required|string|max:500',
            'cta.primaryButton.ariaLabel' => 'required|string|max:255',
            'cta.secondaryButton.text' => 'required|string|max:255',
            'cta.secondaryButton.url' => 'required|string|max:500',
            'cta.secondaryButton.ariaLabel' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        // Process shapes
        $shapesData = [];
        foreach ($validatedData['shapes'] ?? [] as $index => $shape) {
            $shapeData = [
                'id' => $index + 1,
                'type' => $shape['type'],
                'position' => $shape['position'],
                'animationDuration' => $shape['animationDuration'],
            ];

            if ($shape['type'] === 'image') {
                // Handle shape file upload
                if ($request->hasFile("shapes.{$index}.src")) {
                    $shapeFile = $request->file("shapes.{$index}.src");
                    $shapePath = $shapeFile->store('team/shapes', 'public');
                    $shapeData['src'] = 'storage/' . $shapePath;
                } else {
                    // Keep existing shape or use default
                    $existingShapes = $section ? json_decode($section->content, true)['shapes'] ?? [] : [];
                    $existingShape = $existingShapes[$index] ?? null;
                    $shapeData['src'] = $existingShape['src'] ?? $defaultContent['shapes'][$index]['src'] ?? 'assets/images/shape-default.svg';
                }
                $shapeData['alt'] = $shape['alt'];
            } else {
                $shapeData['size'] = $shape['size'];
                $shapeData['opacity'] = $shape['opacity'];
            }

            $shapesData[] = $shapeData;
        }

        // Process team members
        $teamMembersData = [];
        foreach ($validatedData['teamMembers'] as $index => $member) {
            $memberData = [
                'id' => $index + 1,
                'name' => $member['name'],
                'title' => $member['title'],
                'description' => $member['description'],
                'alt' => $member['alt'],
                'socialLinks' => []
            ];

            // Handle team member image upload
            if ($request->hasFile("teamMembers.{$index}.image")) {
                $imageFile = $request->file("teamMembers.{$index}.image");
                $imagePath = $imageFile->store('team/members', 'public');
                $memberData['image'] = 'storage/' . $imagePath;
            } else {
                // Keep existing image or use default
                $existingMembers = $section ? json_decode($section->content, true)['teamMembers'] ?? [] : [];
                $existingMember = $existingMembers[$index] ?? null;
                $memberData['image'] = $existingMember['image'] ?? $defaultContent['teamMembers'][$index]['image'] ?? 'assets/images/team-member-default.jpg';
            }

            // Process social links
            foreach ($member['socialLinks'] as $linkIndex => $link) {
                $memberData['socialLinks'][] = [
                    'id' => $linkIndex + 1,
                    'platform' => $link['platform'],
                    'url' => $link['url'],
                    'ariaLabel' => $link['ariaLabel']
                ];
            }

            $teamMembersData[] = $memberData;
        }

        $content = [
            'sectionHeading' => $validatedData['sectionHeading'],
            'sectionDescription' => $validatedData['sectionDescription'],
            'shapes' => $shapesData,
            'teamMembers' => $teamMembersData,
            'cta' => [
                'heading' => $validatedData['cta']['heading'],
                'description' => $validatedData['cta']['description'],
                'primaryButton' => [
                    'text' => $validatedData['cta']['primaryButton']['text'],
                    'url' => $validatedData['cta']['primaryButton']['url'],
                    'ariaLabel' => $validatedData['cta']['primaryButton']['ariaLabel']
                ],
                'secondaryButton' => [
                    'text' => $validatedData['cta']['secondaryButton']['text'],
                    'url' => $validatedData['cta']['secondaryButton']['url'],
                    'ariaLabel' => $validatedData['cta']['secondaryButton']['ariaLabel']
                ]
            ]
        ];

        $sectionData = [
            'name' => 'Team Section',
            'description' => 'Team members section content',
            'section_type' => 'TEAM',
            'content' => json_encode($content),
            'status' => 'ACTIVE',
            'author' => Auth::user()->id,
            'last_modified_by' => Auth::user()->id,
        ];

        if ($section) {
            $section->update($sectionData);
        } else {
            Section::create($sectionData);
        }

        return redirect()->route('management.team-section')
            ->with('success', 'Team section updated successfully!');
    }


    public function project_section(Request $request)
    {
        // Use the scope method for safer querying
        $section = Section::ofType('PROJECT')->first();

        // Default content structure
        $defaultContent = $this->getDefaultProjectsContent();

        if (!$section) {
            $projectsData = $defaultContent;
        } else {
            // Safely decode the content with null coalescing
            $projectsData = $section->content ?? $defaultContent;
        }

        if ($request->isMethod('post')) {
            return $this->handleProjectSectionUpdate($request, $section, $defaultContent);
        }

        return view('pages.website.project', compact('projectsData'));
    }

    private function getDefaultProjectsContent()
    {
        return [
            'title' => 'Projects Section',
            'headline' => 'Success Stories: Marketeers We\'ve Empowered',
            'subheadline' => 'Discover how our loan solutions have helped marketing professionals and businesses achieve remarkable growth and success in their campaigns and operations.',
            'order' => 0,
            'status' => 'ACTIVE',
            'categories' => [
                1 => [
                    'name' => 'Marketing Campaigns',
                    'slug' => 'campaign'
                ],
                2 => [
                    'name' => 'Business Expansion',
                    'slug' => 'expansion'
                ],
                3 => [
                    'name' => 'Startup Funding',
                    'slug' => 'startup'
                ],
                4 => [
                    'name' => 'Growth Capital',
                    'slug' => 'growth'
                ]
            ],
            'projects' => [
                1 => [
                    'title' => 'Social Media Blitz Campaign',
                    'loan' => 'ZMW25K Campaign Loan',
                    'result' => '300% ROI achieved in 3 months',
                    'alt' => 'Social Media Campaign Success',
                    'categories' => ['campaign'],
                    'image' => null
                ],
                2 => [
                    'title' => 'E-commerce Platform Launch',
                    'loan' => 'ZMW 50K Business Loan',
                    'result' => '500+ new customers acquired',
                    'alt' => 'E-commerce Platform Success',
                    'categories' => ['expansion', 'startup'],
                    'image' => null
                ],
                3 => [
                    'title' => 'Digital Marketing Agency Growth',
                    'loan' => '$100K Growth Capital',
                    'result' => 'Revenue increased by 250%',
                    'alt' => 'Marketing Agency Growth',
                    'categories' => ['growth', 'expansion'],
                    'image' => null
                ],
                4 => [
                    'title' => 'Content Marketing Initiative',
                    'loan' => '$35K Content Loan',
                    'result' => 'Brand awareness increased by 400%',
                    'alt' => 'Content Marketing Success',
                    'categories' => ['campaign'],
                    'image' => null
                ]
            ],
            'cta_headline' => 'Ready to create your success story?',
            'cta_subheadline' => 'Join hundreds of marketeers who have transformed their businesses with our loans',
            'cta_primary_text' => 'Apply for Funding',
            'cta_secondary_text' => 'View All Case Studies',
            'background_shapes' => [
                [
                    'id' => 1,
                    'type' => 'circle',
                    'size' => '150px',
                    'opacity' => '0.1',
                    'position' => 'top: 10%; left: 5%;',
                    'animationDuration' => '3s'
                ],
                [
                    'id' => 2,
                    'type' => 'circle',
                    'size' => '80px',
                    'opacity' => '0.1',
                    'position' => 'top: 15%; right: 5%;',
                    'animationDuration' => '3.5s'
                ],
                [
                    'id' => 3,
                    'type' => 'circle',
                    'size' => '70px',
                    'opacity' => '0.1',
                    'position' => 'top: 20%; left: 10%;',
                    'animationDuration' => '4s'
                ]
            ]
        ];
    }

    private function handleProjectSectionUpdate(Request $request, $section, $defaultContent)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'headline' => 'required|string|max:100',
            'subheadline' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:ACTIVE,INACTIVE,DRAFT',

            // Categories validation
            'categories' => 'required|array|min:1',
            'categories.*.name' => 'required|string|max:50',
            'categories.*.slug' => 'required|string|max:20',

            // Projects validation
            'projects' => 'required|array|min:1',
            'projects.*.title' => 'required|string|max:100',
            'projects.*.loan' => 'nullable|string|max:100',
            'projects.*.result' => 'nullable|string|max:200',
            'projects.*.alt' => 'nullable|string|max:200',
            'projects.*.categories' => 'required|array|min:1',
            'projects.*.categories.*' => 'string|max:20',
            'projects.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // CTA validation
            'cta_headline' => 'nullable|string|max:100',
            'cta_subheadline' => 'nullable|string|max:300',
            'cta_primary_text' => 'nullable|string|max:50',
            'cta_secondary_text' => 'nullable|string|max:50',
        ], [
            // 'categories.*.slug.regex' => 'Category slug must contain only lowercase letters, numbers, and hyphens.',
            'projects.*.image.image' => 'The project image must be a valid image file.',
            'projects.*.image.mimes' => 'The project image must be a JPEG, PNG, JPG, or WebP file.',
            'projects.*.image.max' => 'The project image must not be larger than 2MB.',
            'projects.*.categories.required' => 'Each project must have at least one category.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        try {
            // Process categories
            $categoriesData = [];
            foreach ($validatedData['categories'] as $index => $category) {
                if (!empty($category['name']) && !empty($category['slug'])) {
                    $categoriesData[$index] = [
                        'name' => $category['name'],
                        'slug' => Str::slug($category['slug'])
                    ];
                }
            }

            // Process projects
            $projectsData = [];
            foreach ($validatedData['projects'] as $index => $project) {
                if (!empty($project['title'])) {
                    $projectData = [
                        'title' => $project['title'],
                        'loan' => $project['loan'] ?? '',
                        'result' => $project['result'] ?? '',
                        'alt' => $project['alt'] ?? $project['title'],
                        'categories' => $project['categories'] ?? []
                    ];

                    // Handle project image upload
                    if ($request->hasFile("projects.{$index}.image")) {
                        $imageFile = $request->file("projects.{$index}.image");

                        // Delete old image if exists
                        if ($section) {
                            $existingProjects = $section->content['projects'] ?? [];
                            $existingImage = $existingProjects[$index]['image'] ?? null;
                            if ($existingImage && Storage::disk('public')->exists($existingImage)) {
                                Storage::disk('public')->delete($existingImage);
                            }
                        }

                        // Store new image
                        $imagePath = $imageFile->store('projects', 'public');
                        $projectData['image'] = $imagePath;
                    } else {
                        // Keep existing image
                        if ($section) {
                            $existingProjects = $section->content['projects'] ?? [];
                            $projectData['image'] = $existingProjects[$index]['image'] ?? null;
                        } else {
                            $projectData['image'] = null;
                        }
                    }

                    $projectsData[$index] = $projectData;
                }
            }

            // Build final content array
            $content = [
                'title' => $validatedData['title'],
                'headline' => $validatedData['headline'],
                'subheadline' => $validatedData['subheadline'] ?? '',
                'order' => $validatedData['order'] ?? 0,
                'status' => $validatedData['status'],
                'categories' => $categoriesData,
                'projects' => $projectsData,
                'cta_headline' => $validatedData['cta_headline'] ?? '',
                'cta_subheadline' => $validatedData['cta_subheadline'] ?? '',
                'cta_primary_text' => $validatedData['cta_primary_text'] ?? '',
                'cta_secondary_text' => $validatedData['cta_secondary_text'] ?? '',
                'background_shapes' => $defaultContent['background_shapes'] // Use default shapes
            ];

            // Prepare section data for database
            $sectionData = [
                'name' => 'Projects Section',
                'description' => 'Success stories and projects showcase section',
                'section_type' => 'PROJECT',
                'content' => $content,
                'status' => 'ACTIVE',
                'author' => Auth::id(),
                'last_modified_by' => Auth::id(),
            ];

            // Create or update section
            if ($section) {
                $section->update($sectionData);
            } else {
                Section::create($sectionData);
            }

            return redirect()->route('management.project-section')
                ->with('success', 'Projects section updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating projects section: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to update projects section. Please try again.')
                ->withInput();
        }
    }

    /**
     * Delete a project image
     */
    public function deleteProjectImage(Request $request, $projectIndex)
    {
        try {
            $section = Section::ofType('PROJECTS')->first();

            if (!$section) {
                return response()->json([
                    'success' => false,
                    'message' => 'Projects section not found'
                ], 404);
            }

            $projectsData = $section->content;

            if (isset($projectsData['projects'][$projectIndex]['image'])) {
                $imagePath = $projectsData['projects'][$projectIndex]['image'];

                // Delete from storage
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Remove from data
                unset($projectsData['projects'][$projectIndex]['image']);

                // Save updated data
                $section->update([
                    'content' => $projectsData,
                    'last_modified_by' => Auth::id()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Image not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting project image: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image'
            ], 500);
        }
    }

    /**
     * Get projects data for API
     */
    public function getProjectsData()
    {
        try {
            $section = Section::ofType('PROJECTS')->first();

            if (!$section) {
                // Return default content if no section exists
                return response()->json([
                    'success' => true,
                    'data' => $this->getDefaultProjectsContent()
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $section->content
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching projects data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch projects data'
            ], 500);
        }
    }

    /**
     * Initialize projects section with default data
     */
    public function initializeProjectsSection()
    {
        try {
            $section = Section::ofType('PROJECTS')->first();

            if (!$section) {
                Section::create([
                    'name' => 'Projects Section',
                    'description' => 'Success stories and projects showcase section',
                    'section_type' => 'PROJECTS',
                    'content' => $this->getDefaultProjectsContent(),
                    'status' => 'active',
                    'author' => Auth::id(),
                    'last_modified_by' => Auth::id(),
                ]);

                return redirect()->route('admin.projects.show')
                    ->with('success', 'Projects section initialized with default data!');
            }

            return redirect()->route('admin.projects.show')
                ->with('info', 'Projects section already exists.');
        } catch (\Exception $e) {
            Log::error('Error initializing projects section: ' . $e->getMessage());

            return redirect()->route('admin.projects.show')
                ->with('error', 'Failed to initialize projects section.');
        }
    }


    // Testimonials Section
    public function testimonial_section(Request $request)
    {
        $section = Section::ofType('TESTIMONIALS')->first();

        // Default content structure
        $defaultContent = $this->getDefaultTestimonialsContent();

        if (!$section) {
            $testimonialsData = $defaultContent;
        } else {
            $testimonialsData = $section->content ?? $defaultContent;
        }

        if ($request->isMethod('post')) {
            return $this->handleTestimonialSectionUpdate($request, $section, $defaultContent);
        }

        return view('pages.website.testimonials', compact('testimonialsData'));
    }

    // Add this new method for photo deletion
    public function deletePhoto($index)
    {
        try {
            $section = Section::ofType('TESTIMONIALS')->first();

            if (!$section) {
                return response()->json([
                    'success' => false,
                    'message' => 'Section not found'
                ], 404);
            }

            $content = $section->content;
            $testimonials = $content['testimonials'] ?? [];

            if (isset($testimonials[$index]['photo'])) {
                $photoPath = $testimonials[$index]['photo'];

                // Delete from storage
                if (Storage::disk('public')->exists($photoPath)) {
                    Storage::disk('public')->delete($photoPath);
                }

                // Remove photo reference from content
                $testimonials[$index]['photo'] = null;
                $content['testimonials'] = $testimonials;

                // Update section
                $section->update([
                    'content' => $content,
                    'last_modified_by' => Auth::id()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Photo deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Photo not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting testimonial photo: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete photo'
            ], 500);
        }
    }

    private function getDefaultTestimonialsContent()
    {
        return [
            'title' => 'Testimonials Section',
            'headline' => 'What Our Marketeers Say',
            'subheadline' => 'Hear from marketing professionals and entrepreneurs who have transformed their businesses with our funding solutions.',
            'order' => 0,
            'status' => 'ACTIVE',
            'testimonials' => [
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Owner @SocialBoost Agency',
                    'content' => 'Londa Loans funded our social media campaign when traditional banks said no. The $25,000 loan helped us launch a campaign that generated over $75,000 in new business in just 3 months.',
                    'rating' => '5',
                    'photo' => null
                ],
                [
                    'name' => 'Michael Chen',
                    'position' => 'Marketing Director @GrowthHackers',
                    'content' => 'The flexible repayment terms and quick approval process made all the difference for our agency. We were able to scale our operations and take on bigger clients immediately.',
                    'rating' => '5',
                    'photo' => null
                ],
                [
                    'name' => 'Emily Rodriguez',
                    'position' => 'Founder @ContentCreators Co',
                    'content' => 'As a startup in the marketing space, finding funding was challenging until we discovered Londa Loans. Their understanding of marketing businesses made the entire process smooth and efficient.',
                    'rating' => '4',
                    'photo' => null
                ]
            ],
            'indicators' => [
                [
                    'value' => '500+',
                    'label' => 'Marketing Campaigns Funded'
                ],
                [
                    'value' => '98%',
                    'label' => 'Client Satisfaction Rate'
                ],
                [
                    'value' => '$25M+',
                    'label' => 'Total Funding Provided'
                ],
                [
                    'value' => '24h',
                    'label' => 'Average Approval Time'
                ]
            ],
            'cta_headline' => 'Join hundreds of successful marketeers',
            'cta_subheadline' => 'Get the funding you need to take your marketing business to the next level',
            'cta_primary_text' => 'Apply Now',
            'cta_secondary_text' => 'Read More Reviews',
            'background_shapes' => [
                [
                    'id' => 1,
                    'type' => 'circle',
                    'size' => '150px',
                    'opacity' => '0.1',
                    'position' => 'top: 10%; left: 5%;',
                    'animationDuration' => '3s'
                ],
                [
                    'id' => 2,
                    'type' => 'circle',
                    'size' => '80px',
                    'opacity' => '0.1',
                    'position' => 'top: 15%; right: 5%;',
                    'animationDuration' => '3.5s'
                ],
                [
                    'id' => 3,
                    'type' => 'circle',
                    'size' => '70px',
                    'opacity' => '0.1',
                    'position' => 'top: 20%; left: 10%;',
                    'animationDuration' => '4s'
                ],
                [
                    'id' => 4,
                    'type' => 'circle',
                    'size' => '90px',
                    'opacity' => '0.1',
                    'position' => 'bottom: 10%; right: 15%;',
                    'animationDuration' => '3.8s'
                ],
                [
                    'id' => 5,
                    'type' => 'circle',
                    'size' => '85px',
                    'opacity' => '0.1',
                    'position' => 'bottom: 15%; left: 10%;',
                    'animationDuration' => '4.2s'
                ]
            ]
        ];
    }

    private function handleTestimonialSectionUpdate(Request $request, $section, $defaultContent)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'headline' => 'required|string|max:100',
            'subheadline' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:ACTIVE,INACTIVE,DRAFT',

            // Testimonials validation
            'testimonials' => 'required|array|min:1',
            'testimonials.*.name' => 'required|string|max:100',
            'testimonials.*.position' => 'nullable|string|max:200',
            'testimonials.*.content' => 'required|string|max:1000',
            'testimonials.*.rating' => 'required|in:1,2,3,4,5',
            'testimonials.*.photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Indicators validation
            'indicators' => 'array',
            'indicators.*.value' => 'nullable|string|max:20',
            'indicators.*.label' => 'nullable|string|max:100',

            // CTA validation
            'cta_headline' => 'nullable|string|max:100',
            'cta_subheadline' => 'nullable|string|max:300',
            'cta_primary_text' => 'nullable|string|max:50',
            'cta_secondary_text' => 'nullable|string|max:50',
        ], [
            'testimonials.*.photo.image' => 'The client photo must be a valid image file.',
            'testimonials.*.photo.mimes' => 'The client photo must be a JPEG, PNG, JPG, or WebP file.',
            'testimonials.*.photo.max' => 'The client photo must not be larger than 2MB.',
            'testimonials.required' => 'At least one testimonial is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        try {
            // Process testimonials
            $testimonialsData = [];
            foreach ($validatedData['testimonials'] as $index => $testimonial) {
                if (!empty($testimonial['name']) && !empty($testimonial['content'])) {
                    $testimonialData = [
                        'name' => $testimonial['name'],
                        'position' => $testimonial['position'] ?? '',
                        'content' => $testimonial['content'],
                        'rating' => $testimonial['rating']
                    ];

                    // Handle testimonial photo upload
                    if ($request->hasFile("testimonials.{$index}.photo")) {
                        $photoFile = $request->file("testimonials.{$index}.photo");

                        // Validate file is valid
                        if ($photoFile->isValid()) {
                            // Delete old photo if exists
                            if ($section) {
                                $existingTestimonials = $section->content['testimonials'] ?? [];
                                $existingPhoto = $existingTestimonials[$index]['photo'] ?? null;
                                if ($existingPhoto && Storage::disk('public')->exists($existingPhoto)) {
                                    Storage::disk('public')->delete($existingPhoto);
                                }
                            }

                            // Store new photo with unique name
                            $photoName = 'testimonial_' . $index . '_' . time() . '.' . $photoFile->getClientOriginalExtension();
                            $photoPath = $photoFile->storeAs('testimonials/photos', $photoName, 'public');
                            $testimonialData['photo'] = $photoPath;
                        }
                    } else {
                        // Keep existing photo
                        if ($section) {
                            $existingTestimonials = $section->content['testimonials'] ?? [];
                            $testimonialData['photo'] = $existingTestimonials[$index]['photo'] ?? null;
                        } else {
                            $testimonialData['photo'] = null;
                        }
                    }

                    $testimonialsData[] = $testimonialData;
                }
            }

            // Process indicators
            $indicatorsData = [];
            foreach ($validatedData['indicators'] ?? [] as $index => $indicator) {
                if (!empty($indicator['value']) && !empty($indicator['label'])) {
                    $indicatorsData[] = [
                        'value' => $indicator['value'],
                        'label' => $indicator['label']
                    ];
                }
            }

            // Build final content array
            $content = [
                'title' => $validatedData['title'],
                'headline' => $validatedData['headline'],
                'subheadline' => $validatedData['subheadline'] ?? '',
                'order' => $validatedData['order'] ?? 0,
                'status' => $validatedData['status'],
                'testimonials' => $testimonialsData,
                'indicators' => $indicatorsData,
                'cta_headline' => $validatedData['cta_headline'] ?? '',
                'cta_subheadline' => $validatedData['cta_subheadline'] ?? '',
                'cta_primary_text' => $validatedData['cta_primary_text'] ?? '',
                'cta_secondary_text' => $validatedData['cta_secondary_text'] ?? '',
                'background_shapes' => $defaultContent['background_shapes']
            ];

            // Prepare section data for database
            $sectionData = [
                'name' => 'Testimonials Section',
                'description' => 'Customer testimonials and reviews section',
                'section_type' => 'TESTIMONIALS',
                'content' => $content,
                'status' => 'ACTIVE',
                'author' => Auth::id(),
                'last_modified_by' => Auth::id(),
            ];

            // Create or update section
            if ($section) {
                $section->update($sectionData);
            } else {
                Section::create($sectionData);
            }

            return redirect()->route('management.testimonial-section')
                ->with('success', 'Testimonials section updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating testimonials section: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to update testimonials section. Please try again.')
                ->withInput();
        }
    }
    /**
     * Get testimonials data for API
     */
    public function getTestimonialsData()
    {
        try {
            $section = Section::ofType('TESTIMONIALS')->first();

            if (!$section) {
                // Return default content if no section exists
                return response()->json([
                    'success' => true,
                    'data' => $this->getDefaultTestimonialsContent()
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $section->content
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching testimonials data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch testimonials data'
            ], 500);
        }
    }

    /**
     * Initialize testimonials section with default data
     */
    public function initializeTestimonialsSection()
    {
        try {
            $section = Section::ofType('TESTIMONIALS')->first();

            if (!$section) {
                Section::create([
                    'name' => 'Testimonials Section',
                    'description' => 'Customer testimonials and reviews section',
                    'section_type' => 'TESTIMONIALS',
                    'content' => $this->getDefaultTestimonialsContent(),
                    'status' => 'ACTIVE',
                    'author' => Auth::id(),
                    'last_modified_by' => Auth::id(),
                ]);

                return redirect()->route('pages.website.testimonials')
                    ->with('success', 'Testimonials section initialized with default data!');
            }

            return redirect()->route('pages.website.testimonials')
                ->with('info', 'Testimonials section already exists.');
        } catch (\Exception $e) {
            Log::error('Error initializing testimonials section: ' . $e->getMessage());

            return redirect()->route('pages.website.testimonials')
                ->with('error', 'Failed to initialize testimonials section.');
        }
    }

    // Counter Section
    public function counter_section(Request $request)
    {
        // Get or create counter section data
        $section = Section::where('section_type', 'COUNTER')->first();

        if (!$section) {
            $defaultContent = [
                'title' => 'Counter Section',
                'headline' => 'Our Impact in Numbers',
                'subheadline' => 'Real results for marketing professionals and entrepreneurs',
                'order' => 0,
                'status' => 'ACTIVE',
                'main_stats' => [
                    [
                        'value' => '500+',
                        'label' => 'Marketing Campaigns Funded',
                        'animation_delay' => '0.1'
                    ],
                    [
                        'value' => '$25M+',
                        'label' => 'Total Funding Provided',
                        'animation_delay' => '0.2'
                    ],
                    [
                        'value' => '98%',
                        'label' => 'Client Satisfaction Rate',
                        'animation_delay' => '0.3'
                    ],
                    [
                        'value' => '24h',
                        'label' => 'Average Approval Time',
                        'animation_delay' => '0.4'
                    ]
                ],
                'mini_stats' => [
                    [
                        'value' => '300%',
                        'label' => 'Average ROI for Funded Campaigns',
                        'animation_delay' => '0.5'
                    ],
                    [
                        'value' => '150+',
                        'label' => 'Cities Served Nationwide',
                        'animation_delay' => '0.6'
                    ],
                    [
                        'value' => '4.9/5',
                        'label' => 'Customer Rating',
                        'animation_delay' => '0.7'
                    ]
                ],
                'cta_headline' => 'Ready to join our success stories?',
                'cta_subheadline' => 'Start your application and become our next success story',
                'cta_primary_text' => 'Apply Now',
                'cta_secondary_text' => 'Calculate Loan',
                'background_shapes' => [
                    [
                        'id' => 1,
                        'type' => 'circle',
                        'size' => '150px',
                        'opacity' => '0.1',
                        'position' => 'top: 10%; left: 5%;',
                        'animationDuration' => '3s'
                    ],
                    [
                        'id' => 2,
                        'type' => 'circle',
                        'size' => '80px',
                        'opacity' => '0.1',
                        'position' => 'top: 15%; right: 5%;',
                        'animationDuration' => '3.5s'
                    ],
                    [
                        'id' => 3,
                        'type' => 'circle',
                        'size' => '70px',
                        'opacity' => '0.1',
                        'position' => 'top: 20%; left: 10%;',
                        'animationDuration' => '4s'
                    ]
                ]
            ];

            $section = Section::create([
                'name' => 'Counter Section',
                'description' => 'Impact numbers and statistics section',
                'section_type' => 'COUNTER',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:100',
                'headline' => 'required|string|max:100',
                'subheadline' => 'nullable|string|max:500',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT',

                // Main stats validation
                'main_stats' => 'required|array|min:1',
                'main_stats.*.value' => 'required|string|max:20',
                'main_stats.*.label' => 'required|string|max:100',
                'main_stats.*.animation_delay' => 'required|string|in:0.1,0.2,0.3,0.4',

                // Mini stats validation
                'mini_stats' => 'sometimes|array',
                'mini_stats.*.value' => 'required|string|max:20',
                'mini_stats.*.label' => 'required|string|max:100',
                'mini_stats.*.animation_delay' => 'required|string|in:0.5,0.6,0.7',

                // CTA validation
                'cta_headline' => 'nullable|string|max:100',
                'cta_subheadline' => 'nullable|string|max:300',
                'cta_primary_text' => 'nullable|string|max:50',
                'cta_secondary_text' => 'nullable|string|max:50',
            ], [
                'main_stats.required' => 'At least one main statistic is required.',
                'main_stats.*.value.required' => 'Main statistic value is required.',
                'main_stats.*.label.required' => 'Main statistic label is required.',
                'mini_stats.*.value.required' => 'Mini statistic value is required when provided.',
                'mini_stats.*.label.required' => 'Mini statistic label is required when provided.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validatedData = $validator->validated();

            try {
                // Process main stats
                $mainStats = [];
                foreach ($validatedData['main_stats'] as $index => $stat) {
                    if (!empty($stat['value']) && !empty($stat['label'])) {
                        $mainStats[] = [
                            'value' => $stat['value'],
                            'label' => $stat['label'],
                            'animation_delay' => $stat['animation_delay']
                        ];
                    }
                }

                // Process mini stats
                $miniStats = [];
                foreach ($validatedData['mini_stats'] ?? [] as $index => $stat) {
                    if (!empty($stat['value']) && !empty($stat['label'])) {
                        $miniStats[] = [
                            'value' => $stat['value'],
                            'label' => $stat['label'],
                            'animation_delay' => $stat['animation_delay']
                        ];
                    }
                }

                // Get current content - ensure it's an array
                $currentContent = $this->getContentAsArray($section->content);

                $counterData = array_merge($currentContent, [
                    'title' => $validatedData['title'],
                    'headline' => $validatedData['headline'],
                    'subheadline' => $validatedData['subheadline'] ?? '',
                    'order' => $validatedData['order'] ?? 0,
                    'status' => $validatedData['status'],
                    'main_stats' => $mainStats,
                    'mini_stats' => $miniStats,
                    'cta_headline' => $validatedData['cta_headline'] ?? '',
                    'cta_subheadline' => $validatedData['cta_subheadline'] ?? '',
                    'cta_primary_text' => $validatedData['cta_primary_text'] ?? '',
                    'cta_secondary_text' => $validatedData['cta_secondary_text'] ?? '',
                ]);

                $section->update([
                    'content' => $counterData,
                    'last_modified_by' => Auth::user()->name ?? 'admin'
                ]);

                return redirect()->back()->with('success', 'Counter section updated successfully.');
            } catch (\Exception $e) {
                Log::error('Error updating counter section: ' . $e->getMessage());

                return redirect()->back()
                    ->with('error', 'Failed to update counter section. Please try again.')
                    ->withInput();
            }
        }

        // Ensure content is always returned as array
        $counterData = $this->getContentAsArray($section->content);

        return view('pages.website.counter', [
            'counterData' => $counterData,
            'section' => $section
        ]);
    }

    /**
     * Delete counter section image (if applicable)
     */
    public function deleteCounterImage(Request $request)
    {
        try {
            $section = Section::where('section_type', 'COUNTER')->first();

            if (!$section) {
                return response()->json([
                    'success' => false,
                    'message' => 'Counter section not found'
                ], 404);
            }

            $counterData = $this->getContentAsArray($section->content);

            if (isset($counterData['background_image'])) {
                $imagePath = $counterData['background_image'];

                // Delete from storage
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Remove from data
                unset($counterData['background_image']);

                // Save updated data
                $section->update([
                    'content' => $counterData,
                    'last_modified_by' => Auth::user()->name ?? 'admin'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Background image deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No background image found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting counter image: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete background image'
            ], 500);
        }
    }

    /**
     * Get counter data for API
     */
    public function getCounterData()
    {
        try {
            $section = Section::where('section_type', 'COUNTER')->first();

            if (!$section) {
                return response()->json([
                    'success' => false,
                    'message' => 'Counter section not found'
                ], 404);
            }

            $counterData = $this->getContentAsArray($section->content);

            return response()->json([
                'success' => true,
                'data' => $counterData
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching counter data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch counter data'
            ], 500);
        }
    }

    /**
     * Initialize counter section with default data
     */
    public function initializeCounterSection()
    {
        try {
            $section = Section::where('section_type', 'COUNTER')->first();

            if (!$section) {
                $defaultContent = [
                    'title' => 'Counter Section',
                    'headline' => 'Our Impact in Numbers',
                    'subheadline' => 'Real results for marketing professionals and entrepreneurs',
                    'order' => 0,
                    'status' => 'ACTIVE',
                    'main_stats' => [
                        [
                            'value' => '500+',
                            'label' => 'Marketing Campaigns Funded',
                            'animation_delay' => '0.1'
                        ],
                        [
                            'value' => '$25M+',
                            'label' => 'Total Funding Provided',
                            'animation_delay' => '0.2'
                        ],
                        [
                            'value' => '98%',
                            'label' => 'Client Satisfaction Rate',
                            'animation_delay' => '0.3'
                        ],
                        [
                            'value' => '24h',
                            'label' => 'Average Approval Time',
                            'animation_delay' => '0.4'
                        ]
                    ],
                    'mini_stats' => [
                        [
                            'value' => '300%',
                            'label' => 'Average ROI for Funded Campaigns',
                            'animation_delay' => '0.5'
                        ],
                        [
                            'value' => '150+',
                            'label' => 'Cities Served Nationwide',
                            'animation_delay' => '0.6'
                        ],
                        [
                            'value' => '4.9/5',
                            'label' => 'Customer Rating',
                            'animation_delay' => '0.7'
                        ]
                    ],
                    'cta_headline' => 'Ready to join our success stories?',
                    'cta_subheadline' => 'Start your application and become our next success story',
                    'cta_primary_text' => 'Apply Now',
                    'cta_secondary_text' => 'Calculate Loan'
                ];

                Section::create([
                    'name' => 'Counter Section',
                    'description' => 'Impact numbers and statistics section',
                    'section_type' => 'COUNTER',
                    'status' => 'ACTIVE',
                    'content' => $defaultContent,
                    'published_at' => now(),
                    'author' => Auth::user()->name ?? 'admin',
                    'last_modified_by' => Auth::user()->name ?? 'admin'
                ]);

                return redirect()->route('admin.counter.show')
                    ->with('success', 'Counter section initialized with default data!');
            }

            return redirect()->route('admin.counter.show')
                ->with('info', 'Counter section already exists.');
        } catch (\Exception $e) {
            Log::error('Error initializing counter section: ' . $e->getMessage());

            return redirect()->route('admin.counter.show')
                ->with('error', 'Failed to initialize counter section.');
        }
    }

    public function client_section(Request $request)
    {
        // Get or create client section data
        $section = Section::where('section_type', 'CLIENT')->first();

        if (!$section) {
            $defaultContent = [
                'headline' => 'Trusted by Marketing Professionals',
                'subheadline' => "We're proud to support marketing agencies, content creators, and entrepreneurs who are driving innovation and growth in their industries.",
                'clients' => [
                    [
                        'name' => 'SocialBoost',
                        'description' => 'Marketing Agency',
                        'url' => '#!',
                        'animation_delay' => '0.1'
                    ],
                    [
                        'name' => 'ContentCraft',
                        'description' => 'Content Creators',
                        'url' => '#!',
                        'animation_delay' => '0.2'
                    ],
                    [
                        'name' => 'GrowthGurus',
                        'description' => 'Digital Marketing',
                        'url' => '#!',
                        'animation_delay' => '0.3'
                    ],
                    [
                        'name' => 'BrandBuilders',
                        'description' => 'Brand Agency',
                        'url' => '#!',
                        'animation_delay' => '0.4'
                    ],
                    [
                        'name' => 'AdVenture',
                        'description' => 'Advertising',
                        'url' => '#!',
                        'animation_delay' => '0.5'
                    ],
                    [
                        'name' => 'MarketMasters',
                        'description' => 'Consulting',
                        'url' => '#!',
                        'animation_delay' => '0.6'
                    ]
                ],
                'highlights' => [
                    [
                        'amount' => '$25K',
                        'client' => 'SocialBoost Agency',
                        'result' => 'Campaign funding led to 300% ROI',
                        'color' => '#db9123',
                        'animation_delay' => '0.7'
                    ],
                    [
                        'amount' => '$50K',
                        'client' => 'ContentCraft Studios',
                        'result' => 'Expansion funding for new content division',
                        'color' => '#7a4603',
                        'animation_delay' => '0.8'
                    ],
                    [
                        'amount' => '$15K',
                        'client' => 'GrowthGurus Inc',
                        'result' => 'Seed funding for marketing automation tool',
                        'color' => '#db9123',
                        'animation_delay' => '0.9'
                    ]
                ],
                'cta' => [
                    'headline' => 'Ready to join our growing community?',
                    'subheadline' => 'Get the funding you need to scale your marketing business',
                    'primary_text' => 'Start Your Application',
                    'secondary_text' => 'View Client Stories'
                ]
            ];

            $section = Section::create([
                'name' => 'Client Section',
                'description' => 'Client logos and success stories section',
                'section_type' => 'CLIENT',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                // Main content
                'headline' => 'required|string|max:100',
                'subheadline' => 'nullable|string|max:500',

                // Client logos (6 clients)
                'client_1_name' => 'required|string|max:50',
                'client_1_description' => 'nullable|string|max:100',
                'client_1_url' => 'nullable|string|max:255',
                'client_1_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                'client_2_name' => 'required|string|max:50',
                'client_2_description' => 'nullable|string|max:100',
                'client_2_url' => 'nullable|string|max:255',
                'client_2_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                'client_3_name' => 'required|string|max:50',
                'client_3_description' => 'nullable|string|max:100',
                'client_3_url' => 'nullable|string|max:255',
                'client_3_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                'client_4_name' => 'required|string|max:50',
                'client_4_description' => 'nullable|string|max:100',
                'client_4_url' => 'nullable|string|max:255',
                'client_4_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                'client_5_name' => 'required|string|max:50',
                'client_5_description' => 'nullable|string|max:100',
                'client_5_url' => 'nullable|string|max:255',
                'client_5_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                'client_6_name' => 'required|string|max:50',
                'client_6_description' => 'nullable|string|max:100',
                'client_6_url' => 'nullable|string|max:255',
                'client_6_animation_delay' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6',

                // Success highlights (3 highlights)
                'highlight_1_amount' => 'nullable|string|max:20',
                'highlight_1_client' => 'nullable|string|max:100',
                'highlight_1_result' => 'nullable|string|max:200',
                'highlight_1_color' => 'nullable|in:#db9123,#7a4603',
                'highlight_1_animation_delay' => 'nullable|in:0.7,0.8,0.9',

                'highlight_2_amount' => 'nullable|string|max:20',
                'highlight_2_client' => 'nullable|string|max:100',
                'highlight_2_result' => 'nullable|string|max:200',
                'highlight_2_color' => 'nullable|in:#db9123,#7a4603',
                'highlight_2_animation_delay' => 'nullable|in:0.7,0.8,0.9',

                'highlight_3_amount' => 'nullable|string|max:20',
                'highlight_3_client' => 'nullable|string|max:100',
                'highlight_3_result' => 'nullable|string|max:200',
                'highlight_3_color' => 'nullable|in:#db9123,#7a4603',
                'highlight_3_animation_delay' => 'nullable|in:0.7,0.8,0.9',

                // CTA section
                'cta_headline' => 'nullable|string|max:100',
                'cta_subheadline' => 'nullable|string|max:300',
                'cta_primary_text' => 'nullable|string|max:50',
                'cta_secondary_text' => 'nullable|string|max:50',

                // Section settings
                'title' => 'required|string|max:100',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT'
            ]);

            // Process client data
            $clients = [];
            for ($i = 1; $i <= 6; $i++) {
                if (!empty($data["client_{$i}_name"])) {
                    $clients[] = [
                        'name' => $data["client_{$i}_name"],
                        'description' => $data["client_{$i}_description"] ?? '',
                        'url' => $data["client_{$i}_url"] ?? '#!',
                        'animation_delay' => $data["client_{$i}_animation_delay"] ?? '0.1'
                    ];
                }
            }

            // Process success highlights
            $highlights = [];
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($data["highlight_{$i}_amount"])) {
                    $highlights[] = [
                        'amount' => $data["highlight_{$i}_amount"],
                        'client' => $data["highlight_{$i}_client"] ?? '',
                        'result' => $data["highlight_{$i}_result"] ?? '',
                        'color' => $data["highlight_{$i}_color"] ?? '#db9123',
                        'animation_delay' => $data["highlight_{$i}_animation_delay"] ?? '0.7'
                    ];
                }
            }

            // Process CTA data
            $cta = [
                'headline' => $data['cta_headline'] ?? '',
                'subheadline' => $data['cta_subheadline'] ?? '',
                'primary_text' => $data['cta_primary_text'] ?? '',
                'secondary_text' => $data['cta_secondary_text'] ?? ''
            ];

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            $clientData = array_merge($currentContent, [
                'headline' => $data['headline'],
                'subheadline' => $data['subheadline'] ?? '',
                'clients' => $clients,
                'highlights' => $highlights,
                'cta' => $cta
            ]);

            $section->update([
                'name' => $data['title'],
                'order' => $data['order'] ?? 0,
                'status' => $data['status'],
                'content' => $clientData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Client section updated successfully.');
        }

        // Ensure content is always returned as array
        $clientData = $this->getContentAsArray($section->content);

        // Transform the data structure for the view
        $formData = [
            'headline' => $clientData['headline'] ?? '',
            'subheadline' => $clientData['subheadline'] ?? '',
            'cta_headline' => $clientData['cta']['headline'] ?? '',
            'cta_subheadline' => $clientData['cta']['subheadline'] ?? '',
            'cta_primary_text' => $clientData['cta']['primary_text'] ?? '',
            'cta_secondary_text' => $clientData['cta']['secondary_text'] ?? '',
            'title' => $section->name,
            'order' => $section->order,
            'status' => $section->status
        ];

        // Add client data
        if (isset($clientData['clients'])) {
            foreach ($clientData['clients'] as $index => $client) {
                $clientNumber = $index + 1;
                $formData["client_{$clientNumber}_name"] = $client['name'] ?? '';
                $formData["client_{$clientNumber}_description"] = $client['description'] ?? '';
                $formData["client_{$clientNumber}_url"] = $client['url'] ?? '';
                $formData["client_{$clientNumber}_animation_delay"] = $client['animation_delay'] ?? '0.1';
            }
        }

        // Add highlight data
        if (isset($clientData['highlights'])) {
            foreach ($clientData['highlights'] as $index => $highlight) {
                $highlightNumber = $index + 1;
                $formData["highlight_{$highlightNumber}_amount"] = $highlight['amount'] ?? '';
                $formData["highlight_{$highlightNumber}_client"] = $highlight['client'] ?? '';
                $formData["highlight_{$highlightNumber}_result"] = $highlight['result'] ?? '';
                $formData["highlight_{$highlightNumber}_color"] = $highlight['color'] ?? '#db9123';
                $formData["highlight_{$highlightNumber}_animation_delay"] = $highlight['animation_delay'] ?? '0.7';
            }
        }

        return view('pages.website.client', [
            'form' => $formData,
            'section' => $section
        ]);
    }

    public function blog_section(Request $request)
    {
        // Get or create blog section data
        $section = Section::where('section_type', 'BLOG')->first();

        if (!$section) {
            $defaultContent = [
                'headline' => 'Financial Insights for Marketeers',
                'subheadline' => 'Expert advice and insights to help marketing professionals make smart financial decisions and grow their businesses effectively.',
                'posts' => [
                    [
                        'title' => 'How to Calculate the Right Loan Amount for Your Marketing Campaign',
                        'excerpt' => 'Learn how to determine the optimal loan amount for your marketing initiatives without over-borrowing.',
                        'author' => 'Sarah Johnson',
                        'date' => now()->format('Y-m-d'),
                        'read_time' => '5 min read',
                        'category' => 'Funding Guide',
                        'category_color' => '#db9123',
                        'alt' => 'Marketing campaign funding strategies',
                        'url' => '#!',
                        'animation_delay' => '0.1'
                    ],
                    [
                        'title' => 'The Complete Guide to Business Loans for Marketing Agencies',
                        'excerpt' => 'Everything you need to know about securing business loans specifically tailored for marketing agencies.',
                        'author' => 'Mike Chen',
                        'date' => now()->subDays(5)->format('Y-m-d'),
                        'read_time' => '7 min read',
                        'category' => 'Business Finance',
                        'category_color' => '#7a4603',
                        'alt' => 'Business loans for marketing agencies',
                        'url' => '#!',
                        'animation_delay' => '0.2'
                    ],
                    [
                        'title' => 'ROI-Focused Marketing: How to Spend Your Loan Wisely',
                        'excerpt' => 'Strategic approaches to allocate your loan funds for maximum return on investment in marketing.',
                        'author' => 'Emily Rodriguez',
                        'date' => now()->subDays(10)->format('Y-m-d'),
                        'read_time' => '6 min read',
                        'category' => 'ROI Strategy',
                        'category_color' => '#db9123',
                        'alt' => 'ROI-focused marketing strategies',
                        'url' => '#!',
                        'animation_delay' => '0.3'
                    ]
                ],
                'cta' => [
                    'headline' => 'Want more financial insights?',
                    'subheadline' => 'Explore our complete library of resources for marketing professionals',
                    'primary_text' => 'View All Articles',
                    'secondary_text' => 'Subscribe to Updates'
                ]
            ];

            $section = Section::create([
                'name' => 'Blog Section',
                'description' => 'Financial insights and blog posts section',
                'section_type' => 'BLOG',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                // Main content
                'headline' => 'required|string|max:100',
                'subheadline' => 'nullable|string|max:500',

                // Blog posts (3 posts)
                'blog_1_title' => 'required|string|max:200',
                'blog_1_excerpt' => 'required|string|max:300',
                'blog_1_author' => 'nullable|string|max:100',
                'blog_1_date' => 'nullable|date',
                'blog_1_read_time' => 'nullable|string|max:20',
                'blog_1_category' => 'nullable|string|max:50',
                'blog_1_category_color' => 'nullable|in:#db9123,#7a4603',
                'blog_1_alt' => 'nullable|string|max:200',
                'blog_1_url' => 'nullable|string|max:255',
                'blog_1_animation_delay' => 'nullable|in:0.1,0.2,0.3',
                'blog_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                'blog_2_title' => 'required|string|max:200',
                'blog_2_excerpt' => 'required|string|max:300',
                'blog_2_author' => 'nullable|string|max:100',
                'blog_2_date' => 'nullable|date',
                'blog_2_read_time' => 'nullable|string|max:20',
                'blog_2_category' => 'nullable|string|max:50',
                'blog_2_category_color' => 'nullable|in:#db9123,#7a4603',
                'blog_2_alt' => 'nullable|string|max:200',
                'blog_2_url' => 'nullable|string|max:255',
                'blog_2_animation_delay' => 'nullable|in:0.1,0.2,0.3',
                'blog_2_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                'blog_3_title' => 'required|string|max:200',
                'blog_3_excerpt' => 'required|string|max:300',
                'blog_3_author' => 'nullable|string|max:100',
                'blog_3_date' => 'nullable|date',
                'blog_3_read_time' => 'nullable|string|max:20',
                'blog_3_category' => 'nullable|string|max:50',
                'blog_3_category_color' => 'nullable|in:#db9123,#7a4603',
                'blog_3_alt' => 'nullable|string|max:200',
                'blog_3_url' => 'nullable|string|max:255',
                'blog_3_animation_delay' => 'nullable|in:0.1,0.2,0.3',
                'blog_3_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

                // CTA section
                'cta_headline' => 'nullable|string|max:100',
                'cta_subheadline' => 'nullable|string|max:300',
                'cta_primary_text' => 'nullable|string|max:50',
                'cta_secondary_text' => 'nullable|string|max:50',

                // Section settings
                'title' => 'required|string|max:100',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT'
            ]);

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            // Process blog posts
            $posts = [];
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($data["blog_{$i}_title"])) {
                    $post = [
                        'title' => $data["blog_{$i}_title"],
                        'excerpt' => $data["blog_{$i}_excerpt"],
                        'author' => $data["blog_{$i}_author"] ?? 'Sarah Johnson',
                        'date' => $data["blog_{$i}_date"] ?? now()->format('Y-m-d'),
                        'read_time' => $data["blog_{$i}_read_time"] ?? '5 min read',
                        'category' => $data["blog_{$i}_category"] ?? 'Funding Guide',
                        'category_color' => $data["blog_{$i}_category_color"] ?? '#db9123',
                        'alt' => $data["blog_{$i}_alt"] ?? $data["blog_{$i}_title"],
                        'url' => $data["blog_{$i}_url"] ?? '#!',
                        'animation_delay' => $data["blog_{$i}_animation_delay"] ?? '0.1'
                    ];

                    // Handle image upload
                    if ($request->hasFile("blog_{$i}_image")) {
                        try {
                            // Delete old image if exists
                            if (isset($currentContent['posts'][$i - 1]['image']) && Storage::exists($currentContent['posts'][$i - 1]['image'])) {
                                Storage::delete($currentContent['posts'][$i - 1]['image']);
                            }

                            $imagePath = $request->file("blog_{$i}_image")->store("blog-images", 'public');
                            $post['image'] = $imagePath;
                        } catch (\Exception $e) {
                            Log::error("Failed to upload blog {$i} image: " . $e->getMessage());
                            // Keep existing image if upload fails
                            if (isset($currentContent['posts'][$i - 1]['image'])) {
                                $post['image'] = $currentContent['posts'][$i - 1]['image'];
                            }
                        }
                    } else {
                        // Keep existing image if no new upload
                        if (isset($currentContent['posts'][$i - 1]['image'])) {
                            $post['image'] = $currentContent['posts'][$i - 1]['image'];
                        }
                    }

                    $posts[] = $post;
                }
            }

            // Process CTA data
            $cta = [
                'headline' => $data['cta_headline'] ?? '',
                'subheadline' => $data['cta_subheadline'] ?? '',
                'primary_text' => $data['cta_primary_text'] ?? '',
                'secondary_text' => $data['cta_secondary_text'] ?? ''
            ];

            $blogData = array_merge($currentContent, [
                'headline' => $data['headline'],
                'subheadline' => $data['subheadline'] ?? '',
                'posts' => $posts,
                'cta' => $cta
            ]);

            $section->update([
                'name' => $data['title'],
                'order' => $data['order'] ?? 0,
                'status' => $data['status'],
                'content' => $blogData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Blog section updated successfully.');
        }

        // Ensure content is always returned as array
        $blogData = $this->getContentAsArray($section->content);

        // Transform the data structure for the view
        $formData = [
            'headline' => $blogData['headline'] ?? '',
            'subheadline' => $blogData['subheadline'] ?? '',
            'cta_headline' => $blogData['cta']['headline'] ?? '',
            'cta_subheadline' => $blogData['cta']['subheadline'] ?? '',
            'cta_primary_text' => $blogData['cta']['primary_text'] ?? '',
            'cta_secondary_text' => $blogData['cta']['secondary_text'] ?? '',
            'title' => $section->name,
            'order' => $section->order,
            'status' => $section->status
        ];

        // Add blog post data
        if (isset($blogData['posts'])) {
            foreach ($blogData['posts'] as $index => $post) {
                $postNumber = $index + 1;
                $formData["blog_{$postNumber}_title"] = $post['title'] ?? '';
                $formData["blog_{$postNumber}_excerpt"] = $post['excerpt'] ?? '';
                $formData["blog_{$postNumber}_author"] = $post['author'] ?? '';
                $formData["blog_{$postNumber}_date"] = $post['date'] ?? '';
                $formData["blog_{$postNumber}_read_time"] = $post['read_time'] ?? '';
                $formData["blog_{$postNumber}_category"] = $post['category'] ?? '';
                $formData["blog_{$postNumber}_category_color"] = $post['category_color'] ?? '#db9123';
                $formData["blog_{$postNumber}_alt"] = $post['alt'] ?? '';
                $formData["blog_{$postNumber}_url"] = $post['url'] ?? '';
                $formData["blog_{$postNumber}_animation_delay"] = $post['animation_delay'] ?? '0.1';
                $formData["blog_{$postNumber}_image"] = $post['image'] ?? '';
            }
        }

        return view('pages.website.blog', [
            'section' => (object) $formData,
            'blogData' => $blogData
        ]);
    }

    public function contact_section(Request $request)
    {
        // Get or create contact section data
        $section = Section::where('section_type', 'CONTACT_US')->first();

        if (!$section) {
            $defaultContent = [
                'headline' => 'Get Started with Your Loan Application',
                'subheadline' => 'Ready to fund your next marketing success? Our team is here to help you navigate the loan process and find the perfect financing solution for your business.',
                'contact_info' => [
                    [
                        'title' => 'Email Address',
                        'value' => 'hello@londaloans.com',
                        'icon_color' => '#f5a623'
                    ],
                    [
                        'title' => 'Office Location',
                        'value' => '123 Business District, Marketing City, MC 10001',
                        'icon_color' => '#6b3d02'
                    ],
                    [
                        'title' => 'Phone Number',
                        'value' => '+1 (555) 123-4567',
                        'icon_color' => '#f5a623'
                    ],
                    [
                        'title' => 'Business Hours',
                        'value' => 'Mon - Fri: 9:00 AM - 6:00 PM',
                        'icon_color' => '#6b3d02'
                    ]
                ],
                'social_links' => [
                    [
                        'platform' => 'Facebook',
                        'url' => 'https://facebook.com/londaloans',
                        'color' => '#6b3d02'
                    ],
                    [
                        'platform' => 'Twitter',
                        'url' => 'https://twitter.com/londaloans',
                        'color' => '#f5a623'
                    ],
                    [
                        'platform' => 'LinkedIn',
                        'url' => 'https://linkedin.com/company/londaloans',
                        'color' => '#6b3d02'
                    ]
                ],
                'form_config' => [
                    'action' => '/submit-application',
                    'submit_text' => 'Submit Application',
                    'note' => 'One of our loan specialists will contact you within 24 hours to discuss your application.'
                ],
                'form_options' => [
                    'business_types' => [
                        'Marketing Agency',
                        'Content Creator',
                        'Digital Marketing Firm',
                        'Social Media Agency',
                        'Marketing Consultant'
                    ],
                    'loan_amounts' => [
                        '$5,000 - $25,000',
                        '$25,000 - $50,000',
                        '$50,000 - $100,000',
                        '$100,000+'
                    ],
                    'loan_purposes' => [
                        'Marketing Campaign',
                        'Business Expansion',
                        'Equipment Purchase',
                        'Team Hiring',
                        'Working Capital'
                    ]
                ]
            ];

            $section = Section::create([
                'name' => 'Contact Section',
                'description' => 'Contact and loan application section',
                'section_type' => 'CONTACT_US',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                // Main content
                'headline' => 'required|string|max:100',
                'subheadline' => 'nullable|string|max:500',

                // Contact information (4 items)
                'contact_1_title' => 'required|string|max:50',
                'contact_1_value' => 'required|string|max:200',
                'contact_1_icon_color' => 'nullable|in:#f5a623,#6b3d02',

                'contact_2_title' => 'required|string|max:50',
                'contact_2_value' => 'required|string|max:200',
                'contact_2_icon_color' => 'nullable|in:#f5a623,#6b3d02',

                'contact_3_title' => 'required|string|max:50',
                'contact_3_value' => 'required|string|max:200',
                'contact_3_icon_color' => 'nullable|in:#f5a623,#6b3d02',

                'contact_4_title' => 'required|string|max:50',
                'contact_4_value' => 'required|string|max:200',
                'contact_4_icon_color' => 'nullable|in:#f5a623,#6b3d02',

                // Social links (3 items)
                'social_1_url' => 'nullable|url|max:255',
                'social_1_color' => 'nullable|in:#6b3d02,#f5a623',

                'social_2_url' => 'nullable|url|max:255',
                'social_2_color' => 'nullable|in:#6b3d02,#f5a623',

                'social_3_url' => 'nullable|url|max:255',
                'social_3_color' => 'nullable|in:#6b3d02,#f5a623',

                // Form configuration
                'form_action' => 'nullable|string|max:200',
                'submit_text' => 'nullable|string|max:50',
                'form_note' => 'nullable|string|max:300',

                // Form options
                'business_option_1' => 'nullable|string|max:100',
                'business_option_2' => 'nullable|string|max:100',
                'business_option_3' => 'nullable|string|max:100',
                'business_option_4' => 'nullable|string|max:100',
                'business_option_5' => 'nullable|string|max:100',

                'loan_option_1' => 'nullable|string|max:100',
                'loan_option_2' => 'nullable|string|max:100',
                'loan_option_3' => 'nullable|string|max:100',
                'loan_option_4' => 'nullable|string|max:100',

                'purpose_option_1' => 'nullable|string|max:100',
                'purpose_option_2' => 'nullable|string|max:100',
                'purpose_option_3' => 'nullable|string|max:100',
                'purpose_option_4' => 'nullable|string|max:100',
                'purpose_option_5' => 'nullable|string|max:100',

                // Section settings
                'title' => 'required|string|max:100',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT'
            ]);

            // Process contact information
            $contactInfo = [];
            for ($i = 1; $i <= 4; $i++) {
                if (!empty($data["contact_{$i}_title"]) && !empty($data["contact_{$i}_value"])) {
                    $contactInfo[] = [
                        'title' => $data["contact_{$i}_title"],
                        'value' => $data["contact_{$i}_value"],
                        'icon_color' => $data["contact_{$i}_icon_color"] ?? '#f5a623'
                    ];
                }
            }

            // Process social links
            $socialLinks = [];
            $platforms = ['Facebook', 'Twitter', 'LinkedIn'];
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($data["social_{$i}_url"])) {
                    $socialLinks[] = [
                        'platform' => $platforms[$i - 1],
                        'url' => $data["social_{$i}_url"],
                        'color' => $data["social_{$i}_color"] ?? '#6b3d02'
                    ];
                }
            }

            // Process form configuration
            $formConfig = [
                'action' => $data['form_action'] ?? '/submit-application',
                'submit_text' => $data['submit_text'] ?? 'Submit Application',
                'note' => $data['form_note'] ?? 'One of our loan specialists will contact you within 24 hours to discuss your application.'
            ];

            // Process form options
            $formOptions = [
                'business_types' => [],
                'loan_amounts' => [],
                'loan_purposes' => []
            ];

            // Business type options
            for ($i = 1; $i <= 5; $i++) {
                if (!empty($data["business_option_{$i}"])) {
                    $formOptions['business_types'][] = $data["business_option_{$i}"];
                }
            }

            // Loan amount options
            for ($i = 1; $i <= 4; $i++) {
                if (!empty($data["loan_option_{$i}"])) {
                    $formOptions['loan_amounts'][] = $data["loan_option_{$i}"];
                }
            }

            // Loan purpose options
            for ($i = 1; $i <= 5; $i++) {
                if (!empty($data["purpose_option_{$i}"])) {
                    $formOptions['loan_purposes'][] = $data["purpose_option_{$i}"];
                }
            }

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            $contactData = array_merge($currentContent, [
                'headline' => $data['headline'],
                'subheadline' => $data['subheadline'] ?? '',
                'contact_info' => $contactInfo,
                'social_links' => $socialLinks,
                'form_config' => $formConfig,
                'form_options' => $formOptions
            ]);

            $section->update([
                'name' => $data['title'],
                'order' => $data['order'] ?? 0,
                'status' => $data['status'],
                'content' => $contactData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Contact section updated successfully.');
        }

        // Ensure content is always returned as array
        $contactData = $this->getContentAsArray($section->content);

        // Transform the data structure for the view
        $formData = [
            'headline' => $contactData['headline'] ?? '',
            'subheadline' => $contactData['subheadline'] ?? '',
            'form_action' => $contactData['form_config']['action'] ?? '',
            'submit_text' => $contactData['form_config']['submit_text'] ?? '',
            'form_note' => $contactData['form_config']['note'] ?? '',
            'title' => $section->name,
            'order' => $section->order,
            'status' => $section->status
        ];

        // Add contact information data
        if (isset($contactData['contact_info'])) {
            foreach ($contactData['contact_info'] as $index => $contact) {
                $contactNumber = $index + 1;
                $formData["contact_{$contactNumber}_title"] = $contact['title'] ?? '';
                $formData["contact_{$contactNumber}_value"] = $contact['value'] ?? '';
                $formData["contact_{$contactNumber}_icon_color"] = $contact['icon_color'] ?? '#f5a623';
            }
        }

        // Add social links data
        if (isset($contactData['social_links'])) {
            foreach ($contactData['social_links'] as $index => $social) {
                $socialNumber = $index + 1;
                $formData["social_{$socialNumber}_url"] = $social['url'] ?? '';
                $formData["social_{$socialNumber}_color"] = $social['color'] ?? '#6b3d02';
            }
        }

        // Add form options data
        if (isset($contactData['form_options'])) {
            // Business type options
            if (isset($contactData['form_options']['business_types'])) {
                foreach ($contactData['form_options']['business_types'] as $index => $option) {
                    $optionNumber = $index + 1;
                    $formData["business_option_{$optionNumber}"] = $option;
                }
            }

            // Loan amount options
            if (isset($contactData['form_options']['loan_amounts'])) {
                foreach ($contactData['form_options']['loan_amounts'] as $index => $option) {
                    $optionNumber = $index + 1;
                    $formData["loan_option_{$optionNumber}"] = $option;
                }
            }

            // Loan purpose options
            if (isset($contactData['form_options']['loan_purposes'])) {
                foreach ($contactData['form_options']['loan_purposes'] as $index => $option) {
                    $optionNumber = $index + 1;
                    $formData["purpose_option_{$optionNumber}"] = $option;
                }
            }
        }

        return view('pages.website.contact', [
            'section' => (object) $formData,
            'contactData' => $contactData
        ]);
    }

    public function cta_section(Request $request)
    {
        // Get or create CTA section data
        $section = Section::where('section_type', 'CTA')->first();

        if (!$section) {
            $defaultContent = [
                'headline' => 'Join 500+ Marketeers Growing Their Business with Londa Loans',
                'subheadline' => 'Get the funding you need to launch campaigns, scale your agency, and achieve your marketing goals. Fast approval, flexible terms, and expert support.',
                'note' => 'No credit check required for initial inquiry',
                'trust_indicators' => [
                    [
                        'text' => '24-Hour Approval',
                        'icon' => 'check'
                    ],
                    [
                        'text' => 'Flexible Terms',
                        'icon' => 'check'
                    ],
                    [
                        'text' => 'No Hidden Fees',
                        'icon' => 'check'
                    ],
                    [
                        'text' => 'Marketing Expertise',
                        'icon' => 'check'
                    ]
                ],
                'buttons' => [
                    [
                        'text' => 'Apply for Loan Now',
                        'type' => 'primary',
                        'url' => '#!',
                        'aria_label' => 'Apply for a loan now'
                    ],
                    [
                        'text' => 'Calculate Payments',
                        'type' => 'secondary',
                        'url' => '#!',
                        'aria_label' => 'Calculate your loan payments'
                    ]
                ],
                'background' => [
                    'type' => 'gradient',
                    'colors' => ['#7a4603', '#db9123'],
                    'shapes' => true
                ]
            ];

            $section = Section::create([
                'name' => 'CTA Section',
                'description' => 'Call-to-Action section with trust indicators',
                'section_type' => 'CTA',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                // Main content
                'headline' => 'required|string|max:200',
                'subheadline' => 'required|string|max:500',
                'note' => 'required|string|max:200',

                // Trust indicators (dynamic array)
                'trust_indicators' => 'sometimes|array',
                'trust_indicators.*.text' => 'required|string|max:100',
                'trust_indicators.*.icon' => 'required|in:check,star,shield,clock',

                // Buttons (dynamic array)
                'buttons' => 'sometimes|array',
                'buttons.*.text' => 'required|string|max:50',
                'buttons.*.type' => 'required|in:primary,secondary',
                'buttons.*.url' => 'required|string|max:255',
                'buttons.*.aria_label' => 'required|string|max:100',

                // Background settings
                'background_type' => 'required|in:gradient,solid',
                'primary_color' => 'required|string|max:7',
                'secondary_color' => 'required|string|max:7',
                'enable_shapes' => 'nullable|boolean',

                // Section settings
                'title' => 'required|string|max:100',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT'
            ]);

            // Process trust indicators
            $trustIndicators = [];
            if (isset($data['trust_indicators'])) {
                foreach ($data['trust_indicators'] as $indicator) {
                    if (!empty($indicator['text'])) {
                        $trustIndicators[] = [
                            'text' => $indicator['text'],
                            'icon' => $indicator['icon']
                        ];
                    }
                }
            }

            // Process buttons
            $buttons = [];
            if (isset($data['buttons'])) {
                foreach ($data['buttons'] as $button) {
                    if (!empty($button['text'])) {
                        $buttons[] = [
                            'text' => $button['text'],
                            'type' => $button['type'],
                            'url' => $button['url'],
                            'aria_label' => $button['aria_label']
                        ];
                    }
                }
            }

            // Process background settings
            $background = [
                'type' => $data['background_type'],
                'colors' => [$data['primary_color'], $data['secondary_color']],
                'shapes' => $data['enable_shapes'] ?? false
            ];

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            $ctaData = array_merge($currentContent, [
                'headline' => $data['headline'],
                'subheadline' => $data['subheadline'],
                'note' => $data['note'],
                'trust_indicators' => $trustIndicators,
                'buttons' => $buttons,
                'background' => $background
            ]);

            $section->update([
                'name' => $data['title'],
                'order' => $data['order'] ?? 0,
                'status' => $data['status'],
                'content' => $ctaData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'CTA section updated successfully.');
        }

        // Ensure content is always returned as array
        $ctaData = $this->getContentAsArray($section->content);

        // Transform the data structure for the view
        $formData = [
            'headline' => $ctaData['headline'] ?? '',
            'subheadline' => $ctaData['subheadline'] ?? '',
            'note' => $ctaData['note'] ?? '',
            'background_type' => $ctaData['background']['type'] ?? 'gradient',
            'primary_color' => $ctaData['background']['colors'][0] ?? '#7a4603',
            'secondary_color' => $ctaData['background']['colors'][1] ?? '#db9123',
            'enable_shapes' => $ctaData['background']['shapes'] ?? true,
            'title' => $section->name,
            'order' => $section->order,
            'status' => $section->status
        ];

        return view('pages.website.cta', [
            'section' => (object) $formData,
            'ctaData' => $ctaData
        ]);
    }

    public function footer_section(Request $request)
    {
        // Get or create footer section data
        $section = Section::where('section_type', 'FOOTER')->first();

        if (!$section) {
            $defaultContent = [
                'company_info' => [
                    'description' => 'Empowering marketeers with tailored financial solutions to grow their businesses and achieve marketing success.',
                    'email' => 'hello@londaloans.com',
                    'address' => '123 Business District, Marketing City, MC 10001',
                    'phone' => '+1 (555) 123-4567'
                ],
                'columns' => [
                    [
                        'type' => 'logo',
                        'title' => 'About Us',
                        'description' => null,
                        'links' => []
                    ],
                    [
                        'type' => 'links',
                        'title' => 'Quick Links',
                        'description' => null,
                        'links' => [
                            ['text' => 'Home', 'url' => '/'],
                            ['text' => 'About Us', 'url' => '/about'],
                            ['text' => 'Services', 'url' => '/services'],
                            ['text' => 'Loan Calculator', 'url' => '/calculator'],
                            ['text' => 'Contact', 'url' => '/contact']
                        ]
                    ],
                    [
                        'type' => 'links',
                        'title' => 'Resources',
                        'description' => null,
                        'links' => [
                            ['text' => 'Blog', 'url' => '/blog'],
                            ['text' => 'FAQ', 'url' => '/faq'],
                            ['text' => 'Support', 'url' => '/support'],
                            ['text' => 'Privacy Policy', 'url' => '/privacy'],
                            ['text' => 'Terms of Service', 'url' => '/terms']
                        ]
                    ],
                    [
                        'type' => 'newsletter',
                        'title' => 'Newsletter',
                        'description' => 'Subscribe to our newsletter for the latest updates and marketing insights.',
                        'links' => []
                    ]
                ],
                'social_links' => [
                    [
                        'platform' => 'facebook',
                        'url' => 'https://facebook.com/londaloans',
                        'aria_label' => 'Follow us on Facebook',
                        'icon' => 'facebook'
                    ],
                    [
                        'platform' => 'twitter',
                        'url' => 'https://twitter.com/londaloans',
                        'aria_label' => 'Follow us on Twitter',
                        'icon' => 'twitter'
                    ],
                    [
                        'platform' => 'linkedin',
                        'url' => 'https://linkedin.com/company/londaloans',
                        'aria_label' => 'Follow us on LinkedIn',
                        'icon' => 'linkedin'
                    ],
                    [
                        'platform' => 'instagram',
                        'url' => 'https://instagram.com/londaloans',
                        'aria_label' => 'Follow us on Instagram',
                        'icon' => 'instagram'
                    ]
                ],
                'bottom_links' => [
                    ['text' => 'Privacy Policy', 'url' => '/privacy'],
                    ['text' => 'Terms of Service', 'url' => '/terms'],
                    ['text' => 'Cookie Policy', 'url' => '/cookies'],
                    ['text' => 'Disclaimer', 'url' => '/disclaimer']
                ],
                'copyright' => '&copy; 2025 Londa Loans. All rights reserved. Empowering marketeers with financial solutions.'
            ];

            $section = Section::create([
                'name' => 'Footer Section',
                'description' => 'Website footer with company info, links, and social media',
                'section_type' => 'FOOTER',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                // Company Info
                'company_description' => 'required|string|max:500',
                'company_email' => 'required|email|max:100',
                'company_address' => 'required|string|max:200',
                'company_phone' => 'required|string|max:20',

                // Footer Columns (dynamic array)
                'columns' => 'sometimes|array',
                'columns.*.type' => 'required|in:logo,links,newsletter',
                'columns.*.title' => 'required|string|max:100',
                'columns.*.description' => 'nullable|string|max:200',
                'columns.*.links' => 'sometimes|array',
                'columns.*.links.*.text' => 'required|string|max:50',
                'columns.*.links.*.url' => 'required|string|max:255',

                // Social Links (dynamic array)
                'social_links' => 'sometimes|array',
                'social_links.*.platform' => 'required|in:facebook,twitter,linkedin,instagram,youtube',
                'social_links.*.url' => 'required|url|max:255',
                'social_links.*.aria_label' => 'required|string|max:100',

                // Bottom Links (dynamic array)
                'bottom_links' => 'sometimes|array',
                'bottom_links.*.text' => 'required|string|max:50',
                'bottom_links.*.url' => 'required|string|max:255',

                // Copyright
                'copyright_text' => 'required|string|max:500',

                // Section settings
                'title' => 'required|string|max:100',
                'order' => 'nullable|integer|min:0|max:100',
                'status' => 'required|in:ACTIVE,INACTIVE,DRAFT'
            ]);

            // Process footer columns
            $columns = [];
            if (isset($data['columns'])) {
                foreach ($data['columns'] as $column) {
                    $columnData = [
                        'type' => $column['type'],
                        'title' => $column['title'],
                        'description' => $column['description'] ?? null
                    ];

                    // Process links for link columns
                    if ($column['type'] === 'links' && isset($column['links'])) {
                        $columnData['links'] = [];
                        foreach ($column['links'] as $link) {
                            if (!empty($link['text'])) {
                                $columnData['links'][] = [
                                    'text' => $link['text'],
                                    'url' => $link['url']
                                ];
                            }
                        }
                    } else {
                        $columnData['links'] = [];
                    }

                    $columns[] = $columnData;
                }
            }

            // Process social links
            $socialLinks = [];
            if (isset($data['social_links'])) {
                foreach ($data['social_links'] as $social) {
                    if (!empty($social['platform'])) {
                        $socialLinks[] = [
                            'platform' => $social['platform'],
                            'url' => $social['url'],
                            'aria_label' => $social['aria_label']
                        ];
                    }
                }
            }

            // Process bottom links
            $bottomLinks = [];
            if (isset($data['bottom_links'])) {
                foreach ($data['bottom_links'] as $link) {
                    if (!empty($link['text'])) {
                        $bottomLinks[] = [
                            'text' => $link['text'],
                            'url' => $link['url']
                        ];
                    }
                }
            }

            // Get current content - ensure it's an array
            $currentContent = $this->getContentAsArray($section->content);

            $footerData = array_merge($currentContent, [
                'company_info' => [
                    'description' => $data['company_description'],
                    'email' => $data['company_email'],
                    'address' => $data['company_address'],
                    'phone' => $data['company_phone']
                ],
                'columns' => $columns,
                'social_links' => $socialLinks,
                'bottom_links' => $bottomLinks,
                'copyright' => $data['copyright_text']
            ]);

            $section->update([
                'name' => $data['title'],
                'order' => $data['order'] ?? 0,
                'status' => $data['status'],
                'content' => $footerData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'Footer section updated successfully.');
        }

        // Ensure content is always returned as array
        $footerData = $this->getContentAsArray($section->content);

        // Transform the data structure for the view
        $formData = [
            'company_description' => $footerData['company_info']['description'] ?? '',
            'company_email' => $footerData['company_info']['email'] ?? '',
            'company_address' => $footerData['company_info']['address'] ?? '',
            'company_phone' => $footerData['company_info']['phone'] ?? '',
            'copyright_text' => str_replace('&copy;', '©', $footerData['copyright'] ?? ''),
            'title' => $section->name,
            'order' => $section->order,
            'status' => $section->status
        ];

        return view('pages.website.footer', [
            'section' => (object) $formData,
            'footerData' => $footerData
        ]);
    }
}
