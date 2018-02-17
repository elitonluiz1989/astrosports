<article class="news-full">
    <header class="news-full__header">
        <h2 class="news-full__header-title">{{ $news->title }}</h2>

        <div class="news-full__header-published">{!! $news->published_by !!}</div>
    </header>

    <section class="news-full__content">{!! $news->text !!}</section>
</article>
