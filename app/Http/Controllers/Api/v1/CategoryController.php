<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all the articles of a category and its sub-categories.
     */
    public function findCategoryWithArticles($categoryId)
    {
        try {
            $category = Category::with('news')->find($categoryId);

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found.',
                ], 404);
            }

            // getting all the related articles from the tree including the expired ones
            $articles = $category->getAllArticlesRecursive(true);

            return response()->json([
                $category->name => $articles,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    /**
     * Find category and non expired articles by name category.
     */
    public function findCategoryWithArticlesByName(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
        ]);

        $categoryName = $request->name;

        try {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found.',
                ], 404);
            }

            // getting all the non expired related articles from the tree 
            $articles = $category->getAllArticlesRecursive();

            return response()->json([
                $category->name => $articles,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                'message' => 'Internal Server Error',
            ], 500);
        }
    }
}
