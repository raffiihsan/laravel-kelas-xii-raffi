@extends('templates.index')

@push('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('template/list-css/table-style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('template/list-css/basictable.css') }}" />
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('template/list-js/jquery.basictable.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table-breakpoint').basictable({
      breakpoint: 768
    });
  });
</script>
@endpush

@section('content')
<div class="container">
  <br />
  <div class="agileits-single-top">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('movies') }}">Movies</a></li>
      <li class="active">{{ $film->title }}</li>
    </ol>
  </div>

  <div class="single-page-agile-info">
    <div class="show-top-grids-w3lagile">
      <div class="col-sm-8 single-left">
        <div class="song">
          <div class="single-right-grids">
            <div class="col-md-4 single-right-grid-left">
              <a href="{{ route('movies.show', $film->id) }}"><img src="/{{ $film->poster }}" alt="" /></a>
            </div>
            <div class="col-md-8 single-right-grid-right">
              <div class="song-info">
                <h2>{{ $film->title }}</h2>
                <p class="author"><a href="#" class="author">{{ $film->year }}</a></p>
                <p class="views">{{ $film->sinopsis }}</p>
              </div>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  <div class="agile-news-table">
                    <table id="table-breakpoint">
                      <thead>
                        <tr>
                          <th>Cast</th>
                          <th>Peran</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($perans as $peran)
                        <tr>
                          <td class="w3-list-info">{{ $peran->cast_id }}</td>
                          <td class="w3-list-info">{{ $peran->actor }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>

        <div class="song-grid-right">
          <div class="share">
            <h5>Share this</h5>
            <div class="single-agile-shar-buttons">
              <!-- Social media sharing buttons -->
            </div>
          </div>
        </div>

        <div class="all-comments">
          <div class="all-comments-info">
            <a href="#">Comments</a>
            <div class="agile-info-wthree-box">
              <form method="post" action="">
                @csrf 
                @php
                $user = Auth::user();
                @endphp
                <textarea placeholder="Message" required=""></textarea>
                @if(Auth::check())
                  <input type="submit" value="SEND">
                @else 
                  <p>Kamu belum masuk</p>
                @endif
              </form>
            </div>
          </div>

          <div class="media-grids">
            @foreach ($comments as $comment)
            <div class="media" id="comment-container-{{ $comment->id }}">
              <div class="media-header">
                <h5>{{ $comment->user->name }}</h5>
                <div class="media-icons" style="display: flex; gap: 10px; font-size: 15px;">
                  <form action="{{ route('kritik.edit', ['kritik' => $comment->id]) }}" method="GET" style="display: inline;">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa-solid fa-pencil"></i>
                    </button>
                  </form>
                  <form action="{{ route('kritik.destroy', ['kritik' => $comment->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus komentar ini?')">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                  <form action="{{ route('kritik.show', ['kritik' => $comment->id]) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-info">
                      <i class="fa-solid fa-circle-info"></i>
                    </button>
                  </form>
                </div>
              </div>
              <div class="media-left">
                <a href="#">
                  <img src="{{ asset('storage/images/user.jpg') }}" title="One movies" alt=" " />
                </a>
              </div>
              <div class="media-body">
                <p>
                  @if (str_word_count($comment->comment) > 30)
                    {{ implode(' ', array_slice(explode(' ', $comment->comment), 0, 30)) }}...
                    <a href="{{ route('kritik.show', ['kritik' => $comment->id]) }}" class="selengkapnya">selengkapnya</a>
                  @else
                    {{ $comment->comment }}
                  @endif
                </p>
                <div class="rating">
                  @for ($i = 0; $i < $comment->rating; $i++)
                    <i class="fa-solid fa-star" style="color: gold;"></i>
                  @endfor
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-4 single-right">
        <h3>Similar Film By Genre</h3>
        @foreach ($filmByGenre as $film)
        <div class="single-grid-right">
          <div class="single-right-grids">
            <div class="col-md-4 single-right-grid-left">
              <a href="{{ route('movies.show', $film->id) }}"><img src="/{{ $film->poster }}" alt="" /></a>
            </div>
            <div class="col-md-8 single-right-grid-right">
              <a href="{{ route('movies.show', $film->id) }}" class="title">{{ $film->title }}</a>
              <p class="author"><a href="#" class="author">{{ $film->year }}</a></p>
              <p class="views" style="text-align: justify; margin-right: 10px">{{ $film->sinopsis }}</p>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="js/simplePlayer.js"></script>
<script>
  $("document").ready(function() {
    $("#video").simplePlayer();
  });
</script>
@endpush
