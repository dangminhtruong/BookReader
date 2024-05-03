<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookSearchResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookSearchController extends Controller
{
    public function search(Request $request): AnonymousResourceCollection
    {
        $keyword = $request->query('q');

        $results = Book::where('title', 'like', "%$keyword%")
            ->orWhere('summary', 'like', "%$keyword%")
            ->orWhereHas('publisher', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhereHas('authors', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->get();

        return BookSearchResource::collection($results);
    }
}
