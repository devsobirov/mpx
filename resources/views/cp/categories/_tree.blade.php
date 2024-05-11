<div class="pad flex column p-4 mt-2" style="width: 40%">
    @foreach($categories as $parent)
        <div class="flex ai-center jc-sb">
            <h4 class="mb-2">{{$parent->name}}</h4>
            <div>
                <a href="{{url('cp/categories/'.$parent->slug)}}" class="button_outline_small">Редактировать</a>
                @if(!$parent->children->count())
                    <a href="{{route('cp.categories.delete', $parent->id, false)}}" class="button_red_small game-delete-button"
                       data-question="{{ "Удалить категорию ". $category->name . " ?"}}"
                       data-hint="{{ __('games.gameDeleteConfirmationDesc') }}"
                    >{{ __('common.delete') }}</a>
                @endif
            </div>
        </div>
        <div class="mb-4 pl-3">
            @foreach($parent->children as $child)
                <div class="flex ai-center jc-sb">
                    <h5>{{$child->name}}</h5>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
