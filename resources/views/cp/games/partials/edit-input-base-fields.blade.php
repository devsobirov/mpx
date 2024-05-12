<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Название игры</span>
        <input type="text"  class="field__input" value="{{$game->name}}" name="name" required>
    </label>
</div>
<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Ссылка игры</span>
        <input type="text"  class="field__input" value="{{$game->slug}}" name="slug" required>
    </label>
</div>
<div class="flex jc-sb mt-3" style="align-items: baseline">
    <label class="field" style="width: 23%">
        <span class="field__label">Steam app ID</span>
        <input type="number"  class="field__input" value="{{$game->steam_app_id}}" name="steam_app_id" readonly>
    </label>

    <label class="field" style="width: 23%">
        <span class="field__label">% скидк из Steam</span>
        <input type="number" step="0.1" value="{{$game->discount}}" class="field__input" name="discount" >
    </label>

    <label class="field mt-3" style="width: 50%">
        <span class="field__label">Загрузить постер - ширина х высота = 2х3</span>
        <input type="file" class="field__input" name="image" style="height: auto; padding: .5rem">
    </label>
</div>
<div class="flex mt-2" style="align-items: baseline; gap: 40px">
    <div style="width: 200px">
        <h5 class="mb-1">Постер</h5>
        <img src="{{asset($game->image)}}" alt="" style="display: block; width: 100%">
    </div>
{{--    <div style="width: 200px">--}}
{{--        <h5 class="mb-1">Картинка фида @if(!$game->image_feed) (нет)@endif</h5>--}}
{{--        <img src="{{asset($game->image_feed ?: asset($game->image))}}" alt="" style="display: block; width: 100%">--}}
{{--    </div>--}}
    <div style="width: 200px">
        <h5 class="mb-1">og-картинка @if(!$game->image_og) (нет)@endif</h5>
        <img src="{{asset($game->image_og ?: asset($game->image))}}" alt="" style="display: block; width: 100%">
    </div>
</div>
<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Жанры - RUS</span>
        <input type="text"  class="field__input" value="{{$game->getTranslation('genres', 'ru', false)}}" name="ru[genres]">
    </label>
    <label class="field w-full">
        <span class="field__label">Жанры - ENG</span>
        <input type="text"  class="field__input" value="{{$game->getTranslation('genres', 'en', false)}}" name="en[genres]">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Разработчики</span>
        <input type="text"  class="field__input" value="{{$game->developers}}" name="developers">
    </label>
    <label class="field w-full">
        <span class="field__label">Издатели</span>
        <input type="text"  class="field__input" value="{{$game->publishers}}" name="publishers">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Описание - RU</span>
        <input type="text"  class="field__input" name="ru[description]" value="{{$game->getTranslation('description', 'ru', false)}}">
    </label>
    <label class="field w-full">
        <span class="field__label">Описание - EN</span>
        <input type="text"  class="field__input" name="en[description]" value="{{$game->getTranslation('description', 'en', false)}}">
    </label>
</div>
