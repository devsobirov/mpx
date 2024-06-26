<div class="width-limiter" id="games">
    <div class="pad flex column p-4 mt-2">

        <div class="mb-4">
            <div class="flex ai-center jc-sb">
                <h3>Список игр ({{$games->total()}})</h3>

                <a href="{{route('cp.games.form')}}" class="button_outline">Создать</a>
            </div>

            <div class="flex jc-end mt-3" style="gap: 8px">
                @include('cp.games.partials.index-filters', ['url' => route('cp.games.index')])
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
            @forelse($games as $game)
                <tr id="{{$game->id}}">
                    <td style="text-align: center; width: 3rem">{{ $game->id }}</td>
                    <td style="text-align: left;">
                        {{ $game->name }}
                        <p style="padding-top: .25rem; color: #ccc">{{ $game->genres }}</p>
                        <p style="padding-top: .25rem; color: #ccc">Релиз: {{$game->released_at?->format('d-m-Y') ? : '-'}}</p>
                        <p style="padding-top: .25rem; color: #ccc">SteamID: {{$game->steam_app_id ?? '-'}}</p>
                    </td>
                    <td style="text-align: left;"><img src="{{ asset($game->image) }}" alt="" style="width: 100px; padding: 1px; border: 1px solid #ccc"></td>
                    <td style="text-align: left;">
                        Показать на сайте: {{ $game->status ? "Да" : "Нет" }}
                        @if($game->discount)
                            <br><p class="mt-1" style="color: #ffffff">Акция: {{$game->discount}}%</p>
                        @endif
                    </td>
                    <td style="text-align: left;">
                        @foreach($game->catalog as $category)
                            <a href="#" class="button_orange_small">{{$category->name}}</a>
                        @endforeach
                    </td>
                    <td>
                        <div class="flex" style="gap: 6px; flex-wrap: wrap; max-width:320px" >
                            <a href="{{route('cp.games.form', $game->id)}}" class="button_outline_small">Редактировать</a>
                            <a href="{{route('cp.tree.index', ['game' => $game->slug])}}" class="button_outline_small">Дерево категорий</a>
                            <a href="#" target="_blank" class="button_outline_small">Посмотреть на сайте</a>
                            <a href="{{route('cp.games.delete', $game->id, false)}}" class="button_red_small game-delete-button"
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
            {{ $games->links('cp.common.pagination', ['target' => '#games']) }}
        </div>
    </div>
</div>

