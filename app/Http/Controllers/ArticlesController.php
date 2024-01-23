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
        'image' => 'required',
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

        return back()->with('Success', 'Article was added succesfully.');
    }

    //Functions to display and delete an Article
    public function showArticles() {

        $articles = Articles::all();

        //Create empty arrays to store categories and tags
        $categories = [];
        $tags = [];
        //Loop through each article to get its category and tags
        foreach($articles as $article) {
            $categories[$article->id] = $article->categories;
            $tags[$article->id] = $article->tags; //'tags' being the relatioship method in model 'Articles'
        }
        return view('delete', compact('articles', 'categories', 'tags'));
    }


    public function deleteArticle(Request $request, $articleId) {
        $article = Articles::with('categories', 'tags')->find($articleId);

        //Check if exists
        if($article) {
            //Delete Article
            $article->delete();

            return redirect()->route('show')->with('success', 'Article deleted successfully');
        }

        else {
            // Article not found
            return redirect()->route('show')->with('error', 'Article not found.');
        }
    }

}
