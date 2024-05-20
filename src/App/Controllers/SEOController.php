<?php

namespace Paw\App\Controllers;

use Paw\Core\Controller;


class SEOController extends Controller 
{
        private $urls;
    
        public function __construct() {
            // Llamar al constructor del padre para inicializar las propiedades
            parent::__construct();
    
            // Fusionar los arreglos desde la clase padre
            $combinedMenus = array_merge($this->menu, $this->menuEmpleado, $this->menuPerfil);
    
            // Extraer las URLs de los arreglos fusionados
            $this->urls = array_map(function($menu) {
                return $menu['href'];
            }, $combinedMenus);
        }
    
        public function generateSitemap() {
            header("Content-type: text/xml; charset=utf-8");
    
            echo '<?xml version="1.0" encoding="UTF-8"?>';
            echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
            foreach ($this->urls as $url) {
                echo '<url>';
                echo '<loc>' . htmlspecialchars($url) . '</loc>';
                echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
                echo '<changefreq>weekly</changefreq>';
                echo '<priority>0.8</priority>';
                echo '</url>';
            }
    
            echo '</urlset>';
        }
    
        public function generateJsonLd() {
            $data = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'url' => 'https://www.example.com/',
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => 'https://www.example.com/search?q={search_term_string}',
                    'query-input' => 'required name=search_term_string'
                ]
            ];
    
            return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }

        public function generateRobot() {
            header("Content-Type: text/plain");
            echo "User-agent: *\n";
            echo "Disallow: /admin\n";
            echo "Disallow: /login\n";
            echo "Disallow: /register\n";
            echo "Allow: /\n";
            echo "Sitemap: https://www.example.com/sitemap.xml\n";
        }        
}
