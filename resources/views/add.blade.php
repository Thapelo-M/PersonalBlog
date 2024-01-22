@extends('layout')

<h2 style="text-align: center;">Add new Article</h2>
@if(session('success'))
<div class="alert alert-dismissible alert alerts-success">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Success</h4>
        <p class="mb-0">New article was added successfully!</p>
</div>
@endif
<form action="/add-article" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">

<div class="col-md-6 mb-3">

    <label for="title" class="mt-4"><b>Title</label>
    <input
    type="text"
    class="form-control @error('title') is-invalid @enderror"
    name="title"
    placeholder="Add Article Title">

    <span class="text-danger">
        @error('title')
            {{$message}}
        @enderror
    </span>
</div>

<div class="col-md-6 mb-3">

    <label for="description">Description</label></br>
    <textarea
    name="article_text"
    cols="50"
    rows="10"
    placeholder="Description">

</textarea>
<span class="text-danger">
        @error('title')
            {{$message}}
        @enderror
    </span>
</div>
<br>
<div class="col-md-6 mb-3">
    <label for="file">Upload Article Image</label>
    <input
    type="file"
    name="image"
    id=""
    class="form-control">

</div>
<br>
    <label for=""><b>Choose Category</b></label><br>
    <select name="category" id="category" class="form-control-lg form-control-lg">
    <option value="technology">Technology</option>
    <option value="nature">Nature</option>
    <option value="finance">Finance</option>
    <option value="sports">Sports</option>
    <option value="relationships">Relationships</option>
    </select>

</br>
<label for=""><b>Add Tags(Optional)</b></label><br>
    <select name="tags[]" id="tags" class="form-control-lg form-control-lg" multiple>
    <option value="ai">ai</option>
    <option value="fintech">fintech</option>
    <option value="epl">epl</option>
    <option value="psl">psl</option>
    <option value="microsoft">microsoft</option>
    <option value="databases">databases</option>
    <option value="saving">saving</option>
    <option value="cybercrime">cybercrime</option>
    <option value="bafanabafana">bafanabafana</option>
    </select>
</div>
<!--
    <input type="radio" name="category" id="radio3" value="Finance" class="form-check-input">Finance
</div>

<div class="form-check">
    <input type="radio" name="category" id="radio4" value="Football" class="form-check-input">Football
</div>

-->

<div class="mt-4">
    <button type="submit" class="btn btn-primary">Save Article</button>
</div>

</div>
</form>
