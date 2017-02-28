@extends('app', ['route_blog' => HelpersMachaen::getRouteBlog($post->id)])

@section('content')
  <div class="container">
    <div class="blog-container">
      <section class="preview-blog">
        <h2>{{ $post->titulo }}</h2>
        <div class="options-item">
          <span class="date-release">{{ \Machaen\Blog\Helpers::dateString($post->created_at)}}</span>
          <div class="social-media">
            <div class="fb-like" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>  

            <a href="https://twitter.com/share" class="twitter-share-button" data-via="bestwestern">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

            <a id="pintrest-botton" data-pin-do="buttonPin" data-pin-count="beside" data-pin-lang="es" data-pin-save="true" href="https://es.pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=http%3A%2F%2Fadmin.bookingwindow.mx%2Fuploads%2Fproperty%2Fmarival-resorts%2Fbookingwindow-1469465265.jpg&description=Next%20stop%3A%20Pinterest"></a>


          </div>
        </div>
        <div class="content-item-blog">
          {!! $post->descripcion !!}
        </div>
        <div class="paginator">
          <ul class="pagination">
            @if (is_object(\Machaen\Blog\Helpers::getPrevPost($post)))
              <li>
                <a class="prev-page" href="{{ URL::route('blog.show', [ 'slug' => \Machaen\Blog\Helpers::getPrevPost($post)->slug ]) }}"></a>
              </li>
            @else
              <li></li>
            @endif
            <li>
              <a class="to-back" href="{{ URL::route('blog.index') }}">VOLVER</a>
            </li>
            @if (is_object(\Machaen\Blog\Helpers::getNextPost($post)))
              <li>
                <a class="next-page" href="{{ URL::route('blog.show', [ 'slug' => \Machaen\Blog\Helpers::getNextPost($post)->slug ]) }}"></a>
              </li>
            @else
              <li></li>
            @endif
          </ul>
        </div>
        <div class="fb-comments" data-href="{{ URL::route('blog.show', [ 'slug' => $post->slug ]) }}" data-numposts="5"></div>
      </section>
      @include('packages::filtros', [ 'with_notes' => true, 'years' => $years, 'last_post' => $post->created_at ])
    </div>
  </div>
@endsection
