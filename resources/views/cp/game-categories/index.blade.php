<div class="width-limiter" id="products">
    <div class="pad flex column p-4 mt-2">

        <div class="mb-4">
            <div class="flex ai-center jc-sb mb-3">
                <h3>Категории {{$game->name}}</h3>
            </div>
            <div class="flex ai-center" style="gap: 10px; flex-wrap: wrap">
                @foreach($list->whereNotIn('slug', $slugs) as $category)
                    <a href="{{route('cp.tree.add', ['game' => $game->slug, 'category' => $category->slug])}}"
                       onclick="return confirm('Add category?')"
                       class="button_orange_small">+ {{$category->name}}</a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex ai-start jc-sb" style="gap: 30px">
        @include('cp.game-categories._tree')

{{--        <div class="pad flex column p-4 mt-2" style="width: 60%">--}}
{{--            <h5>Создать новую родительскую категорию</h5>--}}
{{--            @include('cp.categories._form', ['parent' => null, 'category' => new \App\Models\Category()])--}}
{{--        </div>--}}
    </div>
</div>

