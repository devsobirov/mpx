<div class="width-limiter" id="products">
    <div class="pad flex column p-4 mt-2">

        <div class="mb-4">
            <div class="flex ai-center jc-sb">
                <h3>Шаблоны категорий</h3>
            </div>
        </div>
    </div>

    <div class="flex ai-start jc-sb" style="gap: 30px">
        @include('cp.categories._tree')

        <div class="pad flex column p-4 mt-2" style="width: 60%">
            <h5>Создать новую родительскую категорию</h5>
            @include('cp.categories._form', ['parent' => null, 'category' => new \App\Models\Category()])
        </div>
    </div>
</div>

