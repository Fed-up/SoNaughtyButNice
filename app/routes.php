<?php
//this is calling the '/' the route directory

//Home
Route::get('/', 'HomeController@getIndex');
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@logout');

//Route
// email::get('email', 'EmailController@getEmail');

Route::get('geogram', function(){
   return View::make("partial.geogram");
});

Route::get('square', 'SquareController@getSquare');

//Collection
Route::get('collections', 'CollectionController@getCollections');
Route::get('collection/{id}', 'CollectionPageController@getCollection');

//Recipes
Route::get('recipes', 'RecipeController@getRecipes');
Route::get('recipe/{id}', 'RecipePageController@getRecipe');

//Ingredients
Route::get('ingredients', 'IngredientController@getIngredients');
Route::get('ingredient/{id}', 'IngredientPageController@getIngredient');

//Events
Route::get('events', 'EventsController@getEvents');
Route::get('event/{id}', 'EventsPageController@getEvents');

//Catering
Route::get('catering', 'CateringController@getCatering');
Route::get('catering/{package_array}', 'CateringController@getCustomCatering');
Route::post('catering', 'CateringController@getCreatePackage');
Route::get('package/{id}', 'CateringController@getPackage');
Route::post('package', 'CateringController@packageEnquiry');





//Sales
Route::group(array('before' => 'force.ssl','before' => 'profile'), function() {
Route::post('checkout', 'CheckoutController@postAddToCart');
Route::get('checkout', 'CheckoutController@getCart');
Route::post('pay', 'CheckoutController@postCart');
Route::get('/remove/{identifier}', 'CheckoutController@getRemoveItem');
});

//Profile
Route::get('signup', 'UserProfileController@getAddUser');
Route::post('signup', 'UserProfileController@postAddUser');



Route::group(array('before' => 'profile'), function() {
	Route::get('profile', 'ProfileController@getProfile');
	Route::get('profile/events', 'ProfileEventsController@getProfileEvents');
	Route::post('profile', 'UserProfileController@postUpdateUser');
});











