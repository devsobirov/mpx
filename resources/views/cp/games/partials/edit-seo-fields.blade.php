<h3 class="mb-2 mt-3">SEO</h3>
<label class="field mt-3 w-full">
    <span class="field__label">Загрузить og-image - ширина х высота = 2х3</span>
    <input type="file" class="field__input" name="image_og" style="height: auto; padding: .5rem">
</label>

<div class="flex ai-center mt-3">
    <label class="field w-full">
        <span class="field__label">Хэштеги для поиска - до 255 символов</span>
        <input type="text"  class="field__input" value="{{$game->keywords}}" maxlength="255" name="keywords">
    </label>
</div>
