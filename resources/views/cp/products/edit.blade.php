
<div class="width-limiter" x-data="shopProductData()" x-init="initTinyMCE()">

    <div class="pad flex column mt-3 pr-4 pl-4 pt-2 pb-2">
        <div class="flex ai-center jc-sb mb-4">
            <h4>Редактировать - "{{$product->name}}"</h4>
            <a href="{{route('shop-products.index')}}" class="button_outline ml-2 no-white-space">{{ __('Все товары') }}</a>
        </div>
        <form @submit.prevent="submitProductForm()" id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="id">
            <div class="flex column" style="width: 100%">
                @include('shop.products.partials.input-discount-edit')

                @include('shop.products.partials.input-base-fields-edit')

                <div class="flex ai-start mt-3">
                    <div class="flex column w-full pr-3">
                        <div class="flex w-full ai-center" style="gap: 8px">
                            <label class="field w-25">
                                <span class="field__label">{{ 'Цена в RUB' }}</span>
                                <input type="text"  class="field__input" value="{{$product->external_price_rub}}" name="external_price_rub">
                            </label>
                            <label class="field w-25">
                                <span class="field__label">{{ 'Цена в USD' }}</span>
                                <input type="text"  class="field__input" value="{{$product->external_price_usd}}" name="external_price_usd">
                            </label>
                        </div>
                        <div class="flex ai-center mt-3">
                            <h4 style="width: 200px; margin-right: 1.5rem;">Выберите Жанр(ов): </h4>
                            <div class="flex" style="flex-wrap: wrap; gap: 10px">
                                @foreach(\App\Models\Shop\GameGenre::getGenresList() as $genre)
                                    <label class="checkbox @if(!$loop->first) ml-3 @endif">
                                        <input name="genres[]" value="{{$genre->id}}" type="checkbox" class="checkbox__input"
                                            @if(in_array($genre->id, $product->getGenresIds())) checked @endif>
                                        <span class="checkbox__box"></span>
                                        <span class="checkbox__text">{{ $genre->genre }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex mt-3">
                            <h4 style="width: 200px; margin-right: 1.5rem;">Статус: </h4>
                            <label class="checkbox">
                                <input type="checkbox" @if($product->status) checked @endif name="status" class="checkbox__input">
                                <span class="checkbox__box"></span>
                                <span class="checkbox__text">Есть в наличии</span>
                            </label>
                        </div>
                        <div class="flex mt-3">
                            <h4 style="width: 200px; margin-right: 1.5rem;">Выберите платформу: </h4>
                            @foreach($platforms as $platform)
                                <label class="checkbox @if(!$loop->first) ml-3 @endif">
                                    <input type="radio" name="platform" class="checkbox__input" value="{{$platform->id}}" @if($platform->id === intval($product->platform_id)) checked @endif>
                                    <span class="checkbox__box"></span>
                                    <span class="checkbox__text">{{ $platform->title }}</span>
                                </label>
                            @endforeach
                        </div>

                        <label class="field mt-3 w-full">
                            <span class="field__label">Загрузить новый постер</span>
                            <input type="file" class="field__input" name="image" style="height: auto; padding: .5rem">
                        </label>

                        <div class="flex mt-3" style="gap: 10px;">
                            <img src="{{$product->image_url()}}" alt="" class="block p-1" style="border: 1px solid #ccc; border-radius: 4px; width: 200px;">
                            <img src="{{$product->feed_image_url()}}" alt="" class="block p-1" style="border: 1px solid #ccc; border-radius: 4px; width: 200px;">
                        </div>

                        <label class="field mt-3 w-full">
                            <span class="field__label">Загрузить новый баннер</span>
                            <input type="file" class="field__input" name="image_banner" style="height: auto; padding: .5rem">
                        </label>
                        <img src="{{$product->banner_url()}}" alt="" class="block p-1" style="border: 1px solid #ccc; border-radius: 4px; width: 200px;">

                        @include('shop.products.partials.input-video')
                    </div>
                </div>

                @include('shop.products.partials.game-tabs-edit')

                <div class="flex jc-end mt-3">
                    <button type="submit" class="button_primary ml-2">{{ __('Сохранить') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    function defaultLangTabs () {
        return {
            product: {description: false, delivery_info: false, package: false, about_game: false, requirements: false},
        }
    }
    const productForm = document.getElementById('productForm');
    const createProductLink = '{{route('shop-products.save', [], false)}}';

    function shopProductData() {
        return {
            langTabs: defaultLangTabs(),
            productCreated: false,
            mainEdition: {},
            editions: [],
            extraEditions: [],
            productFormData: {
                video: '{{$product->video}}'
            },
            showTabs: parseInt("{{$product->show_tabs ? 1 : 0}}"),
            addExtraEdition() {
              this.extraEditions.push({
                  edition: '',
                  price: null,
                  id: null,
                  key: Math.random()
              })
            },
            switchTabLang (tabName, shouldChangeDefault = false) {
                if (tabName === 'product_desc') this.langTabs.product.description = shouldChangeDefault
                if (tabName === 'product_info') this.langTabs.product.delivery_info = shouldChangeDefault
                if (tabName === 'product_about') this.langTabs.product.about_game = shouldChangeDefault
                if (tabName === 'product_req') this.langTabs.product.requirements = shouldChangeDefault
                if (tabName === 'product_delivery_info') this.langTabs.product.delivery_info = shouldChangeDefault
                if (tabName === 'product_package') this.langTabs.product.package = shouldChangeDefault
                if (tabName === 'gameplay') this.langTabs.product.gameplay = shouldChangeDefault
                if (tabName === 'qualities') this.langTabs.product.qualities = shouldChangeDefault

                if (tabName === 'plati_desc') this.langTabs.plati.description = shouldChangeDefault
                if (tabName === 'plati_info') this.langTabs.plati.info = shouldChangeDefault

            },
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
            removeTinyMCE() {
                tinymce.remove();
            },
            initTinyMCE() {
                initTinyMCE();
            }
        }
    }

    async function initTinyMCE() {
        await tinymce.init({
            selector: '.tinymce',
            min_height: 300,
            plugins: ['directionality', 'advlist', 'autolink', 'link', 'autolink', 'image','media', 'fullscreen', 'table', 'emoticons','code', 'lists', 'help' ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'outdent indent | forecolor backcolor emoticons | bullist numlist advlist table | autolink link image media  | ' +
                'fullscreen code help',
            language: 'ru',
            menubar: 'favs file edit view insert format tools table help',
            content_css: 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/skins/content/tinymce-5-dark/content.min.css',
            // FileUpload
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{route('upload.image')}}?base_dir={{\App\Models\Shop\ShopProduct::IMAGE_BASE_DIR}}',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });
    }
</script>

