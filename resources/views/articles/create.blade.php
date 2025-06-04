@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Create Article</h1>
    <form method="POST" action="{{ route('articles.store') }}">
      @csrf
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
          @foreach (\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
@endsection
