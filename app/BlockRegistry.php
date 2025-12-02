<?php

namespace App;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BlockRegistry
{

    public static function all(): array
    {
        return [
            'hero' => [
                'label' => 'Hero section',
                'schema' => self::heroBlock()
            ],
            'why_us' => [
                'label' => 'Why Us',
                'schema' => self::WhyUsBlock()
            ],
            'about_hero' => [
                'label' => 'About Hero section',
                'schema' => self::AboutHeroBlock()
            ],
            'features' => [
                'label' => 'Features section',
                'schema' => self::featuresBlock()
            ],
            'image' => [
                'label' => 'Image section',
                'schema' => self::imageBlock()
            ],
            'gallery' => [
                'label' => 'Gallery section',
                'schema' => self::galleryBlock()
            ],
            'video_gallery' => [
                'label' => 'Video Gallery section',
                'schema' => self::videoGalleryBlock()
            ],
            'button' => [
                'label' => 'Button section',
                'schema' => self::buttonBlock()
            ],
            'video' => [
                'label' => 'Video section',
                'schema' => self::videoBlock()
            ],
            'testimonial' => [
                'label' => 'Testimonial section',
                'schema' => self::testimonialBlock()
            ],
            'team' => [
                'label' => 'Team section',
                'schema' => self::teamBlock()
            ],
            'faq' => [
                'label' => 'FAQ section',
                'schema' => self::faqBlock()
            ],
            'cta' => [
                'label' => 'CTA section',
                'schema' => self::ctaBlock()
            ],
            'timeline' => [
                'label' => 'Timeline Section',
                'schema' => self::timeLine()

            ],
            'mission_vision' => [
                'label' => 'Mission and Vision',
                'schema' => self::missionVision()
            ],
            'degredeable_process' => [
                'label' => 'Degredeable Process',
                'schema' => self::degredeableProcess()

            ],
            'content' => [
                'label' => 'Content',
                'schema' => self::ContentBlock()
            ],
        ];
    }

    public static function heroBlock(): Block
    {
        return Block::make('hero')
            ->label('Hero Section')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Content')
                    ->description('Main text and button details for the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Hero Title')
                                    ->placeholder('Enter the main headline')
                                    ->required()
                                    ->maxLength(100),

                                Textarea::make('subtitle')
                                    ->label('Hero Subtitle')
                                    ->placeholder('Enter a supporting subtitle or tagline')
                                    ->rows(3)
                                    ->required(),
                            ]),
                    ]),

                Section::make('Media')
                    ->description('Upload the hero background image for different viewports.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                            FileUpload::make('background_image_desktop')
                                    ->label('Desktop Background Image')
                                    
                                    ->imageEditor()
                                    ->imagePreviewHeight('200px')
                                    ->required(),

                            FileUpload::make('background_image_mobile')
                                    ->label('Mobile Background Image')
                                    
                                    ->imageEditor()
                                    ->imagePreviewHeight('200px'),
                            ]),
                    ]),

                Section::make('Call to Action')
                    ->description('Configure the button shown on the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('button_label')
                                    ->label('Button Text')
                                    ->placeholder('Learn More')
                                    ->required(),

                                TextInput::make('button_url')
                                    ->label('Button Link')
                                    ->datalist(function () {
                                        $routes = collect(Route::getRoutes())
                                            ->map(function ($route) {
                                                return [
                                                    'uri' => $route->uri(),
                                                ];
                                            });
                                        return $routes->pluck('uri');
                                    })
                                    ->placeholder('https://example.com')
                                    ->url()
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function aboutHeroBlock(): Block
    {
        return Block::make('about_hero')
            ->label(' About Hero Section')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Content')
                    ->description('Main text and button details for the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Hero Title')
                                    ->placeholder('Enter the main headline')
                                    ->required()
                                    ->maxLength(100),

                                Textarea::make('subtitle')
                                    ->label('Hero Subtitle')
                                    ->placeholder('Enter a supporting subtitle or tagline')
                                    ->rows(3)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function WhyUsBlock(): Block
    {
        return Block::make('why_us')
            ->label('Why Us section')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Content')
                    ->description('Main text and button details for the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label(' Title')
                                    ->placeholder('Enter the main headline')
                                    ->required()
                                    ->maxLength(100),

                                Textarea::make('description')
                                    ->label('Hero Subtitle')
                                    ->placeholder('Enter a supporting subtitle or tagline')
                                    ->rows(3)
                                    ->required(),
                            ]),
                    ]),

                Section::make('Media')
                    ->description('Upload the hero background image for different viewports.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                            FileUpload::make('images')
                                    ->label('Enter images')
                                    ->multiple()
                                    
                                    ->imageEditor()
                                    ->imagePreviewHeight('200px')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Call to Action')
                    ->description('Configure the button shown on the hero section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('button_label')
                                    ->label('Button Text')
                                    ->placeholder('Learn More')
                                    ->required(),

                                TextInput::make('button_url')
                                    ->label('Button Link')
                                    ->datalist(function () {
                                        $routes = collect(Route::getRoutes())
                                            ->map(function ($route) {
                                                return [
                                                    'uri' => $route->uri(),
                                                ];
                                            });
                                        return $routes->pluck('uri');
                                    })
                                    ->placeholder('https://example.com')
                                    ->url()
                                    ->required(),

                                TextInput::make('second_button_label')
                                    ->label('Button Text')
                                    ->placeholder('Learn More')
                                    ->required(),

                                TextInput::make('second_button_url')
                                    ->label('Button Link')
                                    ->datalist(function () {
                                        $routes = collect(Route::getRoutes())
                                            ->map(function ($route) {
                                                return [
                                                    'uri' => $route->uri(),
                                                ];
                                            });
                                        return $routes->pluck('uri');
                                    })
                                    ->placeholder('https://example.com')
                                    ->url()
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function featuresBlock(): Block
    {
        return Block::make('features')
            ->label('Features Section')
            ->icon('heroicon-o-sparkles')
            ->schema([
                Section::make('Section Header')
                    ->description('Heading and short description for this feature section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('heading')
                                    ->label('Section Heading')
                                    ->placeholder('What makes us different')
                                    ->required()
                                    ->maxLength(120),

                                Textarea::make('description')
                                    ->label('Section Description')
                                    ->placeholder('Write a short introduction for this section')
                                    ->rows(3),
                            ]),
                    ]),

                Section::make('Features List')
                    ->description('Add and manage individual feature items.')
                    ->schema([
                        Repeater::make('features')
                            ->label('Features')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Feature Title')
                                            ->placeholder('Enter feature title')
                                            ->required()
                                            ->maxLength(100),

                                        Textarea::make('description')
                                            ->label('Feature Description')
                                            ->placeholder('Describe the feature briefly')
                                            ->rows(2)
                                            ->required(),
                                    ]),

                            FileUpload::make('image')
                                    ->label('Feature Image')
                                    ->imageEditor()
                                    ->required(),
                            ])
                            ->addActionLabel('Add New Feature')
                            ->reorderableWithDragAndDrop()
                            ->minItems(1)
                            ->defaultItems(1)
                            ->collapsed()
                            ->grid(1),
                    ]),
            ])
            ->columns(1);
    }

    public static function imageBlock(): Block
    {
        return Block::make('image')
            ->label('Image Block')
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make('Image Settings')
                    ->description('Upload an image and optionally add alt text or a link.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                            FileUpload::make('image')
                                    ->label('Image')
                                    ->imageEditor()
                                    ->required(),

                                Grid::make(1)
                                    ->schema([
                                        TextInput::make('alt')
                                            ->label('Alt Text')
                                            ->placeholder('Describe the image for accessibility')
                                            ->required()
                                            ->helperText('Used for SEO and accessibility.'),

                                        TextInput::make('link')
                                            ->label('Optional Link')
                                            ->placeholder('https://example.com')
                                            ->suffixIcon('heroicon-o-link'),
                                    ]),
                            ]),
                    ])
            ])
            ->columns(1);
    }

    public static function galleryBlock(): Block
    {
        return Block::make('gallery')
            ->label('Gallery Block')
            ->icon('heroicon-o-photo')

            ->schema([
                Section::make('Gallery Header')
                    ->description('Heading and short description for this feature section.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('heading')
                                    ->label('Section Heading')
                                    ->placeholder('What makes us different')
                                    ->required()
                                    ->maxLength(120),

                                Textarea::make('description')
                                    ->label('Section Description')
                                    ->placeholder('Write a short introduction for this section')
                                    ->rows(3),
                            ]),

                    FileUpload::make('images')
                            ->label('Gallery Images')
                            ->multiple()
                            ->imageEditor()
                            ->required()
                            ->helperText('You can drag to reorder the gallery images.'),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('alt')
                                    ->label('Default Alt Text')
                                    ->placeholder('Describe the gallery')
                                    ->helperText('Used when individual images don’t have alt text.')
                                    ->required(),

                                TextInput::make('link')
                                    ->label('Optional Link')
                                    ->placeholder('https://example.com')
                                    ->suffixIcon('heroicon-o-link'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Toggle::make('enable_slider')
                                    ->label('Enable Slider Mode')
                                    ->helperText('If enabled, this gallery will display as a carousel.'),

                                Toggle::make('show_captions')
                                    ->label('Show Image Captions')
                                    ->helperText('Display image alt text or captions below images.'),
                            ]),
                    ])
            ])
            ->columns(1);
    }

    public static function videoGalleryBlock()
    {
        return Block::make('video_gallery')
            ->label('Video Gallery Block')
            ->icon('heroicon-o-video-camera')
            ->schema([
                Section::make('Video Gallery')
                    ->description('Add and manage multiple videos from YouTube, Vimeo, or other platforms.')
                    ->schema([
                        Repeater::make('videos')
                            ->label('Videos')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('url')
                                            ->label('Video URL')
                                            ->placeholder('https://www.youtube.com/watch?v=example')
                                            ->suffixIcon('heroicon-o-link')
                                            ->required()
                                            ->helperText('Supports YouTube, Vimeo, or direct video links.'),

                                        TextInput::make('title')
                                            ->label('Video Title')
                                            ->placeholder('Optional video title (for display)'),
                                    ]),

                                Textarea::make('description')
                                    ->label('Video Description')
                                    ->placeholder('Optional short description for this video.')
                                    ->rows(2),

                                Toggle::make('featured')
                                    ->label('Mark as Featured')
                                    ->helperText('Highlight this video on the frontend if needed.'),
                            ])
                            ->addActionLabel('Add Video')
                            ->reorderableWithDragAndDrop()
                            ->collapsed()
                            ->grid(1)
                            ->minItems(1)
                            ->defaultItems(1)
                            ->helperText('Drag to reorder videos in the gallery.'),
                    ])
            ])
            ->columns(1);
    }

    public static function buttonBlock(): Block
    {
        return Block::make('button')
            ->label('Button Block')
            ->icon('heroicon-o-link')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('label')
                            ->label('Button Text')
                            ->placeholder('Enter button label')
                            ->required(),

                        TextInput::make('url')
                            ->label('Button URL')
                            ->placeholder('/your-route-or-external-link')
                            ->required()
                            ->datalist(function () {
                                $routes = collect(Route::getRoutes())
                                    ->map(fn($route) => $route->uri());
                                return $routes;
                            }),

                        Select::make('style')
                            ->label('Button Style')
                            ->options([
                                'primary' => 'Primary',
                                'secondary' => 'Secondary',
                                'success' => 'Success',
                                'danger' => 'Danger',
                            ])
                            ->default('primary')
                            ->required(),

                        TextInput::make('target')
                            ->label('Open in')
                            ->placeholder('_self or _blank')
                            ->default('_self')
                            ->helperText('Set _blank to open link in a new tab.'),
                    ]),
            ]);
    }

    public static function videoBlock(): Block
    {
        return Block::make('video')
            ->label('Video Block')
            ->icon('heroicon-o-video-camera')
            ->schema([
                Grid::make(1)
                    ->schema([
                        TextInput::make('url')
                            ->label('Video URL (YouTube, Vimeo)')
                            ->placeholder('https://youtube.com/...')
                            ->required(),

                        TextInput::make('caption')
                            ->label('Video Caption')
                            ->placeholder('Optional caption for the video'),
                    ]),
            ])
            ->columns(1);
    }

    public static function testimonialBlock(): Block
    {
        return Block::make('testimonial')
            ->label('Testimonial Section')
            ->icon('heroicon-o-annotation')
            ->schema([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('heading')
                            ->label('Section Heading')
                            ->required(),


                        Textarea::make('description')
                            ->label('Section Description')
                            ->required(),

                    ]),

                Repeater::make('testimonials')
                    ->label('Testimonials')
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('author')
                            ->label('Author Name')
                            ->required(),

                        Hidden::make('author_uuid')
                            ->default(Str::uuid()->toString())
                            ->dehydratedWhenHidden(true),

                        TextInput::make('position')
                            ->label('Author Position / Company'),

                        Textarea::make('quote')
                            ->label('Testimonial Quote')
                            ->required()
                            ->columnSpan(2),

                    FileUpload::make('author_image')
                            ->imageEditor()
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->minItems(1)
                    ->columns(2)
                    ->addActionLabel('Add Testimonial'),
            ])
            ->columns(2);
    }

    public static function teamBlock(): Block
    {
        return Block::make('team')
            ->label('Team Section')
            ->icon('heroicon-o-users')
            ->schema([
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('heading')
                            ->label('Section Heading')
                            ->required(),


                        Textarea::make('description')
                            ->label('Section Description')
                            ->required(),

                    ]),

                Repeater::make('members')
                    ->label('Team Members')
                    ->schema([
                        TextInput::make('name')
                            ->label('Member Name')
                            ->required(),

                        TextInput::make('title')
                            ->label('Member Title')
                            ->required(),
                        TextInput::make('quote')
                            ->label('quote')
                            ->required(),

                    FileUpload::make('avatar')
                            ->label('Member Avatar')
                            ->imageEditor()
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2)
                    ->addActionLabel('Add Member'),
            ])
            ->columnSpanFull();
    }
    public static function timeLine(): Block
    {
        return Block::make('timeline')
            ->label('Timeline Section')
            ->icon('heroicon-o-users')
            ->schema([
                Repeater::make('history')
                    ->label('Enlist History')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),

                        TextInput::make('description')
                            ->label('Description')
                            ->required(),

                    FileUpload::make('avatar')
                            ->label('Member Avatar')
                            ->imageEditor()
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2)
                    ->addActionLabel('Add Timeline'),
            ])
            ->columnSpanFull();
    }
    public static function ContentBlock(): Block
    {
        return Block::make('content')
            ->label('Content Block')
            ->icon('heroicon-o-users')
            ->schema([
                Repeater::make('content')
                    ->label('Content Block')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),

                        TextInput::make('description')
                            ->label('Description')
                            ->required(),

                    FileUpload::make('avatar')
                            ->label(' Avatar')
                            ->imageEditor()
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2)
            ])
            ->columnSpanFull();
    }


    public static function faqBlock(): Block
    {
        return Block::make('faq')
            ->label('FAQ Section')
            ->icon('heroicon-o-question-mark-circle')
            ->schema([
                TextInput::make('heading')
                    ->label('Section Heading')
                    ->required(),

                Repeater::make('faqs')
                    ->label('FAQs')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('question')
                            ->label('FAQ Question')
                            ->required(),

                        Textarea::make('answer')
                            ->label('FAQ Answer')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2)
                    ->addActionLabel('Add FAQ'),
            ])
            ->columns(2);
    }

    public static function ctaBlock(): Block
    {
        return Block::make('cta')
            ->label('Call To Action')
            ->icon('heroicon-o-bolt')
            ->schema([
                TextInput::make('heading')
                    ->label('CTA Heading')
                    ->required(),

                Textarea::make('description')
                    ->label('CTA Description')
                    ->required(),

                TextInput::make('button_label')
                    ->label('Button Label')
                    ->required(),

                TextInput::make('button_url')
                    ->label('Button URL')
                    ->datalist(function () {
                        $routes = collect(Route::getRoutes())
                            ->map(function ($route) {
                                return [
                                    'uri' => $route->uri(),
                                ];
                            });
                        return $routes->pluck('uri');
                    })
                    ->placeholder('https://example.com')
                    ->url()
                    ->required(),

            FileUpload::make('image')
                    ->label('Background Image')
                    ->imageEditor()
                    ->required(),
            ])
            ->columns(2);
    }

    public static function footerBlock(): Block
    {
        return Block::make('footer')
            ->schema([

                TextInput::make('company_name')
                    ->label('Company Name')
                    ->required(),
                TextInput::make('address')
                    ->label('Address'),
                TextInput::make('phone')
                    ->label('Phone Number'),
                TextInput::make('email')
                    ->label('Email Address')
                    ->required(),
                Repeater::make('links')
                    ->label('Footer Links')
                    ->schema([
                        TextInput::make('label')
                            ->label('Link Label')
                            ->required(),
                        TextInput::make('url')
                            ->label('Link URL')
                            ->datalist(function () {
                                $routes = collect(Route::getRoutes())
                                    ->map(function ($route) {
                                        return [
                                            'uri' => $route->uri(),
                                        ];
                                    });
                                return $routes->pluck('uri');
                            })
                            ->required(),
                    ])
                    ->minItems(1)
                    ->columns(2)
                    ->addActionLabel('Add Link'),
            ])
            ->columns(2);
    }

    public static function socialBlock()
    {
        return Block::make('socials')
            ->schema([
                RichEditor::make('description')->columnSpan(2),
                Repeater::make('social_links')
                    ->schema([
                        TextInput::make('label')
                            ->label('Handle label')
                            ->required(),
                        TextInput::make('url')
                            ->datalist(function () {
                                $routes = collect(Route::getRoutes())
                                    ->map(function ($route) {
                                        return [
                                            'uri' => $route->uri(),
                                        ];
                                    });
                                return $routes->pluck('uri');
                            })
                            ->placeholder('https://facebook.com/batulyforbusiness')
                            ->url()
                            ->required(),
                    ])
            ])
            ->columns(2);
    }

    public static function statementText()
    {
        return Block::make('statementText')->schema([

            RichEditor::make('statement')->required(),
        ]);
    }

    public static function missionVision()
    {
        return Block::make('mission_vision')->schema([
            TextInput::make('heading')
                ->label('Section Heading')
                ->required(),

            Textarea::make('description')
                ->label('Section Description')
                ->required(),

            Repeater::make('missions')
                ->schema([
                    TextInput::make('title')->required(),
                    FileUpload::make('image')
                        ->label('Mission_Visions  Images')
                        
                        ->imageEditor()
                        ->required()
                        ->helperText('You can drag to reorder the gallery images.'),
                ]),
            Repeater::make('mission_visions')
                ->schema([
                    TextInput::make('title')->required(),
                    Textarea::make('description')->required(),
                    FileUpload::make('image')
                        
                        ->imageEditor()
                        ->required()
                        ->columnSpan(2),
                ]),
        ])->columns(2);
    }
    public static function degredeableProcess()
    {
        return Block::make('degredeable_process')->schema([
            TextInput::make('heading')
                ->label('Section Heading')
                ->required(),

            Textarea::make('description')
                ->label('Section Description')
                ->required(),

            Repeater::make('process')
                ->schema([
                    TextInput::make('days')
                        ->label('Enter degredeable days of image')
                        ->required(),
                    FileUpload::make('image')
                        ->label('Mission_Visions  Images')
                        
                        ->reorderable()
                        ->imageEditor()
                        ->required()
                        ->helperText('You can drag to reorder the gallery images.'),
                ]),
        ])->columns(2);
    }

    public static function corevalue()
    {
        return Block::make('core_value')->schema([

            Repeater::make('items')->schema([

                TextInput::make('title')->required(),
                Textarea::make('description')->maxLength(225),
                FileUpload::make('image')
                    ->imageEditor()
                    ->required(),
            ]),
        ])->columns(2);
    }

    public static function programBlock(): Block
    {
        return Block::make('program')->schema(
            [
                Repeater::make('programs')->schema([

                    TextInput::make('title')->required(),
                    Textarea::make('description')->maxLength(225)->required(),
                    FileUpload::make('image')
                        ->imageEditor()
                        ->required(),
                ])
            ]
        )
            ->columns(2);
    }

    public static function AboutBlock(): Block
    {
        return Block::make('about_block')->schema([
            TextInput::make('organization_name')->required(),
            FileUpload::make('organization_logo')
                ->imageEditor()
                ->required(),
            TextInput::make('address')->required(),
            TextInput::make('email')->required(),
            TextInput::make('phone')->required(),
        ]);
    }
}