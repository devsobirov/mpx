<form action="{{route('cp.categories.save', ['category' => $category?->id ])}}" id="productForm" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="flex column" style="width: 100%">
        <div class="flex ai-center mt-3">
            <label class="field w-full pr-2">
                <span class="field__label">Название - RUS</span>
                <input type="text"  class="field__input" name="ru[name]" value="{{$category->getTranslation('name', 'ru', false)}}" required>
            </label>
            <label class="field w-full">
                <span class="field__label">Название - ENG</span>
                <input type="text"  class="field__input" name="en[name]" value="{{$category->getTranslation('name', 'en', false)}}" required>
            </label>
        </div>

        <div class="flex ai-center mt-3">
            <label class="field w-full">
                <span class="field__label">Ссылка категории</span>
                <input type="text"  class="field__input" name="slug" value="{{$category->slug}}">
            </label>
        </div>
        @if(!empty($parent))
            <input type="hidden" name="parent" value="{{$parent->slug}}">
            <div class="flex ai-start mt-3" style="gap: 20px">
                <label class="field mt-3" style="width: 50%">
                    <span class="field__label">Загрузить водяной знак - ширина х высота = 2х3</span>
                    <input type="file" class="field__input" name="watermark" style="height: auto; padding: .5rem">
                </label>
                @if($img = $category->watermark)
                    <img src="{{asset($img)}}" alt="" style="display: block; width: 50%">
                @endif
            </div>
        @endif
        <div class="flex jc-end mt-3">
            <button type="submit" class="button_primary ml-2">Сохранить</button>
        </div>
    </div>
</form>
