<?php

namespace App\Http\Controllers;

use App\Models;
use App\Models\Articles;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function addArticle(Request $request) {

    //Form Handling logic to add article goes here
     $data = $request->validate([
        'title' => 'required',
        'article_text' => 'required',
        'image' => 'required'
        // 'category' => 'required',
        // 'tags' => 'array'
     ]);

     $image = $request->file('image');
     $imageName = $data['title'].'-image-'.time().rand(1, 1000).'.'.$image->extension();
     $image->move(public_path('articles_images'), $imageName);

    //Create a new article
    $data['image'] = $imageName;

    $new_article = Articles::create($data);

    //Create records in categories and tags
    Categories::create([
        'articles_id' => $new_article->id,
        'category' => $request->input('category')
    ]);

    //Tags array retrieval
    $selectedTags = $request->input('tags', []);
    $selected = implode(",", $selectedTags);


    Tags::create([
        'articles_id' => $new_article->id,
        'tag' => $selected
        ]);


        return back()->withErrors('error', 'Failed to add article. Please try again.');



    }

}
