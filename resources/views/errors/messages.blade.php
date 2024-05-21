@if (\Session::has('message'))
    @if(\Session::has('message_type') === 'danger')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">{!! \Session::get('message') !!}</span>
        </div>
    @elseif(\Session::has('message_type') === 'warning')
        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            <span class="font-medium">{!! \Session::get('message') !!}</span>
        </div>
    @else
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">{!! \Session::get('message') !!}</span>
    </div>
    @endif
@endif