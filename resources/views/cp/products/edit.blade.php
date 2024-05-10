
<div class="width-limiter" x-data="shopProductData()" x-init="initTinyMCE()">

    <div class="pad flex column mt-3 pr-4 pl-4 pt-2 pb-2">
        <div class="flex ai-center jc-sb mb-4">
            <h4>Редактировать - "{{$product->name}}"</h4>
            <a href="{{route('cp.products.index')}}" class="button_outline ml-2 no-white-space">{{ __('Все товары') }}</a>
        </div>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="id">
            <div class="flex column" style="width: 100%">

                @include('cp.products.partials.edit-input-base-fields')
                <div class="flex mt-2" style="flex-direction: column">
                    <div class="flex mt-3">
                        <h4 style="width: 120px; margin-right: 1.5rem;">Статус: </h4>
                        <label class="checkbox">
                            <input type="checkbox" name="status" class="checkbox__input" value="1" @if($product->status) checked @endif>
                            <span class="checkbox__box"></span>
                            <span class="checkbox__text">Показать на сайте</span>
                        </label>
                    </div>
                    <div class="flex mt-2">
                        <h4 style="width: 120px; margin-right: 1.5rem;">Дата релиза: </h4>
                        <label class="field w-full pr-2" style="width: 20%">
                            <span class="field__label">Дата релиза</span>
                            <input type="date"  class="field__input" value="{{$product->released_at?->format('Y-m-d')}}" name="released_at">
                        </label>
                    </div>
                </div>

                <hr class="mb-2 mt-2">
                @include('cp.products.partials.edit-seo-fields')

                <div class="flex jc-end mt-3">
                    <button type="submit" class="button_primary ml-2">{{ __('Сохранить') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const productForm = document.getElementById('productForm');
    const createProductLink = '{{route('cp.products.save', $product->id, false)}}';

    function shopProductData() {
        return {
            langTabs: defaultLangTabs(),
            productFormData: {},
            async submitProductForm() {
                const productForm = document.getElementById('productForm');
                UIKit.form.clearErrors(productForm);
                UIKit.spinner.show(productForm);

                let data = new FormData(productForm);

                try {
                    let response = await UIKit.network.post(createProductLink, data);
                    this.productCreated = true;
                    UIKit.spinner.hide(productForm);
                    window.location.reload()
                } catch (errors) {
                    console.error(errors);
                    UIKit.spinner.hide(productForm);
                    UIKit.form.showErrors(productForm, await errors.json(), {showTooltip: true});
                }
            },
        }
    }
</script>

