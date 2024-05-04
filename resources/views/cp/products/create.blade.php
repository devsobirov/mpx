@php
$product = new \App\Models\Product();
@endphp
<div class="width-limiter" x-data="shopProductData()">
    <div class="pad mt-2 flex column pr-4 pl-4 pt-2 pb-2">
        <form @submit.prevent="submitLinkForm()" id="linkForm" method="POST" class="flex column" style="width: 100%">
            @csrf
            <div class="flex ai-center jc-sb mb-2">
                <h4>Созадние с помощью данных из Steam</h4>
                <a href="{{ route('cp.products.index') }}" class="button_outline ml-auto">Все игры</a>
            </div>
            <div class="flex jc-end mt-auto">
                <label class="field w-full">
                    <span class="field__label">Введите ссылку игры на Steam</span>
                    <input type="text"  class="field__input" name="link" required placeholder="Введите ссылку игры на Steam">
                </label>
                <button class="button_primary ml-2 no-white-space">Получить информацию об игре</button>
            </div>
        </form>
    </div>

    <div class="pad flex column mt-3 pr-4 pl-4 pt-2 pb-2">

        <form action="#" id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex column" style="width: 100%">

                @include('cp.products.partials.input-base-fields')

                <div class="flex mt-2" style="flex-direction: column">
                    <div class="flex mt-3">
                        <h4 style="width: 120px; margin-right: 1.5rem;">Статус: </h4>
                        <label class="checkbox">
                            <input type="checkbox" name="status" class="checkbox__input" value="1">
                            <span class="checkbox__box"></span>
                            <span class="checkbox__text">Показать на сайте</span>
                        </label>
                    </div>
                    <div class="flex mt-2">
                        <h4 style="width: 120px; margin-right: 1.5rem;">Популярный: </h4>
                        <label class="checkbox">
                            <input type="checkbox" readonly class="checkbox__input">
                            <span class="checkbox__box"></span>
                            <span class="checkbox__text">Популярный</span>
                        </label>
                    </div>
                    <div class="flex mt-2">
                        <h4 style="width: 120px; margin-right: 1.5rem;">Дата релиза: </h4>
                        <label class="field w-full pr-2" style="width: 20%">
                            <span class="field__label">Дата релиза</span>
                            <input type="date"  class="field__input" x-model="productFormData.released_at" name="released_at">
                        </label>
                    </div>
                </div>

                <hr class="mb-2 mt-2">
                @include('cp.products.partials.seo-fields')

                <div class="flex jc-end mt-3">
                    <button type="submit" class="button_primary ml-2">Сохранить</button>
                </div>
            </div>
        </form>

    </div>
</div>


<script>
    function defaultProductLangData () {
        return {
            genres: ''
        }
    }
    function defaultProductFormData() {
        return {
            en: defaultProductLangData(), ru: defaultProductLangData(),
            slug: '', developers: '', publishers: '', steam_app_id: '',
            image: null,status: null, released_at: '', keywords: '',
            is_bestseller: null, is_new_release: null,is_popular: null,
        };
    }

    const productForm = document.getElementById('productForm');
    const fetchSteamLink = '/';
    const createProductLink = '/';
    function shopProductData() {
        return {
            productFormData: defaultProductFormData(),
            async submitLinkForm() {
                const linkForm = document.getElementById('linkForm');
                UIKit.form.clearErrors(linkForm);
                UIKit.spinner.show(linkForm);

                this.productFormData = defaultProductFormData();
                let data = new FormData(linkForm);

                try {
                    let response = await UIKit.network.post(fetchSteamLink, data);
                    this.productFormData.steam_app_id= response.steam_app_id;
                    this.productFormData.discount = response.discount;
                    this.productFormData.name = response.name;
                    this.productFormData.en.genres = response.genres_en;
                    this.productFormData.ru.genres = response.genres_ru;

                    this.productFormData.developers= response.developers;
                    this.productFormData.publishers = response.publishers;
                    this.productFormData.released_at = response.released_at;
                    UIKit.spinner.hide(linkForm);
                } catch (errors) {
                    console.error(errors);
                    UIKit.spinner.hide(linkForm);
                    UIKit.form.showErrors(linkForm, await errors.json(), {showTooltip: true});
                }
            },
            async submitProductForm() {
                const productForm = document.getElementById('productForm');
                UIKit.form.clearErrors(productForm);
                UIKit.spinner.show(productForm);

                let data = new FormData(productForm);
                try {
                    let response = await UIKit.network.post(createProductLink, data);
                    UIKit.spinner.hide(productForm);
                } catch (errors) {
                    console.error(errors);
                    UIKit.spinner.hide(productForm);
                    UIKit.form.showErrors(productForm, await errors.json(), {showTooltip: true});
                }
            }
        }
    }

</script>

