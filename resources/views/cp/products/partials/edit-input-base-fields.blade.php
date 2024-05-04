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
        <input type="number"  class="field__input" x-model="productFormData.steam_app_id" name="steam_app_id" readonly>
    </label>

    <label class="field" style="width: 23%">
        <span class="field__label">% скидк из Steam</span>
        <input type="number" step="0.1"  class="field__input" name="discount">
    </label>

    <label class="field mt-3" style="width: 50%">
        <span class="field__label">Загрузить постер - ширина х высота = 2х3</span>
        <input type="file" x-model="productFormData.image" required class="field__input" name="image" style="height: auto; padding: .5rem">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">{{ 'Подсказки для жанров - RUS' }}</span>
        <input type="text"  class="field__input" x-model="productFormData.ru.genres" name="ru[genres]">
    </label>
    <label class="field w-full">
        <span class="field__label">{{ 'Подсказки для жанров - ENG' }}</span>
        <input type="text"  class="field__input" x-model="productFormData.en.genres" name="en[genres]">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">{{ 'Дата релиза - RUS' }}</span>
        <input type="text"  class="field__input" value="" name="ru[release_date]">
    </label>
    <label class="field w-full">
        <span class="field__label">{{ 'Дата релиза - ENG' }}</span>
        <input type="text"  class="field__input" value="" name="en[release_date]">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">{{ 'Разработчики' }}</span>
        <input type="text"  class="field__input" value="{{$product->developers}}" name="developers">
    </label>
    <label class="field w-full">
        <span class="field__label">{{ 'Издатели' }}</span>
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
