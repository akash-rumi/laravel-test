<div class="form-group">
    <label> Title</label>
    <input type="text" class="form-control" name="title" value="{{ old ('title',$post->title??null)}}">
</div>
<div class="form-group">
    <label>Content</label>
    <textarea class="form-control" rows="7" name="content"> {{old('content',$post->content??null)}}</textarea>
</div>