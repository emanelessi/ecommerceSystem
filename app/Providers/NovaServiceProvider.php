<?php

namespace App\Providers;

use App\Nova\Category;
use App\Nova\Coupon;
use App\Nova\CustomerProfile;
use App\Nova\Dashboards\Main;
use App\Nova\Order;
use App\Nova\OrderItem;
use App\Nova\Payment;
use App\Nova\Product;
use App\Nova\ProductImage;
use App\Nova\Review;
use App\Nova\Shipping;
use App\Nova\ShippingAddress;
use App\Nova\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make(__('Customers'), [
                    MenuItem::resource(User::class),
                    MenuItem::resource(CustomerProfile::class),
                ])->icon('user')->collapsable(),

                MenuSection::make(__('Orders'), [
                    MenuItem::resource(Order::class),
                    MenuItem::resource(OrderItem::class),
                ])->icon('shopping-bag')->collapsable(),

                MenuSection::make(__('Products'), [
                    MenuItem::resource(Product::class),
                    MenuItem::resource(ProductImage::class),
                    MenuItem::resource(Category::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make(__('Shipping'), [
                    MenuItem::resource(Shipping::class),
                    MenuItem::resource(ShippingAddress::class),
                ])->icon('truck')->collapsable(),

                MenuSection::make(__('Payments'), [
                    MenuItem::resource(Payment::class),
                ])->icon('credit-card')->collapsable(),

                MenuSection::make(__('Coupons & Reviews'), [
                    MenuItem::resource(Coupon::class),
                    MenuItem::resource(Review::class),
                ])->icon('tag')->collapsable(),

                MenuItem::externalLink(__('Profile'), '/profile'),
                MenuItem::externalLink(
                    App::getLocale() === 'ar' ? __('English') : __('العربية'),
                    url()->current() . '?lang=' . (App::getLocale() === 'ar' ? 'en' : 'ar')
                ),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
