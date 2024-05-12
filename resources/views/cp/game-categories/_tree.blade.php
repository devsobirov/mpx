<div class="pad flex column p-4 mt-2" style="width: 40%">
    @foreach($game->catalog as $parent)
        <div class="flex ai-center jc-sb">
            <h4 class="mb-2">{{$parent->name}}</h4>
            <div class="flex ai-center" style="gap: 5px">
                <a href="#" class="button_outline_small">Редактировать</a>
                <a href="#" class="button_red_small game-delete-button">Удалить</a>
            </div>
        </div>
        <div class="mb-4 pl-3">
            @foreach($game->categories->where('parent', $parent->slug) as $child)
                <div class="flex ai-center jc-sb">
                    <h5>{{$child->name}}</h5>
                </div>
            @endforeach
            @foreach($list->where('slug', $parent->slug)->first()?->children ?: [] as $child)
            <div class="flex" style="">
                <a href="{{route('cp.tree.add', ['game' => $game->slug, 'category' => $child->slug])}}"
                   onclick="return confirm('Add category?')"
                   class="button_orange_small mb-1">+ {{$child->name}}</a>
            </div>
            @endforeach
        </div>
    @endforeach
</div>
