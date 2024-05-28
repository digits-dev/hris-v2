<div x-data="{showResponse: true }" x-init="setTimeout(()=>{ showResponse = false },3000)">
    <div x-show="showResponse" x-cloak x-transition>    
        @if (\Session::has('message'))
            @if(\Session::has('message_type') === 'danger')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-600 dark:text-white" role="alert">
                    <span class="font-medium">{!! \Session::get('message') !!}</span>
                </div>
            @elseif(\Session::has('message_type') === 'warning')
                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-yellow-600 dark:text-white" role="alert">
                    <span class="font-medium">{!! \Session::get('message') !!}</span>
                </div>
            @else
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-600 dark:text-white" role="alert">
                <span class="font-medium">{!! \Session::get('message') !!}</span>
            </div>
            @endif
        @endif
    </div>
</div>
