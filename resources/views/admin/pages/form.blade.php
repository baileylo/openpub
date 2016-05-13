<form action="{{ $action }}" class="form-inverse" method="POST">

    @if (isset($method))
        <input type="hidden" name="_method" value="{{ $method }}" />
    @endif

    {!! csrf_field() !!}

    @if (isset($status) && $status)
        <div class="row">
            <div class="large-12 columns">
                <div class="alert alert-success text-center" role="alert">
                    Page {{ ucwords($status) }}!
                </div>
            </div>
        </div>
    @endif

    <div class="row form-group">
        <div class="col-lg-12 @if($errors->has('title')) has-error @endif">
            <label for="title">Title: </label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Title: Name of the page" value="{{ old('title', $page->title) }}">
            @if($errors->has('title'))
                <small class="help-block">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-8 @if($errors->has('slug')) has-error @endif">
            <label for="slug">Slug: </label>
            <input type="text" id="slug" name="slug" class="form-control" placeholder="/my-page" required value="{{ old('slug', $page->slug) }}">
            @if($errors->has('slug'))
                <small class="help-block">{{ $errors->first('slug') }}</small>
            @endif
        </div>

        <div class="col-lg-4 @if($errors->has('template')) has-error @endif">
            <label for="template">Template: </label>
            <select name="template" id="template" class="form-control">
                @foreach($templates as $template)
                    <option value="{{ $template }}" @if(old('template', $page->template) == $template) selected @endif>{{ ucwords($template) }}</option>
                @endforeach
            </select>
            @if($errors->has('template'))
                <small class="help-block">{{ $errors->first('template') }}</small>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-12 @if($errors->has('body')) error @endif">
            <label for="body">Page Contents: </label>
            <textarea name="body" id="body" cols="30" rows="12" class="form-control" placeholder="Post: Body of the post written in Markdown" required="true">{!! old('body', $page->is_html ? $page->html : $page->markdown) !!}</textarea>
            @if($errors->has('body'))
                <small class="error">{{ $errors->first('body') }}</small>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="well well-sm form-group">
                <label for="markdown-toggle" title="Enable markdown parsing of body.">Markdown:</label>
                <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes" @if(!$page->is_html) checked @endif>
                <span></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-right">
            <a class="btn btn-danger" href="{{ route('admin.page.index') }}">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>