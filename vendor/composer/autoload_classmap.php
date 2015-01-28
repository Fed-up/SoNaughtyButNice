<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Admin_AdminController' => $baseDir . '/app/controllers/admin/AdminController.php',
    'Admin_AnalyticsController' => $baseDir . '/app/controllers/admin/AnalyticsController.php',
    'Admin_CategoriesController' => $baseDir . '/app/controllers/admin/CategoriesController.php',
    'Admin_EventsController' => $baseDir . '/app/controllers/admin/EventsController.php',
    'Admin_HeaderController' => $baseDir . '/app/controllers/admin/HeaderController.php',
    'Admin_IngredientsController' => $baseDir . '/app/controllers/admin/IngredientsController.php',
    'Admin_MetricController' => $baseDir . '/app/controllers/admin/MetricController.php',
    'Admin_PackagesController' => $baseDir . '/app/controllers/admin/PackagesController.php',
    'Admin_ProductsController' => $baseDir . '/app/controllers/admin/ProductsController.php',
    'Admin_QuotesController' => $baseDir . '/app/controllers/admin/QuotesController.php',
    'Admin_RecipesController' => $baseDir . '/app/controllers/admin/RecipesController.php',
    'Admin_UserController' => $baseDir . '/app/controllers/admin/UserController.php',
    'AuthController' => $baseDir . '/app/controllers/AuthController.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'Catering' => $baseDir . '/app/models/Catering.php',
    'CateringController' => $baseDir . '/app/controllers/sales/CateringController.php',
    'CheckoutController' => $baseDir . '/app/controllers/sales/CheckoutController.php',
    'CollectionController' => $baseDir . '/app/controllers/public/CollectionController.php',
    'CollectionPageController' => $baseDir . '/app/controllers/public/CollectionPageController.php',
    'CreateSessionTable' => $baseDir . '/app/database/migrations/2014_05_21_084122_create_session_table.php',
    'CreateUsersTable' => $baseDir . '/app/database/migrations/2014_05_20_082246_create_users_table.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Events' => $baseDir . '/app/models/Events.php',
    'EventsController' => $baseDir . '/app/controllers/sales/EventsController.php',
    'EventsPageController' => $baseDir . '/app/controllers/sales/EventsPageController.php',
    'Header' => $baseDir . '/app/models/Header.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'Images' => $baseDir . '/app/models/Images.php',
    'IngredientController' => $baseDir . '/app/controllers/public/IngredientController.php',
    'IngredientPageController' => $baseDir . '/app/controllers/public/IngredientPageController.php',
    'MenuCategories' => $baseDir . '/app/models/MenuCategories.php',
    'MenuIngredients' => $baseDir . '/app/models/MenuIngredients.php',
    'MenuRecipes' => $baseDir . '/app/models/MenuRecipes.php',
    'MenuRecipesExtras' => $baseDir . '/app/models/MenuRecipesExtras.php',
    'MenuRecipesFacts' => $baseDir . '/app/models/MenuRecipesFacts.php',
    'MenuRecipesIngredients' => $baseDir . '/app/models/MenuRecipesIngredients.php',
    'MenuRecipesMethods' => $baseDir . '/app/models/MenuRecipesMethods.php',
    'Metric' => $baseDir . '/app/models/metric.php',
    'PostsController' => $baseDir . '/app/controllers/PostsController.php',
    'Products' => $baseDir . '/app/models/Products.php',
    'ProfileController' => $baseDir . '/app/controllers/profile/ProfileController.php',
    'Quotes' => $baseDir . '/app/models/Quotes.php',
    'RecipeController' => $baseDir . '/app/controllers/public/RecipeController.php',
    'RecipePageController' => $baseDir . '/app/controllers/public/RecipePageController.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'StoreController' => $baseDir . '/app/controllers/sales/StoreController.php',
    'Stripe' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Stripe.php',
    'StripeTestCase' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/TestCase.php',
    'Stripe_Account' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Account.php',
    'Stripe_AccountTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/AccountTest.php',
    'Stripe_ApiConnectionError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApiConnectionError.php',
    'Stripe_ApiError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApiError.php',
    'Stripe_ApiRequestor' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApiRequestor.php',
    'Stripe_ApiRequestorTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/ApiRequestorTest.php',
    'Stripe_ApiResource' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApiResource.php',
    'Stripe_ApplicationFee' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApplicationFee.php',
    'Stripe_ApplicationFeeRefund' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/ApplicationFeeRefund.php',
    'Stripe_ApplicationFeeRefundTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/ApplicationFeeRefundTest.php',
    'Stripe_ApplicationFeeTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/ApplicationFeeTest.php',
    'Stripe_AttachedObject' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/AttachedObject.php',
    'Stripe_AuthenticationError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/AuthenticationError.php',
    'Stripe_AuthenticationErrorTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/AuthenticationErrorTest.php',
    'Stripe_Balance' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Balance.php',
    'Stripe_BalanceTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/BalanceTest.php',
    'Stripe_BalanceTransaction' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/BalanceTransaction.php',
    'Stripe_BalanceTransactionTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/BalanceTransactionTest.php',
    'Stripe_Card' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Card.php',
    'Stripe_CardError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/CardError.php',
    'Stripe_CardErrorTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/CardErrorTest.php',
    'Stripe_Charge' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Charge.php',
    'Stripe_ChargeTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/ChargeTest.php',
    'Stripe_Coupon' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Coupon.php',
    'Stripe_CouponTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/CouponTest.php',
    'Stripe_Customer' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Customer.php',
    'Stripe_CustomerTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/CustomerTest.php',
    'Stripe_DiscountTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/DiscountTest.php',
    'Stripe_Error' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Error.php',
    'Stripe_ErrorTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/Error.php',
    'Stripe_Event' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Event.php',
    'Stripe_InvalidRequestError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/InvalidRequestError.php',
    'Stripe_InvalidRequestErrorTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/InvalidRequestErrorTest.php',
    'Stripe_Invoice' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Invoice.php',
    'Stripe_InvoiceItem' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/InvoiceItem.php',
    'Stripe_InvoiceTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/InvoiceTest.php',
    'Stripe_List' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/List.php',
    'Stripe_Object' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Object.php',
    'Stripe_ObjectTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/ObjectTest.php',
    'Stripe_Plan' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Plan.php',
    'Stripe_PlanTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/PlanTest.php',
    'Stripe_RateLimitError' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/RateLimitError.php',
    'Stripe_Recipient' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Recipient.php',
    'Stripe_RecipientTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/RecipientTest.php',
    'Stripe_Refund' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Refund.php',
    'Stripe_RefundTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/RefundTest.php',
    'Stripe_SingletonApiResource' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/SingletonApiResource.php',
    'Stripe_Subscription' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Subscription.php',
    'Stripe_SubscriptionTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/SubscriptionTest.php',
    'Stripe_Token' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Token.php',
    'Stripe_TokenTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/Token.php',
    'Stripe_Transfer' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Transfer.php',
    'Stripe_TransferTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/TransferTest.php',
    'Stripe_Util' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Util.php',
    'Stripe_UtilTest' => $baseDir . '/app/library/stripe-php-1.17.1/test/Stripe/UtilTest.php',
    'Stripe_Util_Set' => $baseDir . '/app/library/stripe-php-1.17.1/lib/Stripe/Util/Set.php',
    'Symfony\\Component\\HttpFoundation\\Resources\\stubs\\FakeFile' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/FakeFile.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'TestIngredient' => $baseDir . '/app/models/TestIngredient.php',
    'User' => $baseDir . '/app/models/User.php',
    'UserProfileController' => $baseDir . '/app/controllers/profile/UserProfileController.php',
);
