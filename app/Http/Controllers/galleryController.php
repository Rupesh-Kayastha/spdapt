<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class galleryController extends Controller
{
    /**
     * Public Function `galleryPhotos` to show the photo gallery
     * @created on 09 Oct 2019
     */
    public function galleryPhotos(Request $request) {
        return view('frontend/gallery/photo_gallery');
    }

    /**
     * Public Function `galleryVideos` to get the video galleries.
     * @created on 09 Oct 2019
     */
    public function galleryVideos(Request $request) {
        return view('frontend/gallery/video_gallery');
    }

    /**
     * Public Function `galleryPhotosDetails` to get the Photo gallery Details.
     * @created on 10 Oct 2019
     */
    public function galleryPhotosDetails(Request $request) {
        return view('frontend/gallery/photo_gallery_detail');
    }

    /**
     * Public Function `galleryVideosDetails` to show the gallery Videos Detail Page.
     * @created on 10 Oct 2019
     */
    public function galleryVideosDetails() {
        return view('frontend/gallery/video_gallery_details');
    }

    /**
     * Public Function `galleryAudios` to get the Audio galleries.
     * @created on 23 Nov 2019
     */
    public function galleryAudios(Request $request) {
        return view('frontend/gallery/audio_gallery');
    }

    





    
}
