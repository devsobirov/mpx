<div class="width-limiter" id="products">
    <div class="pad flex column p-4 mt-2">

        <div class="mb-4">
            <div class="flex ai-center jc-sb">
                <h3>Редактировать {{$category->name}}</h3>

                <a href="{{route('cp.categories.index')}}" class="button_outline">Вернутся на главной</a>
            </div>
        </div>
    </div>

    <div class="flex ai-start jc-sb" style="gap: 30px">
        @include('cp.categories._tree')

        <div class="flex column mt-2" style="width: 60%">
            <div class="pad flex column p-4 mt-2">
                <h5>Редактировать категорию {{$category->name}}</h5>
                @include('cp.categories._form', ['parent' => null, 'category' => $category])
            </div>

            <div class="pad flex column p-4 mt-2">
                <h5>Добавить новую суб-категорию</h5>
                @include('cp.categories._form', ['parent' => $category, 'category' => new \App\Models\Category()])
            </div>

            @foreach($category->children as $child)
                <div class="pad flex column p-4 mt-2 w-full">
                    <h5>Редактировать суб-категорию {{$child->name}}</h5>
                    @include('cp.categories._form', ['parent' => $category, 'category' => $child])
                </div>
            @endforeach

        </div>
    </div>
</div>

