@extends('layouts.app')

@section('content')
    <div class="row" id="app">
        <div class="col-sm">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                   {!! $menu !!}
                </div>
                <div class="col-lg-9 col-sm-12">
                    <article class="card">
                        <header class="card-header bg-light">
                            <p>
                            <div aria-label="breadcrumb">
                                <ol class="breadcrumb bg-light">
                                @foreach($titles as $title)
                                    <li class="breadcrumb-item">{{ $title }}</li>
                                @endforeach
                                </ol>
                            </div>
                            </p>
                            <p><small>
                            @foreach($footer as $key => $value) 
                                @if($key != 'titles')
                                    <span class="label text-dark"><strong>{{ strtoupper($key) }}</strong></span> 
                                    @if(is_array($value))
                                        @foreach($value as $tag) 
                                            <span class="tag text-muted">{{ strtoupper($tag) }}</span> 
                                        @endforeach
                                    @else
                                        <span class="tag text-muted">{{ strtoupper($value) }}</span> 
                                    @endif
                                @endif
                            @endforeach
                            </small></p>
                        </header>
                        <section class="card-body">
                            <div class="card-text">
                                {!! $page !!}
                            </div>
                        </section>
                        <footer class="card-footer bg-light">
                            <p>
                                &copy; {{ config('app.penname') }} {{ config('app.copyright') }} 
                                @if(config('app.copyright') < date('Y'))
                                    - {{ date('Y') }}                                   
                                @endif 
                                {{ config('app.license') }}                                 
                            </p>
                        </footer>
                    </article>    
                </div>
            </div>
        </div>
    </div>
@endsection