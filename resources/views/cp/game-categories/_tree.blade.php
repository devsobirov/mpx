<div class="pad flex column p-4 mt-2" style="width: 40%">
    @foreach($game->catalog as $parent)
        @php
            $children = $game->categories->where('parent', $parent->slug);
            $options = $list->where('slug', $parent->slug)->first()?->children ?: [];
        @endphp
        <div class="flex ai-center jc-sb">
            <h4 class="mb-2">{{$parent->name}}</h4>
            @if(!count($children))
            <div class="flex ai-center" style="gap: 5px">
                <a href="{{route('cp.tree.remove', ['game' => $game->slug, 'category' => $parent->slug])}}"
                   class="button_red_small"
                   onclick="return confirm(`Удалить `+ '{{$parent->name}} из ' + ' {{$game->name}}?')"
                >Удалить</a>
            </div>
            @endif
        </div>
        <hr class="mb-2">
        <div class="mb-4 pl-3">
            @foreach($children as $child)
                <div class="flex ai-center jc-sb mb-1">
                    <h5>{{$child->name}}</h5>

                    <div class="flex ai-center" style="gap: 5px">
                        <a href="{{route('cp.tree.remove', ['game' => $game->slug, 'category' => $child->slug])}}"
                           class="button_red_small"
                           onclick="return confirm(`Удалить `+ '{{$child->name}} из ' + ' {{$game->name}}/{{$parent->name}}?')"
                        >Удалить</a>
                    </div>
                </div>
                <hr class="mb-2">
            @endforeach
            @foreach($options as $option)
            <div class="flex" style="">
                <a href="{{route('cp.tree.add', ['game' => $game->slug, 'category' => $option->slug])}}"
                   onclick="return confirm(`Добавить `+ '{{$option->name}} к ' + ' {{$game->name}}/{{$parent->name}} ?')"
                   class="button_orange_small mb-1">+ {{$option->name}}</a>
            </div>
            @endforeach
        </div>
    @endforeach
</div>
