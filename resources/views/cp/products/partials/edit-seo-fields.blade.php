<h3 class="mb-2 mt-3">SEO</h3>
<label class="field mt-3 w-full">
    <span class="field__label">Загрузить og-image - ширина х высота = 2х3</span>
    <input type="file" class="field__input" name="image_banner" style="height: auto; padding: .5rem">
</label>
<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">{{ 'Meta-title - RU' }}</span>
        <input type="text"  class="field__input" name="ru[meta_title]" value="{{$product->getTranslation('meta_title', 'ru', false)}}">
    </label>
    <label class="field w-full">
        <span class="field__label">{{ 'Meta title - EN' }}</span>
        <input type="text"  class="field__input" name="en[meta_title]" value="{{$product->getTranslation('meta_title', 'en', false)}}">
    </label>
</div>

<div class="flex ai-center mt-3">
    <label class="field w-full pr-2">
        <span class="field__label">{{ 'Meta-description - RU' }}</span>
        <textarea rows="4" type="text" class="field__input" name="ru[meta_description]" style="height: auto">{{$product->getTranslation('meta_description', 'ru', false)}}</textarea>
    </label>
    <label class="field w-full">
        <span class="field__label">{{ 'Meta description - EN' }}</span>
        <textarea rows="4" type="text" class="field__input" name="en[meta_description]" style="height: auto">{{$product->getTranslation('meta_description', 'en', false)}}</textarea>
    </label>
</div>
<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Хэштеги для поиска - до 255 символов</span>
        <input type="text"  class="field__input" value="{{$product->keywords}}" maxlength="255" name="keywords">
    </label>
</div>
