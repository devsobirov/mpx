<div class="width-limiter" id="products">
    <div class="pad flex column p-4 mt-2">

        <div class="mb-4">
            <div class="flex ai-center jc-sb">
                <h3>Список игр ({{$products->total()}})</h3>

                <a href="{{route('cp.products.create')}}" class="button_outline">Создать</a>
            </div>

            <div class="flex jc-end mt-3" style="gap: 8px">
                @include('cp.products.partials.index-filters', ['url' => route('cp.products.index')])
            </div>
        </div>

        <table class="table w-100" id="search-results">
            <thead>
            <tr>
                <th style="text-align: center; width: 3rem">ID</th>
                <th style="text-align: left;">Название</th>
                <th style="text-align: left;">Постер</th>
                <th style="text-align: left;">Флаги</th>
                <th style="text-align: left;">Категории</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $game)
                <tr id="{{$game->id}}">
                    <td style="text-align: center; width: 3rem">{{ $game->id }}</td>
                    <td style="text-align: left;">
                        {{ $game->name }}
                        <p style="padding-top: .25rem; color: #ccc">{{ $game->getGenres() }}</p>
                        <p style="padding-top: .25rem; color: #ccc">Отзывы: {!!$game->recommendations_total!!}</p>
                        <p style="padding-top: .25rem; color: #ccc">Релиз: {{$game->released_at ? date('d M Y', $game->released_at) : '-'}}</p>
                        <p style="padding-top: .25rem; color: #ccc">SteamID: {{$game->steam_app_id ?? '-'}}</p>
                    </td>
                    <td style="text-align: left;"><img src="{{ $game->image_url() }}" alt="" style="width: 100px; padding: 1px; border: 1px solid #ccc"></td>
                    <td style="text-align: left;">
                        {{ (float)$game->getExternalPrice('rub') }} RUB<br>
                        {{ (float)$game->getExternalPrice('usd') }} USD
                        @if($game->discount_percent)
                            <br><p class="mt-1" style="color: #ffffff">Акция: {{$game->discount_percent}}%</p>
                        @endif
                        <p style="padding-top: .25rem; color: #ccc">Табы: {{$game->show_tabs ? 'включены' : '-'}}</p>
                    </td>
                    <td style="text-align: left;">{{ $game->getPlatformTitle() }}</td>
                    <td style="text-align: left;">
                        {{ $game->status == 1 ? "Есть" : "Нет" }}
                        @if (count($game->groups))
                            <p style="color: #ccc; margin: 4px 0;">Состоит в группах:</p>
                            @foreach ($game->groups as $gr)
                                <a href="{{route('game-groups.details', $gr->id)}}" target="_blank" style="display: block; margin-bottom:2px;">
                                    #{{$gr->id}}-{{$gr->name}}
                                </a>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <div class="flex" style="gap: 6px; flex-wrap: wrap; max-width:320px" >
                            <a href="{{route('shop-products.edit', $game->id)}}" class="button_outline_small">{{ __('common.edit') }}</a>
                            <a href="{{route('web.game', $game->getUrlParams(), false)}}" target="_blank" class="button_outline_small">Посмотреть на сайте</a>
                            <a href="{{route('reviews.form', ['product_id' => $game->id, 'type' => 'game'], false)}}" class="button_primary_small create-game-button mx-1">Создать отзыв</a>
                            <a href="{{route('product-links.show', $game->id)}}" class="button_green_small">Ссылки</a>
                            <a href="{{route('shop-products.offers', $game->id)}}" class="button_green_small">Офферы ({{$game->offers_count}})</a>
                            @if($game->steam_app_id)
                                <a href="{{route('shop-products.update-steam', $game->id)}}?backUrl={{Str::before(request()->fullUrl(), '#')}}#{{$game->id}}" class="button_green_small"
                                   onclick="return confirm('Запустить процесс обновления?')">Обновить данные стим</a>
                            @endif
                            <a href="{{route('offer-link.form', ['shopProduct' => $game->id], false)}}" class="button_primary_small mx-1">Ссылка офферов</a>
                            <a href="{{route('shop-products.delete', ['shopProduct' => $game->id], false)}}" class="button_red_small game-delete-button"
                               data-question="{{ __('games.gameDeleteConfirmationTitle', ['name' => $game->name]) }}"
                               data-hint="{{ __('games.gameDeleteConfirmationDesc') }}"
                            >{{ __('common.delete') }}</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td style="text-align: center" colspan="6">Товары не найдены</td>
                </tr>
            </tbody>
            @endforelse
        </table>

        <div class="mt-4">
            {{ $products->links('cp.common.pagination', ['target' => '#products']) }}
        </div>
    </div>
</div>

