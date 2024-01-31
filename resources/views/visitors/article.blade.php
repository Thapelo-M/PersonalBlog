@extends('layout')
@extends('visitors/navbar')
@section('content')

<!DOCTYPE html>
<body>
   <div class="container">
    <br>
    <div class="col-md-4">
        <a href="/" class="btn btn-primary">Back
        </a>
    </div>
   <div class="row">
        <div class="col-md-12">
        <div class="card mb-4" style="width: 100%; height:fit-content ">
        <img class="card-img-top" src="{{ asset('articles_images/' . $article->image) }}" style="width: 60%; height:250px; " alt="ArticleImg"></a>
            <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
                <p class="card-text">{{ $article->article_text }}</p>
                <h6 class="card-subtitle">{{ $article->category }} </h6>
                <div style="text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
</svg><p> {{ $article->tag }}</p> </div>
        </div>
        </div>

   </div>
   </div>
</body>

</html>

@endsection
