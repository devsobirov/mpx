<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Название игры</span>
        <input type="text"  class="field__input" value="{{$product->name}}" name="name" required>
    </label>
</div>
<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Ссылка игры</span>
        <input type="text"  class="field__input" value="{{$product->slug}}" name="slug" required>
    </label>
</div>
<div class="flex jc-sb mt-3" style="align-items: baseline">
    <label class="field" style="width: 23%">
        <span class="field__label">Steam app ID</span>
        <input type="number"  class="field__input" value="{{$product->steam_app_id}}" name="steam_app_id" readonly>
    </label>

    <label class="field" style="width: 23%">
        <span class="field__label">% скидк из Steam</span>
        <input type="number" step="0.1" value="{{$product->discount}}" class="field__input" name="discount" >
    </label>

    <label class="field mt-3" style="width: 50%">
        <span class="field__label">Загрузить постер - ширина х высота = 2х3</span>
        <input type="file" x-model="productFormData.image" required class="field__input" name="image" style="height: auto; padding: .5rem">
    </label>
</div>
<div class="flex mt-2" style="align-items: baseline; gap: 40px">
    <div style="width: 200px">
        <h5 class="mb-1">Постер</h5>
        <img src="{{asset($product->image)}}" alt="" style="display: block; width: 100%">
    </div>
    <div style="width: 200px">
        <h5 class="mb-1">Картинка фида @if(!$product->image_feed) (нет)@endif</h5>
        <img src="{{asset($product->image_feed ?: asset($product->image))}}" alt="" style="display: block; width: 100%">
    </div>
    <div style="width: 200px">
        <h5 class="mb-1">og-картинка @if(!$product->image_og) (нет)@endif</h5>
        <img src="{{asset($product->image_og ?: asset($product->image))}}" alt="" style="display: block; width: 100%">
    </div>
</div>
<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Жанры - RUS</span>
        <input type="text"  class="field__input" value="{{$product->getTranslation('genres', 'ru', false)}}" name="ru[genres]">
    </label>
    <label class="field w-full">
        <span class="field__label">Жанры - ENG</span>
        <input type="text"  class="field__input" value="{{$product->getTranslation('genres', 'en', false)}}" name="en[genres]">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Разработчики</span>
        <input type="text"  class="field__input" value="{{$product->developers}}" name="developers">
    </label>
    <label class="field w-full">
        <span class="field__label">Издатели</span>
        <input type="text"  class="field__input" value="{{$product->publishers}}" name="publishers">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">Описание - RU</span>
        <input type="text"  class="field__input" name="ru[description]" value="{{$product->getTranslation('description', 'ru', false)}}">
    </label>
    <label class="field w-full">
        <span class="field__label">Описание - EN</span>
        <input type="text"  class="field__input" name="en[description]" value="{{$product->getTranslation('description', 'en', false)}}">
    </label>
</div>
