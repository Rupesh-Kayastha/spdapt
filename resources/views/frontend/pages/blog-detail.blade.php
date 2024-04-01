@extends('frontend.layouts.master')
@section('title','Blog - Morsh Golf')
@section('main-content') 

<!--BANNER SEC-->

<section class="all-inner-banner-sec" style="background: url('{{ asset('frontend/images/product-details/inner-banner.webp') }}') center center no-repeat;">
    <div class="all-inner-banner-body">
        <div class="inner-banne-left">
            <h1>Blog</h1>
        </div>
        <div class="inner-banne-img"> <img src="{{ asset('frontend/images/product-details/product-img.png') }}" class="mar-minus-buttom" alt="" /> </div>
    </div>
</section>

<!--BANNER SEC-->

    <!-- Breadcrumbs -->
    <section class="all-bedcrumbs-sec">
        <div class="bedcrumb-body">
            {{-- <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog</li>
            </ul> --}}
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Single -->
    <section class="blog-single section gallery-page">
        <div class="container gallery-page-body">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                {{-- <div class="image">
                                    <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                </div> --}}
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{$post->title}}</h2>
                                    <div class="blog-meta">
                                        <span class="author"><a href="javascript:void(0);"><i class="fa fa-user"></i>By {{$post->author_info['name']}}</a><a href="javascript:void(0);"><i class="fa fa-calendar"></i>{{$post->created_at->format('M d, Y')}}</a><a href="javascript:void(0);"><i class="fa fa-comments"></i>Comment ({{$post->allComments->count()}})</a></span>
                                    </div>
                                    <div class="sharethis-inline-reaction-buttons"></div>
                                    <div class="content">
                                        @if($post->quote)
                                        <blockquote> <i class="fa fa-quote-left"></i> {!! ($post->quote) !!}</blockquote>
                                        @endif
                                        <p>{!! ($post->description) !!}</p>
                                    </div>
                                </div>

                                <div class="share-social">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-tags">
                                                <h4>Tags:</h4>
                                                <ul class="tag-inner">
                                                    @php
                                                        $tags=explode(',',$post->tags);
                                                    @endphp
                                                    @foreach($tags as $tag)
                                                    <li><a href="javascript:void(0);">{{$tag}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            @auth
                            <div class="col-12 mt-4">
                                <div class="reply">
                                    <div class="reply-head comment-form" id="commentFormContainer">
                                        <h2 class="reply-title">Leave a Comment</h2>
                                        <!-- Comment Form -->
                                        <form class="form comment_form" id="commentForm" action="{{route('post-comment.store',$post->slug)}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12" >
                                                    <div class="form-group">
                                                        <textarea name="comment" id="comment" cols="100" rows="10" placeholder="Your Comment Here"></textarea>
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}" placeholder="Your Comment Here" />
                                                        <input type="hidden" name="parent_id" id="parent_id" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button">
                                                        <button type="submit" class="btn"><span class="comment_btn comment">Post Comment</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Comment Form -->
                                    </div>
                                </div>
                            </div>

                            @else
                            <p class="text-center p-5">
                                You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a> for comment.

                            </p>


                            <!--/ End Form -->
                            @endauth



                            <div class="col-12">
                                <div class="comments">
                                    <h3 class="comment-title">Comments ({{$post->allComments->count()}})</h3>
                                    <!-- Single Comment -->
                                    @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
                                    <!-- End Single Comment -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="main-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Search Here..." name="search">
                                <button class="button" type="sumbit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Single Widget -->

                        <div class="single-widget recent-post">
                            <h3>Recent post</h3>
                            <ul>
                            @foreach($recent_posts as $post)
                                <li><a href="#">{{$post->title}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Categories</h3>
                            <ul>
                                @foreach(Helper::postCategoryList('posts') as $cat)
                                    <li><a href="{{route('blog.categorysearch',$cat->id)}}">{{$cat->title}} </a>({{ Helper::postCategorycount($cat->id) }})</li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Tags</h3>
                            <ul class="tag">
                                @foreach(Helper::postTagList('posts') as $tag)
                                    <li><a href="{{route('blog.tagsearch',$tag->title)}}">{{$tag->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                      
                        <!--/ End Single Widget -->
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Single -->
@endsection
<style>
    .single-widget h3 {
        margin: 0 0 26px 0;
        padding: 0;
        width: 100%;
        font-size: 22px;
        font-weight: 700;
        color: #038576;
    }
    .container.gallery-page-body {
        margin: 0 auto;
        padding: 0 30px;
        max-width: 1320px;
        position: relative;
}
    </style>

@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush
@push('scripts')
<script>
$(document).ready(function(){

    (function($) {
        "use strict";

        $('.btn-reply.reply').click(function(e){
            e.preventDefault();
            $('.btn-reply.reply').show();

            $('.comment_btn.comment').hide();
            $('.comment_btn.reply').show();

            $(this).hide();
            $('.btn-reply.cancel').hide();
            $(this).siblings('.btn-reply.cancel').show();

            var parent_id = $(this).data('id');
            var html = $('#commentForm');
            $( html).find('#parent_id').val(parent_id);
            $('#commentFormContainer').hide();
            $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
          });

        $('.comment-list').on('click','.btn-reply.cancel',function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-reply.reply').show();

            $('.comment_btn.reply').hide();
            $('.comment_btn.comment').show();

            $('#commentFormContainer').show();
            var html = $('#commentForm');
            $( html).find('#parent_id').val('');

            $('#commentFormContainer').append(html);
        });

 })(jQuery)
})
</script>
@endpush
