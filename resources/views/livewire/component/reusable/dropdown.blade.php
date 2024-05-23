<style>
    :root{
        --stroke-color: #599297;
        --select-color: #1F6268;
    }

     /* SELECT */

     .select-button{
        padding: 15px;
        width: 100%;
        border: 2px solid var(--stroke-color);
        border-radius: 10px;
        outline: none;

    }

    .select-placeholder{
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-size: 14px;
        color: var(--select-color);

    }

    /* END OF SELECT */

</style>

<div 
        class="max-w-96 w-full absolute bg-white mt-2" 
        x-data="statisticsFilter" 
    >
        <button type="button" class="select-button" style="height: 55px;"
            @click="selected !== 1 ? selected = 1 :selected = null"
        >
            <div class="flex items-center justify-between">
                <span class="select-placeholder" x-text="truncateText(filterTitle)">12345</span>
                <span class="menu-arrow-icon" x-html="selected === 1 ? `<img src='{{ asset('images/table/asc.png') }}' style='width: 10px;'>` : `<img src='{{ asset('images/table/desc.png') }}' style='width: 10px;'>`"></span>
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: 200px' : ''">
            <div style="overflow: auto; max-height: 200px; z-index: 10;">
                @foreach($db_data as $dropdown_data)
                    <div class="p-3 border" >
                        <button style="width: 100%; text-align:start" @click="selected !== 1 ? selected = 1 :selected = null, filterTitle='{{$dropdown_data->name}}'"> 
                            {{$dropdown_data->name}}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
</div>

<script>
    // document.addEventListener('livewire:navigated', () => {
        function statisticsFilter(){

            return {
                selected: null,
                filterTitle:'Select Company',
                
                truncateText(text) {
                    const maxLength = 40;

                    if (text.length > maxLength) {
                        return text.substring(0, maxLength) + '...';
                    }

                    // If the length of the text is within the limit, return the original text
                    return text;
                }
            }
        }
    // });
</script>