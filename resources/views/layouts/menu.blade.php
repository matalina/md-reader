<?php
function drawMenu($items) {
    ?>
    <ul class="menu tree">
    <?php
    foreach($items as $i) {
    ?>
        @if(isset($i['folder']))
            <li>
                <i class="fas fa-folder-open fa-fw"></i>
                {{ $i['name'] }}
                <div class="contents">
                    {{ drawMenu($i['folder']) }}
                </div>
            </li>    
        @else
            <li  class="link">
                <i class="fas fa-file fa-fw"></i>
                <a href="{{ route('page',['page' => $i['link']]) }}">{{ $i['name'] }}</a>
            </li>
        @endif
    <?php } ?>
    </ul>    
    <?php
}
?>

<h6>
    <strong>Notebooks</strong> 
    @if(auth()->check())
        @if(auth()->user()->is_owner)
        ( Owner )
        @else
        ( User )
        @endif
    @endif 
</h6>
{!! drawMenu($items) !!}