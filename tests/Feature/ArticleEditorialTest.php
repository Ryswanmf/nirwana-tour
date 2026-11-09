<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;

class ArticleEditorialTest extends TestCase
{
    public function test_article_detail_page_renders_with_editorial_structure_and_sanitizes_xss(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'tips-wisata-test'],
            ['name' => 'Tips Wisata Test', 'type' => 'article']
        );

        Post::where('slug', 'panduan-editorial-wisata-lampung-test')->forceDelete();

        $post = Post::create([
            'title' => 'Panduan Editorial Wisata Lampung',
            'slug' => 'panduan-editorial-wisata-lampung-test',
            'category_id' => $category->id,
            'category_name' => $category->name,
            'excerpt' => 'Ringkasan panduan editorial lengkap untuk wisatawan.',
            'content' => '<h2>Subjudul H2 Utama</h2>' .
                         '<script>alert("xss-test")</script>' .
                         '<p onclick="evil()">Paragraf artikel yang nyaman dibaca dengan font 16-17px.</p>' .
                         '<h3>Subjudul H3 Detail</h3>' .
                         '<ul><li>Poin pertama</li><li>Poin kedua</li></ul>' .
                         '<h4>Subjudul H4 Minor</h4>' .
                         '<ol><li>Langkah satu</li><li>Langkah dua</li></ol>' .
                         '<blockquote>"Kutipan inspiratif wisata Nirwana."</blockquote>' .
                         '<p>Kunjungi <a href="https://nirwanatourlampung.com">Website Resmi</a>.</p>' .
                         '<table><thead><tr><th>Hari</th><th>Tujuan</th></tr></thead><tbody><tr><td>1</td><td>Pahawang</td></tr></tbody></table>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get(route('posts.show', $post->slug));

        $response->assertStatus(200);

        // Memastikan elemen container editorial dan card terpasang
        $response->assertSee('article-reading-container', false);
        $response->assertSee('article-main-card', false);
        $response->assertSee('article-lead-box', false);
        $response->assertSee('rich-content article-content', false);

        // Memastikan elemen struktur tipografi ter-render
        $response->assertSee('<h2>Subjudul H2 Utama</h2>', false);
        $response->assertSee('<h3>Subjudul H3 Detail</h3>', false);
        $response->assertSee('<h4>Subjudul H4 Minor</h4>', false);
        $response->assertSee('<ul>', false);
        $response->assertSee('<li>Poin pertama</li>', false);
        $response->assertSee('<ol>', false);
        $response->assertSee('<li>Langkah satu</li>', false);
        $response->assertSee('<blockquote>', false);
        $response->assertSee('<a href="https://nirwanatourlampung.com">Website Resmi</a>', false);

        // Memastikan tabel otomatis terbungkus container responsif
        $response->assertSee('article-table-wrapper', false);
        $response->assertSee('<table>', false);

        // Memastikan script berbahaya dan attribute event di-strip oleh sanitizer
        $response->assertDontSee('<script>alert("xss-test")</script>', false);
        $response->assertDontSee('onclick="evil()"', false);

        // Bersihkan data uji coba agar tidak mengotori database
        $post->forceDelete();
    }
}
