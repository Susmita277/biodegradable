<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BroccoliBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broccoli:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates the sitemap and caches the route responses for production environment.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->generateSitemap();

        $this->line('');

        $this->call('optimize');

        $this->line('');

        $this->call('filament:optimize');

        $this->line('');

        $this->line(
            <<<'EOD'
                .%▒@+.                                                                              
                  ▒███▒&=.                                                                          
                  ▒██████▓@+:                                                                       
                  ▒██████████▒&=.                                                                   
                  ▒██████████████@*-.                                                               
                  ▒██████████████████#+..                                                           
                  ▒█████████████████████░%-.                                                        
                  ▒████████████████████████▒#=.                                                     
                  ▒████████████████████████████#&-.                                                 
                  ▒███████████████████████████████▓#+:                                              
                  ▒█████████████▒█░░█▒████████████████░%+                                           
                  ▒█████▓█████&&::..::&&█████▓███████████▓@*.                                       
                  ▒█████*▓██▒*:        -*▒██▓*███████████████▒&=:                                   
                  ▒█████#.*▒@-          :&▓%.&██████████████████▓░*:.                               
                  ▒██████#..-.          .=..&███████████████████████▒#+.                            
                  ▒███████▓%:            .*▓████████████████████████████░%:.                        
                  ▒██████████░&+-....:=%@██████████████████████████████████▒#+:                     
                  ▒███████████████████████████████████████████████████████████▓@*-                  
                  ▒█████████████████████████@-                                                      
                  ▒███████████████████████████@:                                                    
                  ▒███████████%▓██+=██▓%████████@-                                                  
                  ▒███████████ .++  +*. ██████████#:                                                
                  ▒███████&:=*          *=:&████████#:                                              
                  ▒████████&              %███████████#:                                            
                  ▒█████@-.                 :#██████████#:                                          
                  ▒███████&.               %██████████████#-                                        
                  ▒█████#-                  -&██████████████#-                                      
                  ▒███████▒&              &▓██████████████████#-                                    
                  ▒███████@.:=         .=-.#████████████████████#-                                  
                  ▒███████▓███ .==  =+  ██████████████████████████#:                                
                  ▒███████████*▒██--██▓%████████████████████████████@-                              
                  ▒████████████████▓██████████████████████████████████#:                            
                  ▒█████████████████████████████████████████████████████#-                          
                  ▒███████████████████████████████████████████████████████#:                        
                  ▒█████████████████████████████████████████████████████████#:                      
                  ▒███████████████████████████████████████████████████████████#-                    
                  ▒█████████████████████████████████████████████████████████████#-                  
                  ▒███████████████████████████████████████████████████████████████#-                
                .+▓█████████████████████████████████████████████████████████████████@=              
EOD
        );

        $this->line('');

        $this->line('App optimized 🥦');

        $this->line('');

        $this->line('Filament optimized 🥦');

        $this->line('');

        $this->line('Sitemap generated 🥦');

        $this->line('');

        $this->info('🥦 Broccoli build ready 🥦');
    }

    private function generateSitemap()
    {
        $sitemap = Sitemap::create();

        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return in_array('GET', $route->methods()) &&
                ! str_contains($route->uri(), 'nova') &&
                ! str_contains($route->uri(), '_debugbar') &&
                ! str_contains($route->uri(), 'admin') &&
                ! str_contains($route->uri(), 'livewire');
        });

        foreach ($routes as $route) {
            if (str_contains($route->uri(), '{')) {
                continue;
            }

            $sitemap->add(Url::create(url($route->uri())));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
