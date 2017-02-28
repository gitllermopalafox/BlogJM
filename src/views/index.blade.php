@extends('app')
@section('content')
  <div class="container">
    <div class="container">
      <div class="blog-container">
        <section class="blog-items">
        @if ($posts->count()==0)
          <h3 class="show-result">Resultados</h3>
        @else
          <h3 class="show-result"> {{ $posts->total() }} RESULTADOS (PAGINA {{ $posts->currentPage() }} DE {{ $posts->lastPage() }}) </h3>
        @endif
          @foreach($posts as $post)
            <div class="item-info">
              <div class="prev-image-cont">
                <img class="preview-image-blog" src="{{ $post->image_banner }}">
              </div>
              <div class="more-information">
                <div class="title-item">
                  <span>{{ $post->titulo }}</span>
                </div>
                <div class="overview-item">
                  {{ strlen($post->previo) > 120 ? substr($post->previo, 0, 115)."[...]" : $post->previo }}
                </div>
                <div class="footer-item">
                  <span class="date-info">{{  \Machaen\Blog\Helpers::dateString($post->created_at) }}</span>
                  <a class="btn-show-post" href="{{ URL::route('blog.show', [ 'slug' => $post->slug ]) }}">LEER MÁS</a>
                </div>
              </div>
            </div>
          @endforeach

          <div class="paginator">
            {!! $posts->appends([ 'search'  => app('request')->input('search') ,
                                  'tag'     => app('request')->input('tag') 
                                ])->render() !!}
          </div>
        </section>
        @include('packages::filtros', [ 'with_notes' => null, 'tags' => $tags, 'years' => $years ])
      </div>
    </div>
  </div>
@endsection