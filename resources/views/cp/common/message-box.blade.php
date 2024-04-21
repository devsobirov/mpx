<div class="message-box" style="z-index: 1050;">
    <template x-show="$store.errors.messages && $store.errors.messages.length" x-for="(message, key) in $store.errors.messages">
        <div class="alert danger-alert" :key="key"
             x-transition x-data="{show: false}" x-show="show"
             x-init="setTimeout(() => {show = true}, 200)">
            <h3 x-text="message"></h3>
            <a @click="show = false" class="close-alert">&times;</a>
        </div>
    </template>

    <template x-show="$store.success && $store.success.length" x-for="(message, key) in $store.success">
        <div class="alert success-alert" :key="key"
             x-transition x-data="{show: false}" x-show="show"
             x-init="setTimeout(() => {show = true}, 200)">
            <h3 x-text="message"></h3>
            <a @click="show = false" class="close-alert">&times;</a>
        </div>
    </template>

@if ($errors->any())
    @foreach($errors->all() as $message)
        <div class="alert danger-alert"
             x-transition x-data="{show: false}" x-show="show"
             x-init="setTimeout(() => {show = true}, 400)">
            <h3>{{$message}}</h3>
            <a @click="show = false" class="close-alert">&times;</a>
        </div>
    @endforeach
@endif

@if ($message = session('msg'))
    <div class="alert danger-alert"
            x-transition x-data="{show: false}" x-show="show"
            x-init="setTimeout(() => {show = true}, 400)">
        <h3>{{$message}}</h3>
        <a @click="show = false" class="close-alert">&times;</a>
    </div>
@endif
@if ($message = session('success'))
    <div class="alert success-alert"
            x-transition x-data="{show: false}" x-show="show"
            x-init="setTimeout(() => {show = true}, 400)">
        <h3>{{$message}}</h3>
        <a @click="show = false" class="close-alert">&times;</a>
    </div>
@endif


</div>
