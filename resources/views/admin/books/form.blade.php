<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('isbn', 'ISBN') !!}
    {!! Form::input('number', 'isbn', null, ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('authors[]', 'Author(s)') !!}
    {!! Form::select('authors[]', $authors, isset($selected) ? $selected : null, ['class' => 'form-control', 'multiple']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('pages', 'Pages') !!}
    {!! Form::input('number', 'pages', null, ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('publisher', 'Publisher') !!}
    {!! Form::text('publisher', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('published_date', 'Published Date') !!}
    {!! Form::input('date', 'published_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::input('number', 'price', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::file('image', ['class' => 'file', 'data-show-preview' => 'false', 'data-show-upload' => 'false']); !!}
</div>