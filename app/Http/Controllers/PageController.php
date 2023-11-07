<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Review;

class PageController extends Controller
{
    public function delivery()
    {
        $page = Page::get()[0];
        return view('pages.delivery', compact('page'));
    }

    public function payment()
    {
        $page = Page::get()[1];
        return view('pages.payment', compact('page'));
    }

    public function refund()
    {
        $page = Page::get()[2];
        return view('pages.refund', compact('page'));
    }

    public function about()
    {
        $page = Page::get()[3];
        return view('pages.about', compact('page'));
    }

    public function contacts()
    {
        $page = Page::get()[4];
        $contacts = Contact::get();
        return view('pages.contacts', compact('page', 'contacts'));
    }

    public function cooperation()
    {
        $page = Page::get()[5];
        return view('pages.cooperation', compact('page'));
    }

    public function where()
    {
        $page = Page::get()[6];
        return view('pages.where', compact('page'));
    }

    public function policy()
    {
        $page = Page::get()[7];
        return view('pages.policy', compact('page'));
    }

    public function reviews()
    {
        $page = Page::get()[8];
        $reviews = Review::get();
        return view('pages.reviews', compact('page', 'reviews'));
    }
}