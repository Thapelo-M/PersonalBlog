<?php

namespace App\Http\Controllers;

use App\Models;
use App\Models\Articles;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArticlesController extends Controller
{
    //
    public function addArticle(Request $request) {
        //Tags array retrieval
        $selectedTags = $request->input('tags', []);
        $selected = implode(",", $selectedTags);

        //Form Handling logic to add article goes here
        $data = $request->validate([
            'title' => 'required',
            'article_text' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        $imageName = $data['title'].'-image-'.time().rand(1, 1000).'.'.$image->extension();
        $image->move(public_path('articles_images'), $imageName);

        $data['image'] = $imageName;
        $data['tag'] = $selected;
        $data['category'] = $request->input('category');

        //Create an article
        $new_article = Articles::create($data);

        return back()->with('Success', 'Article was added succesfully.');
    }

    //Functions to display and delete an Article
    public function showArticles() {

        $articles = Articles::all();

        return view('delete', compact('articles'));
    }


    public function deleteArticle(Request $request, $articleId) {
        $article = Articles::findOrFail($articleId);


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

    public function getArticle($articleId) {
        //Some code to update an article
        $article = Articles::findOrFail($articleId);

        return view('update', compact('article'));
    }

    public function updateArticle(Request $request, $articleId) {

        $selectedTags = $request->input('tags', []);
        $selected = implode(",", $selectedTags);

        //Validate and Update article with information from 'request'
        $data = $request->validate([
            'title' => 'required',
            'article_text' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = $data['title'].'-image-'.time().rand(1, 1000).'.'.$image->extension();
        $image->move(public_path('articles_images'), $imageName);

        //Update article
        $data['image'] = $imageName;
        $article = Articles::findOrFail($articleId);

        $article->update([
            'title' => $data['title'],
            'article_text' => $data['article_text'],
            'image' => $data['image'],
            'category' => $request->input('category'),
            'tag' => $selected
        ]);

        return redirect()->route('show')->with('success', 'Article updated successfully');

    }

    public function visitorArticles() {
        $articles = Articles::all();

        return view('visitors.welcome', compact('articles'));
    }

    public function filterByCategory(Request $request) {
        $category = $request->input('category');

        $fieldName = 'category';

        $articlesByCategory = Articles::where($fieldName, $category)->get();

        return view('visitors.bycategory', compact('articlesByCategory'));
    }

    //View Article
    public function viewArticle($articleId) {
        $article = Articles::findOrFail($articleId);

        return view('visitors.article', compact('article'));
    }

}
