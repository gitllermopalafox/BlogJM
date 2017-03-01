<section class="blog-filters">
  <div class="search-container">
    <div>
      {!! Form::open(['route' => 'blog.index', 'method' => 'GET']) !!}
        <input type="text" name="search" placeholder="{{ trans('blog.search') }}" value="{{ app('request')->input('search') }}">
        <input type="submit" value="IR">
      {!! Form::close() !!}
    </div>
  </div>
  <div class="filter-explorer">
    <h2>{{ trans('blog.explore') }}</h2>
    @foreach ($tags as $tag)
      <span class="tags-filter">
        <a href="{{ URL::route('blog.index', [ 'tag' => $tag->slug ]) }}">
          {{ $tag->tag_name}}
        </a> 
      </span>
    @endforeach
    
  </div>
  @if ( !is_null($with_notes))
    @if (!is_null($post_recent)) 
      <div class="filter-notes">
        <h2>{{ trans('blog.related') }}</h2>
        @foreach($post_relation as $post)
          <a class="item-rel" href="{{ URL::route('blog.show', [ 'slug' => $post->slug ]) }}">
            <div class="cont-img-item">
              <img src="{{ $post->image_banner }}">
            </div>
            <span>{{ $post->titulo }}</span>
          </a>
        @endforeach
      </div>
    @endif
    @if (!is_null($post_recent))
      <div class="filter-notes">
        <h2>{{ trans('blog.recent') }}</h2>
        @foreach($post_recent as $post)
          <a class="item-rel" href="{{ URL::route('blog.show', [ 'slug' => $post->slug ]) }}">
            <div class="cont-img-item">
              <img src="{{ $post->image_banner }}">
            </div>
            <span>{{ $post->titulo }}</span>
          </a>
        @endforeach
      </div>
      @endif
  @endif
  <div class="filter-date">
    <h2>{{ trans('blog.date') }}</h2>
    @foreach ($years as $year)
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading year-panel">
            <h4 class="panel-title ">
              <a class="action-panel" data-toggle="collapse" href="#year-{{ $year }}">{{ $year }} 
                <span class="to-show"></span>
              </a>
            </h4>
          </div>
          <div id="year-{{ $year }}" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="panel-group">
                @foreach (\Machaen\Blog\Helpers::getMonthsPost($year) as $month)
                  @if (\Machaen\Blog\Helpers::monthHasPost($month, $year) > 0)
                    <div class="panel panel-default">
                      <div class="panel-heading month-panel">
                        <h4 class="panel-title">
                          <a class="action-panel" data-toggle="collapse" href="#month-{{ $month }}-{{ $year }}">
                            {{ \Machaen\Blog\Helpers::getMonthString($month) }} <span class="to-show"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="month-{{ $month }}-{{ $year }}" class="panel-collapse collapse">
                        <div class="panel-body">
                          @foreach (\Machaen\Blog\Helpers::getPostByMonth($month, $year) as $post_prev)
                            <a  class="post-item" 
                                href="{{ URL::route('blog.show', [ 'slug' => $post_prev->slug ]) }}">
                                  •  {{ $post_prev->titulo }} 
                            </a>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>