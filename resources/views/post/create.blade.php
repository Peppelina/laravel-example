@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" class="form-control" id="title"  placeholder="title">
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea type="text" name="content" class="form-control" id="content"  placeholder="content"></textarea>
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input type="text" name="image" class="form-control" id="image"  placeholder="image">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id">
                    @foreach($categories as $category)
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                    <option value={{$tag->id}}>{{ $tag->title }}</option>
                    @endforeach

                </select>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection
