<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class WriterController extends Controller
{
    /**
     * Menampilkan semua artikel milik penulis yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua artikel yang dibuat oleh penulis yang sedang login
        $articles = Article::where('user_id', $user->id)->get();

        return response()->json($articles);
    }

    /**
     * Menyimpan artikel baru oleh penulis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Opsional, harus berupa gambar max 2MB
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = Auth::id();

        // Jika ada gambar, simpan ke storage
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        }

        $article->save();

        return response()->json([
            'message' => 'Artikel berhasil dibuat',
            'article' => $article
        ], 201);
    }

    /**
     * Mengupdate artikel milik penulis sendiri.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $article = Article::where('id', $id)->where('user_id', $user->id)->first();

        if (!$article) {
            return response()->json(['message' => 'Artikel tidak ditemukan atau bukan milik Anda'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->has('title')) {
            $article->title = $request->title;
        }
        if ($request->has('content')) {
            $article->content = $request->content;
        }

        // Jika ada gambar baru, update gambarnya
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        }

        $article->save();

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'article' => $article
        ]);
    }

    /**
     * Menghapus artikel milik penulis sendiri.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $article = Article::where('id', $id)->where('user_id', $user->id)->first();

        if (!$article) {
            return response()->json(['message' => 'Artikel tidak ditemukan atau bukan milik Anda'], 403);
        }

        $article->delete();

        return response()->json(['message' => 'Artikel berhasil dihapus']);
    }
}
