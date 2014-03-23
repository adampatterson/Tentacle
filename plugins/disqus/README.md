Disqus Comments
======

Comments for Tentacel CMS through Disqus

In the Blog tempalte loop you will need to include the following after the content.
```
<? disqus::comments( $post ) ?>
```

In the Post tempalt/type you will need to include the following after the content.
```
<? disqus::comments_form( $post->id ); ?>
```
