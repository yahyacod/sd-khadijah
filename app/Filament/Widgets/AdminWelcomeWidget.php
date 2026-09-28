<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\HeroSlides\HeroSlideResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Posts\PostResource;
use App\Models\Page;
use App\Models\Post;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class AdminWelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.admin-welcome';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -2;

    protected function getViewData(): array
    {
        return [
            'administratorName' => auth()->user()?->name,
            'publishedPagesCount' => Page::query()->where('status', 'publish')->count(),
            'draftPagesCount' => Page::query()->where('status', 'draft')->count(),
            'publishedPostsCount' => Post::query()->where('status', 'publish')->count(),
            'pagesUrl' => PageResource::getUrl('index'),
            'createPageUrl' => PageResource::getUrl('create'),
            'postsUrl' => PostResource::getUrl('index'),
            'createPostUrl' => PostResource::getUrl('create'),
            'heroSlidesUrl' => HeroSlideResource::getUrl('index'),
            'publicSiteUrl' => url('/'),
        ];
    }

    public function render(): View
    {
        return view($this->view, $this->getViewData());
    }
}
