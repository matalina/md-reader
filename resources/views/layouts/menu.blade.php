<mw-folder :folders="{{ json_encode($folders) }}" 
           :name="{{ config('app.name')}}"
           :links="{{ json_encode($links) }}"
></mw-folder>