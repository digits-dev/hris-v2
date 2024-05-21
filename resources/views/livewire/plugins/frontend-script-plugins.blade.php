<div>
    {{-- JQUERY --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                location.reload();
            }
        };
    </script>
    
    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {{-- JQUERY UI JS  --}}
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="{{ asset ('plugins/select2/select2.min.js') }}"></script>
    <script src='{{asset("js/jquery-sortable-min.js")}}'></script>
</div>
