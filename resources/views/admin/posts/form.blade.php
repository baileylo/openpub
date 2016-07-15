<form action="{{ $action }}" class="form-inverse" method="POST">
    @if (isset($method))
        <input type="hidden" name="_method" value="{{ $method }}" />
    @endif

    {!! csrf_field() !!}

    @if (isset($status) && $status)
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success text-center" role="alert">
                    Post {{ ucwords($status) }}!
                </div>
            </div>
        </div>
    @endif

    <div class="row form-group">
        <div class="col-lg-12 @if($errors->has('title')) has-error @endif">
            <label for="title">Title: </label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Title: Name of the post" value="{{ old('title', $post->title) }}">
            @if($errors->has('title'))
                <small class="help-block">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 form-group @if($errors->has('description')) has-error @endif">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="4" placeholder="Description: Short description used in OGP">{{ old('description', $post->description) }}</textarea>
            @if($errors->has('description'))
                <small class="error">{{ $errors->first('description') }}</small>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 form-group">
                    <label for="categories">Categories</label>
                    <input type="text" class="form-control" id="categories" name="categories" value="{{ old('categories', $post->categories->pluck('name')->implode(', ')) }}" placeholder="Categories: Insert as many as you want separated by a coma" />
                    @if($errors->has('categories'))
                        <small class="error">{{ $errors->first('categories') }}</small>
                    @endif
                </div>
                <div class="col-lg-12 form-group">
                    <label for="template" class="right inline">Template</label>
                    <select name="template" class="form-control" id="template" required>
                        @foreach($templates as $template)
                            <option value="{{ $template }}" @if ($post->template === $template) selected @endif>{{ ucwords($template) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 form-group @if($errors->has('body')) has-error @endif">
            <label for="body">Body:</label>
            <textarea name="body" id="body" class="form-control" cols="30" rows="8" placeholder="Post: Body of the post written in Markdown">{!! old('body', $post->is_html ? $post->html : $post->markdown) !!}</textarea>
            @if($errors->has('body'))
                <small class="help-block">{{ $errors->first('body') }}</small>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="markdown-toggle" title="Enable markdown parsing of body.">Markdown:</label>
                            <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes" @if(!$post->is_html) checked @endif>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div @if($errors->has('published_at'))class="has-error" @endif>
                                <label for="published-at"> {{ 'Publish' . ($post->is_published ? 'ed' : '') }} At:</label>
                                <input id="published-at" class="form-control" type="datetime" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d H:i') : '') }}" placeholder="YYYY-MM-DD HH:MM">
                                @if($errors->has('published_at'))
                                    <small class="help-block">{{ $errors->first('published_at') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-right">
            @if ($post->slug)
                {{-- You can't view non-saved posts --}}
                <a class="btn btn-info" href="{{ route('resource', $post->slug) }}" target="_blank">View</a>
            @endif

            <a class="btn btn-danger" href="{{ route('admin.post.index') }}">Cancel</a>
            @if (!$post->is_published)
                <button class="btn btn-primary" type="submit" name="isPublished" value="yes">Save &amp; Publish</button>
            @endif

            <button type="submit" class="btn btn-success">{{ $post->id ? 'Update' : 'Save' }}</button>
        </div>
    </div>
</form>