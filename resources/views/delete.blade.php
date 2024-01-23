@extends('layout')

<h2 style="text-align: center;">Delete Articles Here</h2>
<a href="/dashboard" class="btn btn-warning">Go Back</a>

<table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Article Text</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
            @php $i=1; @endphp
            @forelse($articles as $article)
            <tr>
                <td>{{$i++;}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->article_text}}</td>
                <td>
                    <div class="col-md-3">
                    <div class="card-body" style="max-width: 20rem;">
                        <img src="{{ asset('articles_images/' . $article->image) }}" class="card-img-top">
                    </div>
                    </div>
                </td>
                <td>{{$categories[$article->id]->category}}</td>
                <td>{{ implode(', ', $tags[$article->id]->pluck('tag')->toArray()) }}</td>
                <td>
                    <a href={{ route('delete' , $article->id) }} class="btn btn-outline-dark">Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No products yet</td>
            </tr>
            @endforelse
            </tbody>
        </table>


