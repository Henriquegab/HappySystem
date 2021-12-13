<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Cliente;
use App\Models\Produto;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Paginator::useBootstrap();

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add( [
                'type'         => 'navbar-search',
                'text'         => 'search',
                'topnav_right' => true,
            ],
            [
                'type'         => 'fullscreen-widget',
                'topnav_right' => true,
            ],
    
            // Sidebar items:
            [
                'type' => 'sidebar-menu-search',
                'text' => 'pesquisar',
            ],
            [
                'text' => 'blog',
                'url'  => 'admin/blog',
                'can'  => 'manage-blog',
            ],);
            $event->menu->add('GERENCIAMENTO DE CLIENTES');
            $event->menu->add([
                'text'    => 'Clientes',
                'icon'    => 'fas fa-fw fa-user',
                'submenu' => [
                    [
                        'text'        => 'Cadastro de Clientes',
                        'route'         => 'clientes.create',
                        'icon'        => 'far fa-fw fa-user',
                        
                    ],
                    [
                        'text'        => 'Listagem de Clientes',
                        'route'         => 'clientes.index',
                        'icon'        => 'far fa-fw fa-user',
                        'label'       => Cliente::count(),
                        'label_color' => 'success',
                        
                    ],
                    
    
                ]
            ],
            ['header' => 'GERENCIAMENTO DE PRODUTOS'],

            [
                'text'    => 'Produtos',
                'icon'    => 'fas fa-shopping-basket',
                'submenu' => [
                    [
                        'text'        => 'Cadastro de Produtos',
                        'route'       => 'produtos.create',
                        'icon'        => 'fas fa-shopping-bag',
                        
                    ],
                    [
                        'text'        => 'Listagem de Produtos',
                        'route'       => 'produtos.index',
                        'label'       => Produto::count(),
                        'icon'        => 'fas fa-shopping-bag',
                        
                    ],
                    
    
                ]
            ],
    
            ['header' => 'GERENCIAMENTO DE PEDIDOS'],
    
            [
                'text'    => 'Pedidos',
                'icon'    => 'fas fa-shopping-cart',
                'submenu' => [
                    [
                        'text'        => 'Cadastro de Pedidos',
                        'url'         => 'admin/settings',
                        'icon'        => 'fas fa-cart-plus',
                        
                    ],
                    [
                        'text'        => 'Listagem de Pedidos',
                        'url'         => 'admin/settings',
                        'icon'        => 'fas fa-cart-arrow-down',
                        
                    ]
                   
                    
    
                ]
            ],
           
            ['header' => 'CONFIGURAÇÕES DA CONTA'],
            
            [
                'text' => 'Perfil',
                'url'  => 'admin/settings',
                'icon' => 'fas fa-fw fa-user',
            ],
            [
                'text' => 'Mudar Senha',
                'url'  => 'admin/settings',
                'icon' => 'fas fa-fw fa-lock',
            ],);

            
        });
    }
}
