<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\AddNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller
{
    /**
     * Display a listing of the non expired news.
     */
    public function index(Request $request)
    {
        try {

            $perPage = $request->per_page ?? 10;

            $news = News::where('end_date', '>', now())
                ->orderByDesc('start_date')
                ->paginate($perPage);

            return response()->json($news);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Internal Server Error",
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewsRequest $request)
    {
        try {

            $news = News::create($request->validated());

            return response()->json([
                'status' => 'success',
                'data' => $news
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Internal Server Error",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        try {

            return response()->json($news, 200);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Internal Server Error",
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        try {

            $news->update($request->all());

            $updatedNews = News::find($news->id);

            $response = [
                'status' => 'success',
                'message' => "News updated successfully",
                'news' => $updatedNews,
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Internal Server Error",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {

            $news->delete();

            return response()->json([
                "status" => "success",
                "message" => "News deleted successfully",
            ], 204);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Internal Server Error",
            ], 500);
        }

    }
}