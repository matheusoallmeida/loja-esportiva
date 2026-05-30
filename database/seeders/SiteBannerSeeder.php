<?php

namespace Database\Seeders;

use App\Models\SiteBanner;
use Illuminate\Database\Seeder;

class SiteBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'chave' => 'hero-vista-paixao',
                'titulo' => 'Vista sua paixão',
                'subtitulo' => 'Camisas oficiais dos maiores times do mundo.',
                'imagem' => 'banners/hero-vista-paixao.png',
                'link' => '#produtos',
                'ordem' => 1,
            ],
            [
                'chave' => 'colecao-pre-jogo',
                'titulo' => 'Pré-jogo',
                'subtitulo' => 'Estilo dentro e fora de campo.',
                'imagem' => 'banners/colecao-pre-jogo.webp',
                'link' => '#produtos',
                'ordem' => 2,
            ],
            [
                'chave' => 'colecao-torcedor',
                'titulo' => 'Torcedor',
                'subtitulo' => 'Mostre sua paixão.',
                'imagem' => 'banners/colecao-torcedor.jpeg',
                'link' => '#produtos',
                'ordem' => 3,
            ],
            [
                'chave' => 'colecao-selecoes',
                'titulo' => 'Seleções',
                'subtitulo' => 'Vista as cores do seu país.',
                'imagem' => 'banners/colecao-selecoes.webp',
                'link' => '#produtos',
                'ordem' => 4,
            ],
        ];

        foreach ($banners as $banner) {
            SiteBanner::updateOrCreate(
                ['chave' => $banner['chave']],
                $banner + ['ativo' => true]
            );
        }
    }
}
