<form action="{{ $url }}" id="search-form" class="flex" style="gap: 5px" method="GET">
    <label class="field w-full">
        <span class="field__label">{{ __('Название или ID') }}</span>
        <input type="text" class="field__input" name="search" value="{{ request('search') }}">
    </label>
    <label class="field w-full">
        <span class="field__label">{{ __('Steam ID') }}</span>
        <input type="text" class="field__input" name="steam_id" value="{{ request()->get('steam_id') }}">
    </label>
    <select name="platform" class="field__input w-20">
        <option value="">Все платформы</option>
    </select>
    <select name="status" class="field__input">
        <option value="">Все статусы</option>
        <option value="1" @if (request()->get('status') === '1') selected @endif>Есть в наличии</option>
        <option value="0" @if (request()->get('status') === '0') selected @endif>Нет в наличии</option>
    </select>
    <select name="category" class="field__input">
        <option value="">Все категории</option>
        <option value="discounts" @if (request()->get('category') === 'discounts') selected @endif>Игры в акции</option>
        <option value="coming_soon" @if (request()->get('category') === 'coming_soon') selected @endif>Предзаказ </option>
        <option value="new_releases" @if (request()->get('category') === 'new_releases') selected @endif>Новые релизы</option>
        <option value="tabs_on" @if (request()->get('category') === 'tabs_on') selected @endif>Включенными табами</option>
        <option value="tabs_off" @if (request()->get('category') === 'tabs_off') selected @endif>Отключенными табами</option>
        <option value="regions_failed" @if (request()->get('category') === 'regions_failed') selected @endif>Регионы не обновлены</option>
        <option value="order_by_offers" @if (request()->get('category') === 'order_by_offers') selected @endif>С наибольшими офферами</option>
        <option value="without_offers" @if (request()->get('category') === 'without_offers') selected @endif>Без офферов</option>
        <option value="with_offers" @if (request()->get('category') === 'with_offers') selected @endif>Только с офферами</option>
    </select>
    <button class="button_primary">{{ __('Искать') }}</button>
</form>
