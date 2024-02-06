@extends('layout')
@extends('visitors/navbar')
@section('content')

<!DOCTYPE html>
<html>
    <body>
        <!--Filter Articles by Category -->
        <form id="myForm" action="/categories" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label for=""><b>Filter By Category</b></label><br>
                    <select name="category" id="category" class="form-control-lg form-control-lg">
                    <option></option>
                    <option value="All">All</option>
                    <option value="Technology">Technology</option>
                    <option value="Nature">Nature</option>
                    <option value="Finance">Finance</option>
                    <option value="Sports">Sports</option>
                    <option value="Relationships">Relationships</option>
                    </select>
                </div>
                <br>
                <!-- <div class="col-md-0">
                <button type="submit" class="btn btn-primary">Filter</button>
                </div> -->
            </div>
            <!-- <div class="row">
            <div class="col-md-3">
                <a href="/" class="btn btn-danger">Reset</a>
            </div>
            </div> -->
        </form>

        <script>
            $(document).ready(function () {
                //Listen for change event on the select element
                $('#category').on('change', function() {
                    var optionSelected = $('option:selected', this);
                    //Submit the form when selection changes ans track current value
                    $('#myForm').submit();
                    $('#myForm'.on('submit'), function() {
                        $('#category');
                    })
                    // var currentValue = $('#category').prop('selected', true);
                    // $('#category').val(currentValue);
                });

            });

        </script>

        <!--Render articles from the database using bootstrap through a foreach loop-->
        <div class="container mt-4">
        <div class="row">
        @foreach($articlesByCategory as $article)
        <div class="col-md-4">
        <div class="card mb-4" style="width: 18rem; height:400px ">
        <a href={{ route('article' , $article->id) }}>
            <img class="card-img-top" src="{{ asset('articles_images/' . $article->image) }}" style="width: 18rem; height:150px" alt="ArticleImg"></a>
            <div class="card-body">
               <a style="text-decoration: none;" href={{ route('article' , $article->id) }}> <h5 class="card-title">{{ $article->title }}</h5></a>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($article->article_text, $limit = 80, $end = '...') }}</p>
                <h6 class="card-subtitle">{{ $article->category }} </h6>
                <div style="text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
</svg><p> {{ $article->tag }}</p> </div>

            </div>
        </div>
        <br>
        </div>
        @endforeach
        </div>
        </div>
    </body>
</html>

@endsection