//Admin
Route::group(array('before' => 'auth'), function() {		
	Route::get('admin', 'Admin_AdminController@getIndex');
	//Our Menu
	Route::get('admin/menu/categories', 'Admin_CategoriesController@getCategories');
	Route::get('admin/menu/categories/add', 'Admin_CategoriesController@getAddCategories');
	Route::post('admin/menu/categories/add', 'Admin_CategoriesController@postAddCategories');
	Route::post('admin/menu/categories/edit', 'Admin_CategoriesController@postUpdateCategories');
	Route::get('admin/menu/categories/edit/{id}', 'Admin_CategoriesController@getEditCategories');
	Route::get('admin/menu/categories/active/{id}', 'Admin_CategoriesController@getActiveCategories');
	Route::get('admin/menu/categories/delete/{id}', 'Admin_CategoriesController@getDeleteCategories');
	Route::get('admin/menu/categories/ordering/{id}/{pos}/{dir}', 'Admin_CategoriesController@getOrderCategories');
	
	//Our recipes
	Route::get('admin/menu/recipes', 'Admin_RecipesController@getRecipes');
	Route::get('admin/menu/recipes/add', 'Admin_RecipesController@getAddRecipes');
	Route::post('admin/menu/recipes/add', 'Admin_RecipesController@postAddRecipes');
	Route::post('admin/menu/recipes/edit', 'Admin_RecipesController@postUpdateRecipes');
	Route::get('admin/menu/recipes/edit/{id}', 'Admin_RecipesController@getEditRecipes');
	Route::get('admin/menu/recipes/active/{id}', 'Admin_RecipesController@getActiveRecipes');
	Route::get('admin/menu/recipes/delete/{id}', 'Admin_RecipesController@getDeleteRecipes');	
	
	//Our Ingredients
	Route::get('admin/menu/ingredients', 'Admin_IngredientsController@getIngredients');
	Route::get('admin/menu/ingredients/add', 'Admin_IngredientsController@getAddIngredients');
	Route::post('admin/menu/ingredients/add', 'Admin_IngredientsController@postAddIngredients');
	Route::post('admin/menu/ingredients/edit', 'Admin_IngredientsController@postUpdateIngredients');
	Route::get('admin/menu/ingredients/edit/{id}', 'Admin_IngredientsController@getEditIngredients');
	Route::get('admin/menu/ingredients/active/{id}', 'Admin_IngredientsController@getActiveIngredients');
	Route::get('admin/menu/ingredients/delete/{id}', 'Admin_IngredientsController@getDeleteIngredients');
	
	//Metrics
	Route::get('admin/menu/metric', 'Admin_MetricController@getMetric');
	Route::get('admin/menu/metric/add', 'Admin_MetricController@getAddMetric');
	Route::post('admin/menu/metric/add', 'Admin_MetricController@postAddMetric');
	Route::post('admin/menu/metric/edit', 'Admin_MetricController@postUpdateMetric');
	Route::get('admin/menu/metric/edit/{id}', 'Admin_MetricController@getEditMetric');
	Route::get('admin/menu/metric/active/{id}', 'Admin_MetricController@getActiveMetric');
	Route::get('admin/menu/metric/delete/{id}', 'Admin_MetricController@getDeleteMetric');
	
	//Our Products
	Route::get('admin/products/cart', 'Admin_ProductsController@getProducts');
	Route::get('admin/products/cart/add', 'Admin_ProductsController@getAddProducts');
	Route::post('admin/products/cart/add', 'Admin_ProductsController@postAddProducts');
	Route::post('admin/products/cart/edit', 'Admin_ProductsController@postUpdateProducts');
	Route::get('admin/products/cart/edit/{id}', 'Admin_ProductsController@getEditProducts');
	Route::get('admin/products/cart/active/{id}', 'Admin_ProductsController@getActiveProducts');
	Route::get('admin/products/cart/delete/{id}', 'Admin_ProductsController@getDeleteProducts');	
	
	//Our Catering
	Route::get('admin/products/catering/packages', 'Admin_PackagesController@getPackages');
	Route::get('admin/products/catering/packages/add', 'Admin_PackagesController@getAddPackages');
	Route::post('admin/products/catering/packages/add', 'Admin_PackagesController@postAddPackages');
	Route::post('admin/products/catering/packages/edit', 'Admin_PackagesController@postUpdatePackages');
	Route::get('admin/products/catering/packages/edit/{id}', 'Admin_PackagesController@getEditPackages');
	Route::get('admin/products/catering/packages/active/{id}', 'Admin_PackagesController@getActivePackages');
	Route::get('admin/products/catering/packages/delete/{id}', 'Admin_PackagesController@getDeletePackages');	
	
	//Our events
	Route::get('admin/products/events', 'Admin_EventsController@getEvents');
	Route::get('admin/products/events/add', 'Admin_EventsController@getAddEvents');
	Route::post('admin/products/events/add', 'Admin_EventsController@postAddEvents');
	Route::post('admin/products/events/edit', 'Admin_EventsController@postUpdateEvents');
	Route::get('admin/products/events/edit/{id}', 'Admin_EventsController@getEditEvents');
	Route::get('admin/products/events/active/{id}', 'Admin_EventsController@getActiveEvents');
	Route::get('admin/products/events/delete/{id}', 'Admin_EventsController@getDeleteEvents');
	Route::get('admin/products/events/delete/{id}', 'Admin_EventsController@getDeleteEvents');
	
	//Our Users
	Route::post('admin/user/members/add', 'Admin_UserController@postAddMembers');
	Route::post('admin/user/members/edit', 'Admin_UserController@postUpdateMembers');
	Route::get('admin/user/members/edit/{id}', 'Admin_UserController@getEditMembers');
	Route::get('admin/user/members/active/{id}', 'Admin_UserController@getActiveMembers');
	Route::get('admin/user/members/delete/{id}', 'Admin_UserController@getDeleteMembers');
	
	Route::get('admin/user/managers', 'Admin_UserController@getManagers');
	Route::get('admin/user/managers/edit', 'Admin_UserController@getEditManagers');
	Route::get('admin/user/members', 'Admin_UserController@getMembers');
	Route::get('admin/user/members/add', 'Admin_UserController@getAddMembers');	

	//Our analitics
	Route::get('admin/website/analytics', 'Admin_AnalyticsController@getAnalytics');
	Route::get('admin/website/analytics/add', 'Admin_AnalyticsController@getAddAnalytics');
	Route::post('admin/website/analytics/add', 'Admin_AnalyticsController@postAddAnalytics');
	Route::post('admin/website/analytics/edit', 'Admin_AnalyticsController@postUpdateAnalytics');
	Route::get('admin/website/analytics/edit/{id}', 'Admin_AnalyticsController@getEditAnalytics');
	Route::get('admin/website/analytics/active/{id}', 'Admin_AnalyticsController@getActiveAnalytics');
	Route::get('admin/website/analytics/delete/{id}', 'Admin_AnalyticsController@getDeleteAnalytics');
	Route::get('admin/website/analytics/delete/{id}', 'Admin_AnalyticsController@getDeleteAnalytics');
	
	//Our Quotes
	Route::get('admin/website/quotes', 'Admin_QuotesController@getQuotes');
	Route::get('admin/website/quotes/add', 'Admin_QuotesController@getAddQuotes');
	Route::post('admin/website/quotes/add', 'Admin_QuotesController@postAddQuotes');
	Route::post('admin/website/quotes/edit', 'Admin_QuotesController@postUpdateQuotes');
	Route::get('admin/website/quotes/edit/{id}', 'Admin_QuotesController@getEditQuotes');
	Route::get('admin/website/quotes/active/{id}', 'Admin_QuotesController@getActiveQuotes');
	Route::get('admin/website/quotes/delete/{id}', 'Admin_QuotesController@getDeleteQuotes');
	Route::get('admin/website/quotes/delete/{id}', 'Admin_QuotesController@getDeleteQuotes');
	
	//Header
	Route::get('admin/website/header', 'Admin_HeaderController@getHeader');
	Route::get('admin/website/header/add', 'Admin_HeaderController@getAddHeader');
	Route::post('admin/website/header/add', 'Admin_HeaderController@postAddHeader');
	Route::post('admin/website/header/edit', 'Admin_HeaderController@postUpdateHeader');
	Route::get('admin/website/header/edit/{id}', 'Admin_HeaderController@getEditHeader');
	Route::get('admin/website/header/active/{id}', 'Admin_HeaderController@getActiveHeader');
	Route::get('admin/website/header/delete/{id}', 'Admin_HeaderController@getDeleteHeader');
	
	
	Route::post('admin/upload', 'Admin_AdminController@postUpload');
	
});




//Route::resource('posts', 'PostsController');
//Route::get('postCreate', 'PostsController@create');