@component('mail::message')
# Comment was posted on post you're watching

Hi {{ $user->name }}

@component('mail::button', ['url' => route('post.show', ['post' => $comment->commentable->id])])
View The Blog Post
@endcomponent

@component('mail::button', ['url' => route('user.show', ['user' => $comment->user->id])])
Visit {{ $comment->user->name }} profile
@endcomponent

@component('mail::panel')
{{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent