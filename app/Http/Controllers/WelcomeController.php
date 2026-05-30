<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\SiteBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Throwable;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->query('categoria');

        $produtosBanco = collect();

        try {
            $query = Produto::with('categoria')->latest();

            if ($categoria) {
                $query->whereHas('categoria', function ($query) use ($categoria) {
                    $query->where('nome', 'like', '%' . str_replace('-', ' ', $categoria) . '%');
                });
            }

            $produtosBanco = $query->take(20)->get();
        } catch (Throwable) {
            $produtosBanco = collect();
        }

        $banners = $this->banners();

        if ($produtosBanco->isNotEmpty()) {
            $produtos = $produtosBanco->map(function (Produto $produto) {
                return [
                    'nome' => $produto->nome,
                    'categoria' => $produto->categoria->nome ?? 'Produto esportivo',
                    'preco' => $produto->preco,
                    'imagem' => $produto->imagem ? asset('storage/' . $produto->imagem) : null,
                    'href' => route('produto.show', $produto->id),
                    'demo' => false,
                ];
            });
        } else {
            $produtos = collect(config('mantra_demo_products'))
                ->when($categoria, function ($produtos) use ($categoria) {
                    return $produtos->filter(function ($produto) use ($categoria) {
                        return Str::slug($produto['categoria']) === $categoria;
                    });
                })
                ->values()
                ->map(function ($produto) {
                    return [
                        'nome' => $produto['nome'],
                        'categoria' => $produto['categoria'],
                        'preco' => $produto['preco'],
                        'imagem' => asset($produto['imagem']),
                        'href' => route('produto.demo', $produto['slug']),
                        'demo' => true,
                    ];
                });
        }

        return view('welcome', compact('produtos', 'banners'));
    }

    private function banners(): array
    {
        $fallback = [
            'hero' => asset('storage/banners/hero-vista-paixao.png'),
            'colecoes' => [
                [
                    'img' => asset('storage/banners/colecao-pre-jogo.webp'),
                    'title' => 'Pré-jogo',
                    'text' => 'Estilo dentro e fora de campo.',
                ],
                [
                    'img' => asset('storage/banners/colecao-torcedor.jpeg'),
                    'title' => 'Torcedor',
                    'text' => 'Mostre sua paixão.',
                ],
                [
                    'img' => asset('storage/banners/colecao-selecoes.webp'),
                    'title' => 'Seleções',
                    'text' => 'Vista as cores do seu país.',
                ],
            ],
        ];

        try {
            if (! Schema::hasTable('site_banners')) {
                return $fallback;
            }
        } catch (Throwable) {
            return $fallback;
        }

        $siteBanners = SiteBanner::query()
            ->where('ativo', true)
            ->orderBy('ordem')
            ->get()
            ->keyBy('chave');

        $url = fn (?SiteBanner $banner, string $fallbackUrl) => $banner
            ? asset('storage/' . $banner->imagem)
            : $fallbackUrl;

        return [
            'hero' => $url($siteBanners->get('hero-vista-paixao'), $fallback['hero']),
            'colecoes' => [
                [
                    'img' => $url($siteBanners->get('colecao-pre-jogo'), $fallback['colecoes'][0]['img']),
                    'title' => $siteBanners->get('colecao-pre-jogo')->titulo ?? $fallback['colecoes'][0]['title'],
                    'text' => $siteBanners->get('colecao-pre-jogo')->subtitulo ?? $fallback['colecoes'][0]['text'],
                ],
                [
                    'img' => $url($siteBanners->get('colecao-torcedor'), $fallback['colecoes'][1]['img']),
                    'title' => $siteBanners->get('colecao-torcedor')->titulo ?? $fallback['colecoes'][1]['title'],
                    'text' => $siteBanners->get('colecao-torcedor')->subtitulo ?? $fallback['colecoes'][1]['text'],
                ],
                [
                    'img' => $url($siteBanners->get('colecao-selecoes'), $fallback['colecoes'][2]['img']),
                    'title' => $siteBanners->get('colecao-selecoes')->titulo ?? $fallback['colecoes'][2]['title'],
                    'text' => $siteBanners->get('colecao-selecoes')->subtitulo ?? $fallback['colecoes'][2]['text'],
                ],
            ],
        ];
    }
}
